<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BusBookingSource;
use App\Helpers\BusApi;
use Carbon\Carbon;
use Session;

class BusApiController extends Controller
{



	public function getBusCities(){
        $model = BusBookingSource::get();
        $citiesList = [];
        foreach ($model as $key => $source) {
            $citiesList[] = [
                'city_code' => $source->city_id,
                'city_name' => $source->city_name,
                'state_name' => $source->state_name
            ];
        }
        return response()->json(['status'=>true,'sources'=>$citiesList]);
    }


    public function get_destination($source){
         $data = BusApi::get_destination($source);

    $city =  collect($data['cities'])->pluck('name','id');
        // foreach ( $data['cities'] as $key => $value) {
        //     $city[$value['name']]=null;
        // }


       return response()->json(['status'=>'success','results'=>$city]);

    }

    public function busSearch(Request $request ){

        

        $request->to = Carbon::parse($request->journey_date)->format('Y-m-d');
        $request->source = $request->bus_from;
        $request->destination = $request->bus_to;
        $busApi = BusApi::searchBus($request);
        return response()->json(['status'=>'success','results'=>$busApi]);
    }

    //  protected function validateBusSearch($request){
    //     $validatedData = Validator::make($request->all(),[
    //         'journey_date' => 'required',
    //         'bus_from' => 'required',
    //         'bus_to' => 'required'
    //     ]);
    //     if($validatedData->fails()){
    //         return ['status'=>false,'errors'=>$validatedData->errors()];
    //     }else{
    //         return ['status'=>true,'errors'=>$validatedData->errors()];
    //     }
    // }

    public function busLayout(Request $request){
        if($request->has('bus_id')){
            $seatDetails = BusApi::getSeats($request->bus_id);
            return response()->json(['status'=>'success','bus_id'=>$request->bus_id,'layout'=>$seatDetails]);
        }else{
            return response()->json(['status'=>'error','message'=>'Required params are missing!']);
        }
    }


    public function block_token(request $request){

        //dd($request->all());

         $response = BusApi::bookBus($request->all());
           // dump($request->all(), $response);
               $errorStatus = false;
                $errorMessage = '';
               
            if(!empty($response['status']) && $response['status']=="error"){
                $errorStatus = true;
                $errorMessage=  $response['message'];

                return response()->json(['status'=>'error','message'=>$errorMessage]);

            }
        return response()->json($response);
    }


    public function final_ticket(request $request){

           $response = BusApi::conirmTicket($request['block_key']);
          if(!empty($response['status']) && $response['status']=="error"){
                 return response()->json(['status'=>'error' , "data"=>$response['message']]);
            }
           // dump($response);
           $ticket_detail =  BusApi::tiket_detail($response['tin']);
           //$cid = Auth::guard('customer')->id();
           BusApi::bus_log($request['customer_id'], $response['tin'], json_encode($ticket_detail),'mobile' );
        
        return response()->json(['status'=>'success' , "tin"=> $response['tin'], "data"=>$ticket_detail]);

    }

    public function ticket_detail($tin){

        $ticket_detail =  BusApi::tiket_detail($tin);

        return response()->json(['status'=>'success' , "data"=>$ticket_detail]);



    }

}