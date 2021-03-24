<?php

namespace App\Http\Controllers\Administrator\ApiSettings;

use App\Model\Administrator\ApiSettings\FlightsMarkup;
use App\Helpers\FlightApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;

class FlightApiController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('administrator.api_settings.flight-booking.search');
    }


    public function searchFlight(Request $request){
        
        $json = [
            'AdultCount' => $request->adult_count,
            'ChildCount' => $request->childs_count,
            'InfantCount' => 0,
            'DirectFlight' => true,
            'OneStopFlight' => true,
            'JourneyType' => 1,
            'PreferredAirlines' => '',
            'Segments' => [[
                'Origin' => $request->from,
                'Destination' => $request->to,
                'FlightCabinClass' => 1,
                'PreferredDepartureTime' => $request->departure.'T00:00:00',
                'PreferredArrivalTime' => $request->arrival.'T00:00:00'
            ]]
        ];
        $results = FlightApi::search($json);
        return view('administrator.api_settings.flight-booking.result',['results'=>$results])->render();
    }

    public function setFlightMarkup(Request $request){
        $model = FlightsMarkup::firstOrNew(['flight_number'=>$request->flight_number,'airline'=>$request->airline.'-'.$request->airlinecode]);
        $model->flight_number = $request->flight_number;
        $model->airline = $request->airline.'-'.$request->airlinecode;
        $model->location_from = $request->from;
        $model->location_to = $request->to;
        if($model->exists){
            if($request->type == 'rupee'){
                $model->plus_amount = $request->value;
            }else{
                $model->plus_percent = $request->value;
            }
        }else{
            if($request->type == 'rupee'){
                $model->plus_amount = $request->value;
                $model->plus_percent = 0;
            }else{
                $model->plus_percent = $request->value;
                $model->plus_amount = 0;
            }
        }

        $model->visibility_status = 1;
        $model->save();
        return ['value'=>$request->value];
    }


    /**
     * @param Request $request
     * @return array
     */
    public function setFlightVisibility(Request $request){
        $model = FlightsMarkup::where(['flight_number'=>$request->data['flightnumber'],'airline'=>$request->data['airline'].'-'.$request->data['airlinecode']])->first();
        if($model == null){
            $model = new FlightsMarkup;
            $model->flight_number = $request->data['flightnumber'];
            $model->airline = $request->data['airline'].'-'.$request->data['airlinecode'];
            $model->location_from = $request->data['from'];
            $model->location_to = $request->data['to'];
            $model->plus_amount = 0;
            $model->plus_percent = 0;
            $model->visibility_status = ($request->status == 'false')?1:0;
            $model->save();
        }else{
            $model->visibility_status = ($request->status == 'false')?1:0;
            $model->save();
        }
        return ['status'=>'true'];
    }

    public function setFlightAmountBy(Request $request){
        $model = FlightsMarkup::where(['flight_number'=>$request->data['flightnumber'],'airline'=>$request->data['airline'].'-'.$request->data['airlinecode']])->first();
        if($model == null){
            $model = new FlightsMarkup;
            $model->flight_number = $request->data['flightnumber'];
            $model->airline = $request->data['airline'].'-'.$request->data['airlinecode'];
            $model->location_from = $request->data['from'];
            $model->location_to = $request->data['to'];
            $model->plus_amount = 0;
            $model->plus_percent = 0;
            $model->visibility_status = 1;
            $model->amount_by = ($request->amount_by == 'percent')?'rupee':'percent';
            $model->save();
        }else{
            $model->amount_by = ($request->amount_by == 'percent')?'rupee':'percent';
            $model->save();
        }
        return ['status'=>'true'];
    }

}
