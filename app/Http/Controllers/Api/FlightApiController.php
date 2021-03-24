<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FlightApi;
use App\Model\IndiaAirportCitiesCode;
use Session;
use Carbon\Carbon;
use App\Helpers\FlightLog;
use App\Model\Airline;
use GuzzleHttp\Client;


class FlightApiController extends Controller
{
    //testing
    //protected $api_url ="http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/";
    //live
    protected $api_url ="https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/";
    //protected $api_url ="http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/";

    public function getAirpotCodes(){
        
        $model = IndiaAirportCitiesCode::city_codes_in_json();
        return response()->json(['status'=>'success','codes'=>json_decode($model,true)],200);
    }
    
    public function searchResults(Request $request){
        // dump($request->all());
                $airlineCodes = [];
                $airlines = null;
                $action = 'flight';
                $tripType = $request->trip_type;
              //  Session::put('request_search',$request->all());
                $results = $this->searchFlight($request);
              //  dump($results);
                //dump(json_encode($request->all()));
                $logid = FlightLog::mobile_track_route(json_encode($request->all()), $results['Response']['TraceId'], $results['token_id'] , 'mobile' );
                $results['logid']=$logid;
                $errorStatus = false;
                $errorMessage = '';
                if($results['Response']['Error']['ErrorMessage'] != ''){
                    $errorStatus = true;
                    $errorMessage = $results['Response']['Error']['ErrorMessage'];
                      return response()->json($errorMessage, 200);
                }else{
                    // $airlineCodes = collect($results['Response']['Results'][0])->pluck('AirlineRemark','AirlineCode');
                    // dump($airlineCodes);
                     $airlineCodes = collect($results['Response']['Results'][0])->groupBy('AirlineCode')->keys()->toArray();
                     $airlines = Airline::whereIn('IATA',$airlineCodes)->get();
                }

                return response()->json($results, 200);
    }


     public function searchFlight($request){

            if($request->trip_type == 'round') {
                $trips_data =2;
            }
            elseif($request->trip_type == 'multi_city') {
                $trips_data =3;
            }
            else{
                $trips_data =1;
            }

            $json = [
                    'AdultCount' => $request->adult,
                    'ChildCount' => $request->child,
                    'InfantCount' => $request->infants,
                    'DirectFlight' => true,
                    // 'OneStopFlight' => true,
                    'JourneyType' => $trips_data,
                    'PreferredAirlines' => ''
                ];
            // $request->trip_type ='';
       // dd($request->all());
        if($request->trip_type == 'multi_city'){
            $json['JourneyType'] = 3;
            for($segment = 0; $segment < count($request->depart); $segment++){
                $depart = Carbon::parse($request->depart[$segment])->format('Y-m-d');
                $from = explode('-',$request->from[$segment]);
                $to = explode('-',$request->to[$segment]);

                $json['Segments'][] = [
                                    'Origin' => $from[1],
                                    'Destination' => $to[1],
                                    'FlightCabinClass' => 1,//$request->FlightCabinClass,
                                    'PreferredDepartureTime' => $depart.'T00:00:00',
                                    'PreferredArrivalTime' => $depart.'T00:00:00'
                ];
            }
           // dd($json);
        }

        if($request->trip_type == 'one_way' || $request->trip_type == 'round'){
            $depart = Carbon::parse($request->depart)->format('Y-m-d');
            // Session::put('depart_date',);
            $returning = Carbon::parse($request->returning)->format('Y-m-d');
             $from = explode('-',$request->from);
            $to = explode('-',$request->to);

            $this->set_passport_param( $from[1], $to[1]);

            // dd($from , $to);
            $json['Segments'][] = [
                                    'Origin' => $from[1],
                                    'Destination' => $to[1],
                                    'FlightCabinClass' => 1,//$request->FlightCabinClass,
                                    'PreferredDepartureTime' => $depart.'T00:00:00',
                                    'PreferredArrivalTime' => $depart.'T00:00:00'
                                ];
        }
        
        if($request->trip_type == 'round'){
            $json['Segments'][] = [
                'Origin' => $to[1],
                'Destination' => $from[1],
                'FlightCabinClass' => 1,//$request->FlightCabinClass,
                'PreferredDepartureTime' => $returning.'T00:00:00',
                'PreferredArrivalTime' => $returning.'T00:00:00'
            ];
        }
 // dd(1, $json);
        Session::put('search_request',$json);
        $results = FlightApi::search($json);
       // dd($results);
        // $results = FlightApi::search($json,'test');
       // Session::put('trace_id',$results['Response']['TraceId']);
        return $results;
    }


    protected function validateFlightSearchRequest($request){
        $validatedData = Validator::make($request->all(),[
            'adults' => 'required',
            'infant' => 'required',
            'childs' => 'required',
           'departing' => 'required',
           'from' => 'required',
            'to' => 'required',
            'class' => 'required',
            'trip_type' => 'required'
        ]);
        if($validatedData->fails()){
            return ['status'=>false,'errors'=>$validatedData->errors()];
        }else{
            return ['status'=>true,'errors'=>$validatedData->errors()];
        }
    }


    public function advance_flight_search(Request $request){

        $validate = $this->validateFlightSearchRequest($request);
        if($validate['status'] == false){
            return response()->json($validate,200);
        }
            
        $json = [
                'AdultCount' => $request->adults,
                'ChildCount' => $request->childs,
                'InfantCount' => $request->infant,
                'DirectFlight' => true,
                'OneStopFlight' => true,
                'PreferredAirlines' => ''
            ];
        if($request->trip_type == 'multi_city'){
            $json['JourneyType'] = 3;
        }elseif($request->trip_type == 'round'){
            $json['JourneyType'] = 2;
        }else{
            $json['JourneyType'] = 1;
        }


        if($request->has('trip_type')){
            if($request->trip_type == 'multi_city' || $request->trip_type == 'one_way' || $request->trip_type == 'round')
            {
                $json['JourneyType'] = 3;
                 // $preference_departure_time =  $depart.'T'.$depart_time;

                for($segment = 0; $segment < count($request->departing); $segment++){
                    $depart = Carbon::parse($request->departing[$segment])->format('Y-m-d');

                   $arrival_time =  $depart_time =  'T00:00:00';

                    if(!empty($request->preference_departure_time) && !empty($request->preference_departure_time[$segment])  ){

                            if($request->preference_departure_time[$segment]=='mor'){
                                $depart_time =  'T08:00:00';
                            }

                            if($request->preference_departure_time[$segment]=='aft'){
                                $depart_time = 'T14:00:00';
                            }

                            if($request->preference_departure_time[$segment]=='eve'){
                                $depart_time = 'T19:00:00';
                            }
                    }


                    if(!empty($request->preference_arrival_time) && !empty($request->preference_arrival_time[$segment])  ){

                            if($request->preference_arrival_time[$segment]=='mor'){
                                $arrival_time =  'T08:00:00';
                            }

                            if($request->preference_arrival_time[$segment]=='aft'){
                                $arrival_time = 'T14:00:00';
                            }

                            if($request->preference_arrival_time[$segment]=='eve'){
                                $arrival_time = 'T19:00:00';
                            }
                    }



                            $departure_date_time = $depart.''.$depart_time;
                            $arrival_date_time = $depart.''.$arrival_time;

                   

                    $json['Segments'][] = [
                                        'Origin' => $request->from[$segment],
                                        'Destination' => $request->to[$segment],
                                        'FlightCabinClass' => $request->class,
                                        'PreferredDepartureTime' => $departure_date_time,
                                        'PreferredArrivalTime' => $arrival_date_time
                    ];
                }
            }
        }else{
            return response()->json([
                'status' => 403,
                'message' => 'Required params are missing!'
            ],403);
        }
        $results = FlightApi::search($json);
        return response()->json($results, 200);
    }




    public function set_passport_param($from , $to){

        $country_code_from =  IndiaAirportCitiesCode::where('code', $from)->first()->countryCode;
        $country_code_to =  IndiaAirportCitiesCode::where('code', $to)->first()->countryCode;
        if($country_code_from =='IN' && $country_code_to=='IN' ){

            Session::put('domestic',1);

        }else{
            if(Session::has('domestic')){
                Session::forget('domestic');
            }
        }

        
    }

    public function fare_rule_quote_ssr(Request $request){

    // dd($request->all());
   // $token = FlightApi::authenticate('');
    $fare_quote = FlightApi::fare_quote($request->ResultIndex, $request->token , $request->TraceId );
       if(!empty($fare_quote['Response']['Error']['ErrorMessage'])){
            return response()->json(['fare_quote'=>$fare_quote], 200);
       }
       $data = FlightApi::fare_rule($request->ResultIndex, $request->token , $request->TraceId  );
       $ssr = FlightApi::ssr($request->ResultIndex, $request->token , $request->TraceId );

       return response()->json(['fare_rule'=>$data,'fare_quote'=>$fare_quote, 'ssr'=>$ssr], 200);

    }




    public function lcc_ticket(Request $request, $book_status = null){ 
         // demo
          //  $res_data = "This is live ticket booking  so it is block for testing.";//$request->all();
        //live
        // $token = FlightApi::authenticate();
         $jsonData = [

            "EndUserIp"=>  '103.232.151.175',//"202.14.121.198",
            "TokenId"=>$request->token,
            "TraceId"=> $request->TraceId,
            "ResultIndex"=>$request->ResultIndex,
             "Passengers"=> $request->Passengers
            ];

        $client = new Client();
        $res = $client->request('POST',$this->api_url.'Ticket',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        $res_data = json_decode($res->getBody()->getContents(),true);
        FlightLog::mobile_booking($request->logid, $res_data, $request->customer_id );

         return response()->json(['data'=>$res_data], 200);
    }


    public function non_lcc_book(Request $request){
        // demo
            $res_data = "This is live ticket booking  so it is block for testing.";//$request->all();
        //live
        //  $token = FlightApi::authenticate();
         $jsonData = [
            "EndUserIp"=>  "202.14.121.198",
            "TokenId"=>$request->token,
            "TraceId"=> $request->TraceId,
            "ResultIndex"=>$request->ResultIndex,
             "Passengers"=> $request->Passengers
            ];
        $client = new Client();
        $res = $client->request('POST',$this->api_url.'Book',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
         $res_data = json_decode($res->getBody()->getContents(),true);

          if($res_data['Response']['Error']['ErrorMessage'] != ''){
            
            return response()->json(['data'=>$res_data['Response']['Error']['ErrorMessage'], 200]); 
        }
        FlightLog::mobile_booking($request->logid, $res_data, $request->customer_id );


         return response()->json(['data'=>$res_data], 200);
    }



    
}
