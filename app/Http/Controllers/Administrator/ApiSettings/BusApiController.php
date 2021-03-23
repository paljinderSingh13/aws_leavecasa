<?php

namespace App\Http\Controllers\Administrator\ApiSettings;

use App\DataTables\Administrator\ApiSettings\BussesMarkupsDatatable;
use App\Model\Administrator\ApiSettings\BussesMarkup;
use App\Model\BusBookingSource;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Helpers\BusApi;

class BusApiController extends Controller
{
    protected $apiRequest;
    public function index( Request $request){

            //dd(123);


        /*$sources = $this->getSourcesList();
        $this->putSourceListInDB($sources);*/
        $result = BussesMarkup::all();
           foreach ($result as $key => $value) {
              // dump( $value->destination,  $value->des );
           }

        // dd($result);

        $sources = BusBookingSource::pluck('city_name','city_id');
        // $c = BusBookingSource::where('city_id',1435)->first(); //pluck('city_name','city_id');

        // dd($c);
        // return $datatable->render('administrator.api_settings.bus-booking.search',['sources'=>$sources,
        //     'result'=>$result]);
        return view('administrator.api_settings.bus-booking.search',['sources'=>$sources,'result'=>$result]);
    }

    public function get_bus_destination(Request $request){

        $data = BusApi::get_destination($request->source);
        return $data;
            }

    protected function putSourceListInDB($sources){
        $model = BusBookingSource::first();
        if($model == null) {
            foreach ($sources['cities'] as $key => $value) {
                $model = new BusBookingSource;
                $model->city_id = $value['id'];
                $model->city_name = $value['name'];
                if(@$value['state'] == '' || @$value['state'] == null){
                    $value['state'] = 'null';
                }
                $model->state_name = $value['state'];
                if(@$value['stateId'] == '' || @$value['stateId'] == null){
                    $value['stateId'] = 0;
                }
                $model->state_id = $value['stateId'];
                $model->save();
            }
        }
    }

    protected function validateBusMarkupRequest($request){
        $rules = [
            'source' => 'required',
            'destination' => 'required',
            'amount_by' => 'required',
            'amount_or_percent' => 'required'
        ];

        $this->validate($request, $rules);
    }

    public function saveBusMarkup(Request $request){
        $this->validateBusMarkupRequest($request);
        $model = new BussesMarkup;
        $model->fill($request->all());
        $model->save();
        \Session::flash('success','Success|Markup saved successfully!');
        return back();
    }

    public function delete($id){
        $model = BussesMarkup::find($id);
        if($model != null){
            $model->delete();
            \Session::flash('success','Success|Markup deleted successfully!');
            return back();
        }else{
            \Session::flash('error','Error|Unable to delete markup. Try again!');
            return back();
        }
    }

    public function searchBus(){
        if($request->isMethod('post')){
            $res = $this->apiRequest->get('availabletrips?source='.$request->source.'&destination='.$request->destination.'&doj='.$request->to);
            $result = json_decode($res->getBody()->getContents(),true);
            // dump($result);
          //  dd($result);
        }
        return view('administrator.api_settings.bus-booking.search',['sources'=>$sources,'result'=>$result]);
    }

    public static function getSourcesList($status = false){
        $object = new self;
        $object->setAuthKeys();
        $apiResponse = $object->apiRequest->get('sources');
        if($status){
            $cities = json_decode($apiResponse->getBody()->getContents(),true);
            return json_encode($cities['cities']);
        }
        return json_decode($apiResponse->getBody()->getContents(),true);
    }

    protected function setAuthKeys(){
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key'    => 'nfIhtSBzbhbYDCyJyfW1JnfCPNf9iX',
            'consumer_secret' => 'zKEYjXydHeKKMMzaxs5mDdgS2VqdhT',
            'token'           => '',
            'token_secret'    => ''
        ]);
        $stack->push($middleware);
        $client = new Client([
            'base_uri' => 'http://api.seatseller.travel',
            'handler' => $stack,
            'auth' => 'oauth'
        ]);
        $this->apiRequest = $client;
    }



}
