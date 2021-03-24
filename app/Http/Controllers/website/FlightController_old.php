<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\IndiaAirportCitiesCode;
use App\Model\Airline;
use Carbon\Carbon;
use App\Helpers\FlightApi;
use GuzzleHttp\Client;
use DateTime;
use Illuminate\Support\MessageBag;
use Session;
use App\Helpers\FlightLog;
use App\Helpers\PaymentProcess;
use App\Model\Administrator\ApiSettings\FlightsMarkup;

// flightDetails function  redirect to booking form
//1 searchResults() for search
//2 

class FlightController extends Controller
{
//testing
   // protected $api_url ="http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/";

//live    
   protected $api_url ="https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/";

    public function flight_city($param){

    	// $data = IndiaAirportCitiesCode::where([['city_code','like',$param.'%'],['city_name','like', $param.'%']])->pluck('city_code','city_name');
        $data = IndiaAirportCitiesCode::where(function($query) use($param){
                    $query->where('city_name','like', $param.'%')
                        ->orWhere('city_code','like',$param.'%');
                    })->pluck('city_code','city_name');
                
        // foreach ($data as $key => $value) {
        //     $city[$key.' -'.$value] = null;
        // }
         $dataArray = [];
        foreach($data as $key => $value){
            $dataArray[$key.' -'.$value] = ['id'=>$key,'name'=>$key.' -'.$value];
        }


    	return response()->json($dataArray);
    }

    public function city_code($city_name){

    	return IndiaAirportCitiesCode::where('city_name', $city_name)->first()->city_code;
    }

    public function searchResults(Request $request){

        if(session::has('markup')) {
            Session()->forget('markup');
        }

        // dump(Session::get('flight_success_data'));
        // dd($request->all());
        // dd(json_encode($request->all()));
        $airlineCodes = [];
                $airlines = null;
                $action = 'flight';
                $tripType = $request->trip_type;
                Session::put('request_search',$request->all());

                $results = $this->searchFlight($request);

                // dump($results);

                // dump($results['Response']['Results'][0][0]['Segments']);
                 
                FlightLog::token_track();
               // d($results);
                // dd($results , );
               // $save=
                $errorStatus = false;
                $errorMessage = '';
                if($results['Response']['Error']['ErrorMessage'] != ''){
                    $errorStatus = true;
                    $errorMessage = $results['Response']['Error']['ErrorMessage'];
                }else{
                    // $airlineCodes = collect($results['Response']['Results'][0])->pluck('AirlineRemark','AirlineCode');
                    // dump($airlineCodes);
                     $airlineCodes = collect($results['Response']['Results'][0])->groupBy('AirlineCode')->keys()->toArray();
                     $airlines = Airline::whereIn('IATA',$airlineCodes)->get();
                }

                // if( $tripType == 'round' && count($results['Response']['Results']) ==1 ) {
                //     return view('website.pages.air_search.international_round_search',['results'=>$results,'action'=>$action,'airlines'=>$airlines,'tripType'=>$tripType,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);

                // }


                //  if( $tripType == 'round' && count($results['Response']['Results']) ==2 ) {
                //     return view('website.pages.air_search.domestic_round',['results'=>$results,'action'=>$action,'airlines'=>$airlines,'tripType'=>$tripType,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);

                // }


                //  dump($airlines);
                return view('website.pages.search-result-flight',['results'=>$results,'action'=>$action,'airlines'=>$airlines,'tripType'=>$tripType,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);
    }


     protected function searchFlight($request){

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
                     'OneStopFlight' => false,
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
                                    'FlightCabinClass' => 1,
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

            //dd($from , $to);
            if( !empty($from[1]) and !empty($to[1]) ){

            $this->set_passport_param( $from[1], $to[1]);
            }

            // dd($from , $to);
            $json['Segments'][] = [
                                    'Origin' => $from[1],
                                    'Destination' => $to[1],
                                    'FlightCabinClass' => 1,
                                    'PreferredDepartureTime' => $depart.'T00:00:00',
                                    'PreferredArrivalTime' => $depart.'T00:00:00'
                                ];
        }
        
        if($request->trip_type == 'round'){
            $json['Segments'][] = [
                'Origin' => $to[1],
                'Destination' => $from[1],
                'FlightCabinClass' =>1, 
                'PreferredDepartureTime' => $returning.'T00:00:00',
                'PreferredArrivalTime' => $returning.'T00:00:00'
            ];
        }
// $request->FlightCabinClass,
// dd($json);

        Session::put('search_request',$json);
        $results = FlightApi::search($json);
        //dd($results);
        Session::put('trace_id',$results['Response']['TraceId']);
        return $results;
    }

    public function set_passport_param($from , $to){
 
        $country_code_from =  IndiaAirportCitiesCode::where('city_code', $from)->first()->countryCode;
        $country_code_to =  IndiaAirportCitiesCode::where('city_code', $to)->first()->countryCode;


 
        if($country_code_from =='IN' && $country_code_to=='IN' ){
            Session::put('domestic',1);
        }else{
            if(Session::has('domestic')){
                Session::forget('domestic');
            }
        }
    }

public function advance_search(Request $request){
    // dd($request->all());
if($request->trip_type == 'round')
 {$trips_data =2;}
elseif($request->trip_type == 'multi_city')
 {$trips_data =3;} 
 else 
 {$trips_data =1;}      
    $action='flight';
    $search = Session::get('search_request');
    $trip_data = [1=>'one_way',2=>'round' ,3=>'multi_city'];
    $tripType = $trips_data;//$search['JourneyType'];
    $airlines=null;
    if(!empty($request->PreferredAirlines)){;
    $search['PreferredAirlines']=  $request->PreferredAirlines; 
    }
     if(!empty($request->DirectFlight)){;
    $search['DirectFlight']=  $request->DirectFlight; 
    }
     if(!empty($request->OneStopFlight)){;
    $search['OneStopFlight']=  $request->OneStopFlight; 
    }


    if(!empty($request->preferClass) || !empty($request->preferDepartureTime) || !empty($request->preferArrivalTime)) {
       
       for ($i=0; $i < count($search['Segments']); $i++) { 
            if(!empty($request->preferClass)){
               $search['Segments'][$i]['FlightCabinClass']=$request->preferClass;
            }
            if(!empty($request->preferDepartureTime)){

                if($request->preferDepartureTime=='mor'){
                    $new_time = str_replace('00:00:00', '08:00:00', $search['Segments'][$i]['PreferredDepartureTime']);
                }

                if($request->preferDepartureTime=='aft'){
                    $new_time = str_replace('00:00:00', '14:00:00', $search['Segments'][$i]['PreferredDepartureTime']);
                }

                if($request->preferDepartureTime=='eve'){
                    $new_time = str_replace('00:00:00', '19:00:00', $search['Segments'][$i]['PreferredDepartureTime']);
                }

                $search['Segments'][$i]['PreferredDepartureTime']=$new_time;   
            }

            if(!empty($request->preferArrivalTime)){

                dump($request->preferArrivalTime);

                if($request->preferArrivalTime=='mor'){
                    $new_time = str_replace('00:00:00', '08:00:00', $search['Segments'][$i]['PreferredArrivalTime']);
                }

                if($request->preferArrivalTime=='aft'){
                    $new_time = str_replace('00:00:00', '14:00:00', $search['Segments'][$i]['PreferredArrivalTime']);
                }

                if($request->preferArrivalTime=='eve'){
                    $new_time = str_replace('00:00:00', '19:00:00', $search['Segments'][$i]['PreferredArrivalTime']);
                }

                $search['Segments'][$i]['PreferredArrivalTime']=$new_time;   
            }

        } 
    }
        

    $results = FlightApi::search($search);
    $errorStatus = false;
                $errorMessage = '';
                if($results['Response']['Error']['ErrorMessage'] != ''){
                    $errorStatus = true;
                    $errorMessage = $results['Response']['Error']['ErrorMessage'];
                }else{

                    // $airlineCodes = collect($results['Response']['Results'][0])->pluck('AirlineRemark','AirlineCode');
                    // dump($airlineCodes);
                     $airlineCodes = collect($results['Response']['Results'][0])->groupBy('AirlineCode')->keys()->toArray();
                     $airlines = Airline::whereIn('IATA',$airlineCodes)->get();
                }
            // dd($results);
                return view('website.pages.search-result-flight',['results'=>$results,'action'=>'flight','airlines'=>$airlines,'tripType'=>$request->trip_type,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);


}   

    public function flightDetails(Request $request){
       
        if($request->isMethod('post')){
            Session::put('drequest', $request->all());
        }
        else{
                $request = Session::get('drequest');
        }

        // dd($request->all());
            $flight_details = json_decode($request['flight_details'], true);
         //  dump($flight_details);
            $requestData['ResultIndex'] = $flight_details['ResultIndex'];//$fare_quote['Response']['Results'];

            // if($request->isMethod('post')){
            //     $fare_rule  = FlightApi::fare_rule($requestData['ResultIndex']);
            //     Session::put('fare_rule', $fare_rule); 
            // }else{
            //      $fare_rule = Session::get('fare_rule');
            // }

            $requestData = Session::get('request_search');
// dd($requestData);
            if(!empty($request["trip_type"]) && $request["trip_type"] == "multi_way"){
                $requestData['trip_type'] = 'multi_city';
            }

            if($requestData['trip_type'] == 'one_way'){

                Session::put('rindex', $flight_details['ResultIndex']);
                Session::put('selected_flight',$request['flight_details']);
                $requestData['ResultIndex'] = $flight_details['ResultIndex'];
                
                 // Session::put('fare_rule', $fare_rule);

            }elseif($requestData['trip_type'] == 'round'){
                Session::put('flight_one',$request['depart']);
                Session::put('flight_two',$request['return']);

                $return = json_decode($request['depart'], true);
                $depart = json_decode($request['return'], true);

                $resutIndex[] = $return['ResultIndex'];  
                $resutIndex[] =  $depart['ResultIndex'];

                $requestData['ResultIndex'] = $resutIndex;
               // $fare_rule  = FlightApi::fare_rule($resultIndex);
            // Session::put('fare_rule', $fare_rule);
                
                //dump(2,$requestData);

            }elseif($requestData['trip_type'] == 'multi_city'){
                Session::put('selected_flights',$request['flights']);
                Session::put('selected_flights1', $flight_details);
                $requestData['ResultIndex'] = $flight_details['ResultIndex'];
               
                 // Session::put('fare_rule', $fare_rule);
            } 
        // }else{
        //     $requestData = Session::get('request_search');
        // }




         // $requestData['ResultIndex'] = $flight_details['ResultIndex'];


 // dump(3, $requestData);

        return view('website.pages.flight-details',['request_data'=>$requestData]);//, 'fare_rule'=>$fare_rule]);
    }


protected function set_passenger_detail($request, $fare, $fare_quote){

   // dump();
$AirlineCode = $fare_quote['Response']['Results']['Segments'][0][0]['Airline']['AirlineCode'];
    for($i=0; $i< count($request['title']); $i++ ) {

       $passengerData = [ 
                        'Title' => $request['title'][$i],
                        'FirstName'=>  $request['firstname'][$i],
                        'LastName'=> $request['lastname'][$i],
                        'PaxType'=> $request['PaxType'][$i],
                        'DateOfBirth'=>$request['date_of_birth'][$i].'T00:00:00',
                        'Gender'=> ($request['gender'][$i] == 'Male')?'1':'2',
                        'AddressLine1'=>$request['AddressLine1'],
                        'City'=>'Amritsar',
                        'CountryCode'=>'IN',
                        'CountryName'=>'India',
                        'Nationality'=>'IN',
                        'ContactNo'=>$request['contact'],
                        'Email'=>$request['email'],
                        'IsLeadPax'=> $request['IsLeadPax'][$i],
                        'GSTCompanyAddress'=>'',
                        'GSTCompanyContactNumber'=>'',
                        'GSTCompanyName'=>'',
                        'GSTNumber'=>'',
                        'GSTCompanyEmail'=>'',
                         'PassportNo'=>(!empty($request['PassportNo'][$i]))?$request['PassportNo'][$i]:'',
                         'PassportExpiry'=>(!empty($request['PassportExpiry'][$i]))?$request['PassportExpiry'][$i]:'',
                        "Fare"=> [
                                "Currency"=>"IN",
                                "BaseFare"=> $fare[$request['PaxType'][$i]]['BaseFare'],
                                "Tax"=> $fare[$request['PaxType'][$i]]['Tax'],
                                "YQTax"=> $fare[$request['PaxType'][$i]]['YQTax'],
                                "AdditionalTxnFeePub"=> $fare[$request['PaxType'][$i]]['AdditionalTxnFeePub'],
                                "AdditionalTxnFeeOfrd"=> $fare[$request['PaxType'][$i]]['AdditionalTxnFeeOfrd'],
                                "OtherCharges"=> $fare_quote['Response']['Results']['Fare']['OtherCharges'],
                                "Discount"=> $fare_quote['Response']['Results']['Fare']['Discount'],
                                "PublishedFare"=>  $fare_quote['Response']['Results']['Fare']['PublishedFare'],
                                "OfferedFare"=> $fare_quote['Response']['Results']['Fare']['OfferedFare'],
                                "TdsOnCommission"=>$fare_quote['Response']['Results']['Fare']['TdsOnCommission'],
                                "TdsOnPLB"=> $fare_quote['Response']['Results']['Fare']['TdsOnPLB'],
                                "TdsOnIncentive"=> $fare_quote['Response']['Results']['Fare']['TdsOnIncentive'],
                                "ServiceFee"=> $fare_quote['Response']['Results']['Fare']['ServiceFee']
                               ]
                        ];

                    // if($AirlineCode=="SG"){
                    //     $passengerData['Name'] = $passengerData['FirstName'].' '.$passengerData['LastName'];
                    //     unset($passengerData['FirstName'], $passengerData['LastName'] );
                    // }
                $passenger[] = $passengerData;
    }

    //dump($passenger);
    return $passenger;
}




    protected function book($request, $resultIndex){

        //d(Session::all());
        $search_request = Session::get('request_search');
       // dd($search_request, $request->all(), $resultIndex);
        $fare_rule  = FlightApi::fare_rule($resultIndex);
        if($search_request['trip_type']=="round" &&  $request['resultIndex'][1] == $resultIndex){
            $fare_quote = Session::get($request['resultIndex'][1]);
        }else{
            $fare_quote = FlightApi::fare_quote($resultIndex);
        }

        if(!empty($fare_quote['Response']['Error']['ErrorMessage'])){
            return  $fare_quote;
            //view('website.pages.flight_error',['error_message'=>$fare_quote['Response']['Error']['ErrorMessage']] );
            //dd('fare Qutoe provided by supplier'. $fare_quote['Response']['Error']['ErrorMessage']);
        }
        
        if($search_request['trip_type']=="round" &&  $request['resultIndex'][0] == $resultIndex){
                if(Session::has($request['resultIndex'][1])){
                     Session::forget($request['resultIndex'][1]);
                }
            $roundFareQuote = FlightApi::fare_quote($request['resultIndex'][1]);
            if(!empty($roundFareQuote['Response']['Error']['ErrorMessage'])){
                return $roundFareQuote;
                    //dd('fare second Qutoe provided by supplier');
            }

              Session::put($request['resultIndex'][1], $roundFareQuote);
            }
        // dump($fare_quote);
            $ssr = FlightApi::ssr($resultIndex);
            // dump($ssr);
            $FareBreakdown = $fare_quote['Response']['Results']['FareBreakdown'];
            
            $fare = FlightApi::calculate_fare($FareBreakdown);
        // dd($fare, $request->all());
       $passenger = $this->set_passenger_detail($request, $fare, $fare_quote);

      // dump( $passenger);

        $jsonData = [
            "EndUserIp"=>  "202.14.121.198",
            "TokenId"=> Session::get('flight_token'),
            "TraceId"=> Session::get('trace_id'),
            "ResultIndex"=>$resultIndex,
             "Passengers"=> $passenger
            ];

//dd($jsonData);
            // dd(json_encode($jsonData));
$checkLCC =  $fare_quote['Response']['Results']['IsLCC'];
  if($checkLCC == true) {
    $client = new Client();
        $res = $client->request('POST',$this->api_url.'Ticket',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
         $res_data = json_decode($res->getBody()->getContents(),true);
         Session::put('flight_success_data',$res_data);
         return $res_data;// view('website.pages.flight-booking-success');         
   // dump(1,$res_data);
  } 
  else {

        $client = new Client();
        $res = $client->request('POST',$this->api_url.'Book',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
         $res_data = json_decode($res->getBody()->getContents(),true);

         //Session::put('bok_res',  $res_data);
        //dump(2,$res_data);

 if(!empty($res_data['Response']['Error']['ErrorMessage'])){
        dd($res_data['Response']['Error']['ErrorMessage']);
    }
      
    $b_res = $res_data['Response']['Response'];
    // dump($b_res);
    Session::put('boking_id',  $b_res['BookingId']);
    $b_res['BookingId'];

foreach ($b_res['FlightItinerary']['Passenger'] as $key => $value) {
    $passport[] = ['PaxId'=>  $value['PaxId'], 'DateOfBirth'=>$value['DateOfBirth'] ,
                    'PassportNo'=>'', 'PassportExpiry'=>''];
}
        $jsonData1 = [
            "EndUserIp"=> "202.14.121.198",
            "TokenId"=> Session::get('flight_token'),
            "TraceId"=> Session::get('trace_id'),
            "PNR"=>$b_res['PNR'],
            "BookingId"=>$b_res['BookingId'],
            "Passport" => $passport
            ];

        $client1 = new Client();
        $res1 = $client1->request('POST',$this->api_url.'ticket',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData1
        ]);
         $res_data1 = json_decode($res1->getBody()->getContents(),true);
          //dump(3,$res_data1);
        return $res_data1; //view('website.pages.flight-booking-success');         
//        
        }

    }


        protected function check_children_infant_age($request){
            
            for($i=0; $i< count($request['title']); $i++ ) {
                if(in_array($request['PaxType'][$i],[2,3])){
                    
                    dump($request['date_of_birth'][$i]);
                    $bday = new DateTime($request['date_of_birth'][$i]); // Your date of birth
                    $today = new Datetime(date('Y-m-d'));
                    $age = $today->diff($bday)->y;
                    if($request['PaxType'][$i] ==2 && $age > 12 ){
                        
                        return 2;
                        
                    }elseif($request['PaxType'][$i] ==3 && $age > 2){
                        
                        return 3;
                    }
                    
                 //echo ' Your age : %d years';
                }
            }
            
           // return $age;

    //   $passengerData = [ 
    //                     'Title' => $request['title'][$i],
    //                     'FirstName'=>  $request['firstname'][$i],
    //                     'LastName'=> $request['lastname'][$i],
    //                     'PaxType'=> $request['PaxType'][$i],
    //                     'DateOfBirth'=>$request['date_of_birth'][$i].'T00:00:00',
                // $bday = new DateTime('11.4.1987'); // Your date of birth
                // $today = new Datetime(date('m.d.y'));
                // $diff = $today->diff($bday);
                // printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
                // printf("\n");   
        }



        


    protected function tickets( $booking_data){

        //$booking_data = Session::get('booking_data');
        //dd('ticket',  $booking_data);
        // ['resultIndex'=>$resultIndex,'publishedFare'=>$publishedFare, 'passenger'=>$passenger, 'checkLCC'=> $fare_quote['Response']['Results']['IsLCC']];
        $resultIndex = $booking_data['resultIndex']; 
        $passenger   = $booking_data['passenger']; 
        $checkLCC    = $booking_data['checkLCC'];//['Results']['IsLCC'];

        $jsonData = [
            "EndUserIp"=>  "202.14.121.198",
            "TokenId"=> Session::get('flight_token'),
            "TraceId"=> Session::get('trace_id'),
            "ResultIndex"=>$resultIndex,
             "Passengers"=> $passenger
            ];
//dd($jsonData);
            // dd(json_encode($jsonData));
//$checkLCC =  $fare_quote['Response']['Results']['IsLCC'];
  if($checkLCC == true) {
    $client = new Client();
        $res = $client->request('POST',$this->api_url.'Ticket',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
         $res_data = json_decode($res->getBody()->getContents(),true);
         Session::put('flight_success_data',$res_data);
         return $res_data;// view('website.pages.flight-booking-success');         
   // dump(1,$res_data);
  } 
  else{
        $client = new Client();
        $res = $client->request('POST',$this->api_url.'Book',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
         $res_data = json_decode($res->getBody()->getContents(),true);
         //Session::put('bok_res',  $res_data);
        //dump(2,$res_data);
 if(!empty($res_data['Response']['Error']['ErrorMessage'])){
            dd($res_data['Response']['Error']['ErrorMessage']);
        }
      
    $b_res = $res_data['Response']['Response'];
    // dump($b_res);
    Session::put('boking_id',  $b_res['BookingId']);
    $b_res['BookingId'];

foreach ($b_res['FlightItinerary']['Passenger'] as $key => $value) {
    $passport[] = ['PaxId'=>  $value['PaxId'], 'DateOfBirth'=>$value['DateOfBirth'] ,
                    'PassportNo'=>'', 'PassportExpiry'=>''];
}
        $jsonData1 = [
            "EndUserIp"=> "202.14.121.198",
            "TokenId"=> Session::get('flight_token'),
            "TraceId"=> Session::get('trace_id'),
            "PNR"=>$b_res['PNR'],
            "BookingId"=>$b_res['BookingId'],
            "Passport" => $passport
            ];

        $client1 = new Client();
        $res1 = $client1->request('POST',$this->api_url.'ticket',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData1
        ]);
         $res_data1 = json_decode($res1->getBody()->getContents(),true);
          //dump(3,$res_data1);
        return $res_data1; //view('website.pages.flight-booking-success');         
//        
        }
    }

 protected function single_fare_quote_rule_ssr($request, $resultIndex){

            $search_request = Session::get('request_search');
       // dd($search_request, $request->all(), $resultIndex);
            $fare_rule  = FlightApi::fare_rule($resultIndex);
            
            $fare_quote = FlightApi::fare_quote($resultIndex);

           // dump($search_request, $fare_quote);

            if(!empty($fare_quote['Response']['Error']['ErrorMessage'])){
                return  $fare_quote;
            //view('website.pages.flight_error',['error_message'=>$fare_quote['Response']['Error']['ErrorMessage']] );
            //dd('fare Qutoe provided by supplier'. $fare_quote['Response']['Error']['ErrorMessage']);
             }
            // dump($fare_quote);
            $ssr = FlightApi::ssr($resultIndex);
            // dump($ssr);
            $FareBreakdown = $fare_quote['Response']['Results']['FareBreakdown'];
            $fare = FlightApi::calculate_fare($FareBreakdown);
        // dd($fare, $request->all());
            $passenger = $this->set_passenger_detail($request, $fare, $fare_quote);
            $publishedFare =null;
            if(!empty($fare_quote['Response']['Results']['Fare']['PublishedFare'])){
                $publishedFare = $fare_quote['Response']['Results']['Fare']['PublishedFare'];
            }
      // dump( $passenger);
           return  ['resultIndex'=>$resultIndex, 'publishedFare'=>$publishedFare, 'passenger'=>$passenger, 'checkLCC'=> $fare_quote['Response']['Results']['IsLCC']];

         
       }


    public function flight_payment_response(Request $request){
           // dump($request->all());
// test
        // $preserve_data = Session::get('booking_data');
        // foreach ($preserve_data as $key => $value) {
        //     if(empty($value['Response']['Error']['ErrorMessage'])){
        //        $ticket_detail =  $data[] = $this->tickets($value);
        //        $booking_id[] = $ticket_detail['Response']['Response']['BookingId'];
        //     }
        //     else{
        //         FlightLog::error_log( json_encode($sucResp['Response']['Error']));
        //         $data=$preserve_data;
        //         }
        // }

        //     FlightLog::booking($booking_id, $data);
        
        //     return view('website.pages.flight-booking-success', ['ticket_data' => $data]); 
// test end

         if($request['f_code'] == 'Ok'){

            $preserve_data = Session::get('booking_data');

        foreach ($preserve_data as $key => $value) {
            # code...
           

             if(empty($value['Response']['Error']['ErrorMessage'])){
               $ticket_detail =  $data[] = $this->tickets($value);
               $booking_id[] = $ticket_detail['Response']['Response']['BookingId'];
               FlightLog::booking($booking_id, $data);
            }
            else{
                FlightLog::error_log( json_encode($sucResp['Response']['Error']));
                $data=  $preserve_data;
                }
        }

        
        

            $results = Session::put('flight_success_data',$data);
            return view('website.pages.flight-booking-success', ['ticket_data' => $data]); 

            // return $this->final_book();
        }else{
            // dd($request->all());

            return view('frontend.pages.payment_failed', ['desc'=>$request['desc']]);
        }
    }


    public function ticket_by_wallet($amount){

          $id =   PaymentProcess::debit_wallet_balance($amount);
        dd('Successfully deduct fare amount  from wallet '.$id);

        $preserve_data = Session::get('booking_data');

            foreach ($preserve_data as $key => $value) {# code...
                 if(empty($value['Response']['Error']['ErrorMessage'])){
                   $ticket_detail =  $data[] = $this->tickets($value);
                   $booking_id[] = $ticket_detail['Response']['Response']['BookingId'];
                   FlightLog::booking($booking_id, $data);
                }
                else{
                    FlightLog::error_log( json_encode($sucResp['Response']['Error']));
                    $data=  $preserve_data;
                    }
            }
            $results = Session::put('flight_success_data',$data);
        return view('website.pages.flight-booking-success', ['ticket_data' => $data]);
    }






    public function bookFlightNow(Request $request, $book_status = null,  MessageBag $message_bag){

       
   
     if(is_array($request['resultIndex']))
         { 
            // dd($request->all());
            $preserve_data[] = $this->single_fare_quote_rule_ssr($request, $request['resultIndex'][0] );
            $preserve_data[] = $this->single_fare_quote_rule_ssr($request, $request['resultIndex'][1] );

             Session::put('booking_data', $preserve_data);

             if(!empty($preserve_data[0]['publishedFare'])  && !empty($preserve_data[1]['publishedFare']) ){

                    $amount = $preserve_data[0]['publishedFare'] +  $preserve_data[1]['publishedFare'];
                }else{
                    $amount = 51;
                }
         }
         else{
            $preserve_data[] = $this->single_fare_quote_rule_ssr($request, $request['ResultIndex'] );
            Session::put('booking_data', $preserve_data);
                            $search_request = Session::get('request_search');

                            if(!empty($preserve_data[0]['publishedFare'])){

                                $amount = $preserve_data[0]['publishedFare'];


                            }else{
                                $amount = 51;
                            }

                            // dd($amount , gettype($amount),  $preserve_data);
                // $amount = $preserve_data[0]['publishedFare'];

         }

         if(!empty($request['use_wallet'])){

            return redirect()->route('use.wallet.flight',['amount'=>$amount]);
         }

          // dd( $preserve_data); //test
        // return redirect()->route('flight.pay');

        $key = array_search("true",$request['IsLeadPax']);

        $name = $request['firstname'][$key];
       // Session::put('booking_request', $request);

            $paymentOptions = [];
            $paymentOptions['payment_for'] ="airTicket";
            $paymentOptions['amount'] =   $amount;//$amount;//$request->price;
            $paymentOptions['return_to'] = route('flight.pay');
            $paymentOptions['client_code'] =  13;//$customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $name;
            $paymentOptions['customer_details']['customer_email'] =$request['email'];
            $paymentOptions['customer_details']['customer_mobile'] = $request['contact'];
            $paymentOptions['customer_details']['billing_address'] = $request['AddressLine1'];
            $paymentOptions['customer_details']['customer_account_id'] = 1;



// dd($paymentOptions ,  $name,  $preserve_data['publishedFare'], $request->all());
            $url = PaymentProcess::process($paymentOptions);
            return redirect($url);

        //dump(Session::get('booking_request'),  $request->all());

        // dd(123);


        return view('website.pages.error',['block'=>'yes']);
        
        // dd($request->all());
        
        // if($this->check_children_infant_age($request)==2){
        //     $message_bag->add('child', 'Children must be less 12');
           
        //   return back()->withErrors($message_bag);
            
        // }elseif($this->check_children_infant_age($request)==3){
            
        //     $message_bag->add('infant', 'Infant must be less 2');
           
        //   return back()->withErrors($message_bag)->withInput();
        // }
 
        $errors = false;
        if(is_array($request['resultIndex']))
         {
             foreach ($request['resultIndex'] as $key => $value) {
                $errors = false;
                $sucResp = $res[] = $this->book($request, $value );

               // dump(1,  $sucResp);
                if(!empty($sucResp['Response']['Error']['ErrorMessage']) ){
                    FlightLog::error_log( json_encode($sucResp['Response']['Error']));
                    $errors = true;
                }elseif( !empty($sucResp['Response']['Response']['Message'] )){
                     FlightLog::error_log( $sucResp['Response']['Response']['Message']);
                    $errors = true;
                }
                else{
                 $bookingId[] = $sucResp['Response']['Response']['BookingId'];
                }
             }
         }else{
           $sucResp = $res[] = $this->book($request, $request['ResultIndex']);
          

                if(!empty($sucResp['Response']['Error']['ErrorMessage']) ){
                    FlightLog::error_log( json_encode($sucResp['Response']['Error']));
                    $errors = true;
                }elseif( !empty($sucResp['Response']['Response']['Message'] )){
                     FlightLog::error_log( $sucResp['Response']['Response']['Message']);
                    $errors = true;
                }else{
                    
                 $bookingId = $sucResp['Response']['Response']['BookingId'];
                }
          
         }
   //dump($res);
        $results = Session::put('flight_success_data',$res);

        if(empty($errors)){
            FlightLog::booking($bookingId, $res);
        }
        return view('website.pages.flight-booking-success', $res=[]); 

        //dd($res);
               
    }


}




