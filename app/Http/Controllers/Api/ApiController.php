<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FlightApi;
use App\Model\IndiaAirportCitiesCode;
use Validator;
use Carbon\Carbon;
use App\Model\BusBookingSource;
use App\Helpers\BusApi;
use App\Model\CustomerWallet;
use GuzzleHttp\Client;
use App\Model\HotelInfo;

class ApiController extends Controller
{

protected $hotel_url = 'https://api-sandbox.grnconnect.com/api/v3//hotels/'; //leavecasa@562  nitesha@acmemedia.in
protected $hotel_key = 'b12092d579e8795a77c3abe759d6185f';
    
//live
    //protected $hotel_url = 'https://v4-api.grnconnect.com/api/v3/hotels/';
    //protected $hotel_key = '7a0ad1b28d1b56ec461f9bd0c3034d86';


    public function searchFlightResult(Request $request){

        $validate = $this->validateFlightSearchRequest($request);
        if($validate['status'] == false){
            return $validate;
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
            if($request->trip_type == 'multi_city' || $request->trip_type == 'one_way' || $request->trip_type == 'round'){
                $json['JourneyType'] = 3;
                for($segment = 0; $segment < count($request->departing); $segment++){
                    $depart = Carbon::parse($request->departing[$segment])->format('Y-m-d');
                    $json['Segments'][] = [
                                        'Origin' => $request->from[$segment],
                                        'Destination' => $request->to[$segment],
                                        'FlightCabinClass' => $request->class,
                                        'PreferredDepartureTime' => $depart.'T00:00:00',
                                        'PreferredArrivalTime' => $depart.'T00:00:00'
                    ];
                }
            }/*elseif($request->trip_type == 'one_way' || $request->trip_type == 'round'){
                $depart = Carbon::parse($request->departing)->format('Y-m-d');
                $arrive = Carbon::parse($request->returning)->format('Y-m-d');
                $from = $request->from;
                $to = $request->to;
                $json['Segments'][] = [
                                        'Origin' => $from,
                                        'Destination' => $to,
                                        'FlightCabinClass' => 1,
                                        'PreferredDepartureTime' => $depart.'T00:00:00',
                                        'PreferredArrivalTime' => $depart.'T00:00:00'
                                    ];
            }
            if($request->trip_type == 'round'){
                $json['Segments'][] = [
                    'Origin' => $to[1],
                    'Destination' => $from[1],
                    'FlightCabinClass' => 1,
                    'PreferredDepartureTime' => $depart.'T00:00:00',
                    'PreferredArrivalTime' => $depart.'T00:00:00'
                ];
            }*/
        }else{
            return response()->json([
                'status' => 403,
                'message' => 'Required params are missing!'
            ],403);
        }
        $results = FlightApi::search($json);
        return response()->json(['status'=>'success','results'=>$results]);
    }


    public function advance_flight_search(Request $request){

        $validate = $this->validateFlightSearchRequest($request);
        if($validate['status'] == false){
            return $validate;
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
        return response()->json(['status'=>'success','results'=>$results]);
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

    public function getAirpotCodes(){
        $model = IndiaAirportCitiesCode::city_codes_in_json();
        return response()->json(['status'=>'success','codes'=>json_decode($model,true)],200);
    }

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

    public function busSearch(Request $request){
        $validate = $this->validateBusSearch($request);
        if($validate['status'] == false){
            return $validate;
        }
        $request->to = Carbon::parse($request->journey_date)->format('Y-m-d');
        $request->source = $request->bus_from;
        $request->destination = $request->bus_to;
        $busApi = BusApi::searchBus($request);
        return response()->json(['status'=>'success','results'=>$busApi]);
    }

    protected function validateBusSearch($request){
        $validatedData = Validator::make($request->all(),[
            'journey_date' => 'required',
            'bus_from' => 'required',
            'bus_to' => 'required'
        ]);
        if($validatedData->fails()){
            return ['status'=>false,'errors'=>$validatedData->errors()];
        }else{
            return ['status'=>true,'errors'=>$validatedData->errors()];
        }
    }

    public function busLayout(Request $request){
        if($request->has('bus_id')){
            $seatDetails = BusApi::getSeats($request->bus_id);
            return response()->json(['status'=>'success','bus_id'=>$request->bus_id,'layout'=>$seatDetails]);
        }else{
            return response()->json(['status'=>'error','message'=>'Required params are missing!']);
        }
    }

    public function bookFlight(Request $request){
        $validate = $this->validateBookFlight($request);
        if($validate['status'] == 'error'){
            return response()->json(['status'=>'error','message'=>$validate['message']]);
        }
        $result = FlightApi::bookFlightFromApi($request);
        return response()->json($result);
    }


    protected function validateBookFlight($request){
        if($request->has('result_index') && $request->has('customers') && $request->has('journey_type') && $request->has('trace_id')){
            return ['status'=>'success','message'=>''];
        }else{
            return ['status'=>'error','message'=>'Required params are missing!'];
        }
    }

    public function getWalletAmount($userid){
        $walletModel = CustomerWallet::where('user_id',$userid)->first();
        if($walletModel == null){
            return response()->json(['status'=>'success','user_id'=>$userid,'amount'=>0]);
        }else{
            return response()->json(['status'=>'success','user_id'=>$userid,'amount'=>$walletModel->amount]);
        }
    }

    public function updateWallet(Request $request){
        if($request->has('user_id') && $request->user_id != '' && $request->has('amount') && $request->amount != ''){
            $model = CustomerWallet::firstOrNew(['user_id'=>$request->user_id]);
            $model->amount = $request->amount;
            $model->save();
            return response()->json(['status'=>'success','message'=>'Wallet updated successfully!']);
        }else{
            return response()->json(['status'=>'error','message'=>'Required params are missing!']);
        }
    }



    protected function hotel_availablity($request , $hotel_codes){

            $jsonData = [
            'hotel_codes' => $hotel_codes,
            'checkin' => Carbon::parse($request->checkin)->format('Y-m-d'),
            'checkout' => Carbon::parse($request->checkout)->format('Y-m-d'),
            'client_nationality' => 'IN',
            'more_results' => true,
            "cutoff_time"=> 50000,
            "response"=>'fast',
            "currency"=> "INR",
            'hotel_info' => true,
            'rates' => 'concise',
            'hotel_category' => [2,7]
        ];

        $start = 1;
        // foreach ($request->adults as $rkey => $rvalue) {
        //     $rooms[$rkey]['adults'] = $rvalue;
        //     if(isset($request['ch_age'][$start])){
        //         $rooms[$rkey]['children_ages'] = $request['ch_age'][$start];
        //     }
        //     $start++;
        //     // $rooms[$start]['children_ages'] = $rvalue['adults'];
        // }
    
        $jsonData['rooms'] = $request->rooms;
        $client = new Client();
        $res = $client->request('POST',$this->hotel_url.'availability',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=> $jsonData
        ]);

        // Session::put('hotel_req',$jsonData);
        $results    =   $res->getBody()->getContents();
       return json_decode($results,true);

    }

    public function getHotelsList(Request $request){

        $no_of_hotels =0;
        $hotel_detail = HotelInfo::where('city_code',$request->destination_code)->pluck('code');
        $hotel_codes = $hotel_detail->toArray();
        $new = [];
        if(count($hotel_codes) > 250 ){
            $chunk = array_chunk( $hotel_codes, 250);
            $chunk_hotel_cod_size   = count($chunk);
            for($i=0; $i< $chunk_hotel_cod_size; $i++ ){
                 $new[$i] =  $hotel = $this->hotel_availablity($request,  $chunk[$i]);
                 if(!empty($hotel['no_of_hotels'])){
                    $no_of_hotels = $no_of_hotels + $hotel['no_of_hotels'];
                 }
                 if(!empty($hotel[0]['errors'])) {
                    return view('website.pages.page-404');
                    }
            }
            $hotel = $new;
        }else{
           $hotel[] = $this->hotel_availablity($request,   $hotel_codes);

       }




        // dd($request->all());
        // $jsonData = [
        //     'destination_code' => $request->destination_code,
        //     'checkin' => Carbon::parse($request->checkin)->format('Y-m-d'),
        //     'checkout' => Carbon::parse($request->checkout)->format('Y-m-d'),
        //     'client_nationality' => 'IN',
        //     'cutoff_time'=>40000,
        //     'more_results' => true,
        //     'hotel_info' => true,
        //     'rates' => 'concise',
        //     'hotel_category' => [2,7],
        // ];

        
        
        // $jsonData['rooms'] = $request->rooms;

        // $client = new Client();
        // $res = $client->request('POST','http://api-sandbox.grnconnect.com/api/v3/hotels/availability',[
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //         'api-key' => 'b12092d579e8795a77c3abe759d6185f',
        //         'Accept' => 'application/json',
        //         'Accept-Encoding' => 'application/json'
        //     ],
        //     'json' => $jsonData
        // ]);
        // $results = $res->getBody()->getContents();
        // $results = json_decode($results,true);

        // $results['no_of_hotel_result'] =count($results['hotels']);
        return response()->json(['status'=>'success', 'results'=>$hotel]);
    }

    public function citiesList($country_id){
        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/cities?country='.$country_id,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $cities = $res->getBody()->getContents();
        // $client = new Client();
        // $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/destinations?country='.$country_id,[
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //         'api-key' => 'b12092d579e8795a77c3abe759d6185f',
        //         'Accept' => 'application/json',
        //         'Accept-Encoding' => 'application/json'
        //     ],
        // ]);
        // $destinations = $res->getBody()->getContents();
        // $destinations = json_decode($destinations, true);
        $cities = json_decode($cities,true);
        return response()->json(['status'=>'success','cities'=>$cities]);
    }

    public function getCountries(){

        
        $client = new Client();
        $res = $client->request('GET','https://api-sandbox.grnconnect.com/api/v3/countries',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $countries = $res->getBody()->getContents();
        $countries = json_decode($countries,true);
        return response()->json(['status'=>'success','result'=>$countries]);
    }

    public function hotel_detail(Request $request){

        // dd($request->all());

        $jsonData = [
            'hotel_codes' => [$request->hotel_code],
            'checkin' => Carbon::parse($request->checkin)->format('Y-m-d'),
            'checkout' => Carbon::parse($request->checkout)->format('Y-m-d'),
            'client_nationality' => 'IN',
            'cutoff_time'=>40000,
            'more_results' => true,
            'hotel_info' => true,
            'rates' => 'concise',
            'hotel_category' => [2,7],
        ];

        $jsonData['rooms'] = $request->rooms;

        $client = new Client();
        $res = $client->request('POST','http://api-sandbox.grnconnect.com/api/v3/hotels/availability',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        $results = $res->getBody()->getContents();
        $results = json_decode($results,true);

        // $results['no_of_hotel_result'] =count($results['hotels']);
        return response()->json(['status'=>'success', 'results'=>$results]);

    }


    public function hotel_images($code){



         $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/hotels/'.$code.'/images',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $hotels_image = $res->getBody()->getContents();
        $image = json_decode($hotels_image,true);
        $hotel_imgs = $image['images'];
        return response()->json(['status'=>'success', 'results'=>$hotel_imgs]);


    }

    public function recheck(request $request){

        $recheck = new Client();
        $re_res = $recheck->request('post','http://api-sandbox.grnconnect.com/api/v3/hotels/availability/'.$request->search_id.'/rates/?action=recheck',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>[
                    'rate_key'=> $request->rate_key, 
                    'group_code'=> $request->group_code
                    ]

        ]);

        $results = $re_res->getBody()->getContents();
        $result = json_decode($results, true);
       
    return response()->json(['status'=>'success', 'results'=>$result]);

    }

    public function final_book(request $request){

        $client = new Client();
        $res = $client->request('post','http://api-sandbox.grnconnect.com/api/v3/hotels/bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key'   => 'b12092d579e8795a77c3abe759d6185f',
                'Accept'    => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$request->all()
        ]);
        $results        =   $res->getBody()->getContents();
        $confirmation   =   json_decode($results, true);

        return response()->json(['status'=>'success', 'results'=>$confirmation]);


        // return view('frontend.pages.booking_confirm', compact('confirmation'));

    }

}



    
//get countries 





//end code 

// New Modification 




