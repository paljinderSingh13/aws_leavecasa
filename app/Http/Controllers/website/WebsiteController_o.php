<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Helpers\PaymentProcess;
use App\Model\PaymentRequest;
use Illuminate\Http\Request;
use App\Helpers\FlightApi;
use App\Model\Customer;
use App\Model\Airline;
use App\Model\HotelInfo;
use App\Helpers\BusApi;
use App\Model\SearchData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Session;
use Hash;
class WebsiteController extends Controller

{
    protected $api_url ="http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/";
    
    public function  hotel_detail($code){


        dd(1213);

       
        $hotel_req  = Session::get('hotel_req');
        unset($hotel_req['destination_code']);
        $hotel_req['hotel_codes'] = [$code];
        $hotel_req['rates'] = 'comprehensive';

        $client = new Client();
        $res = $client->request('GET','https://api-sandbox.grnconnect.com/api/v3/hotels/'.$code.'/images',[
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

        $hotel_api = new Client();
        $hotel_res= $hotel_api->request('POST','https://api-sandbox.grnconnect.com/api/v3/hotels/availability',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=> $hotel_req
        ]);
        $response = $hotel_res->getBody()->getContents();
        $hotel = json_decode($response,true);

        dd($hotel);

        return view('frontend.pages.hotel_detail', compact('code', 'hotel_imgs', 'hotel', 'hotel_req'));
    }

public function get_code($name){

    $code = SearchData::where('name',$name)->first();

    return response()->json($code);
}


public function search_data($search){

    $result = SearchData::select('name')->Where('name', 'like', $search . '%')->pluck('id','name');

    $city = $result->map(function($item, $key){
            return null;
        });

    return response()->json($city);
}

    public function index(){

//dd(123);
// set_time_limit(0);
//         $client = new Client();
//         $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/cities',[
//             'headers' => [
//                 'Content-Type' => 'application/json',
//                 'api-key' => 'b12092d579e8795a77c3abe759d6185f',
//                 'Accept' => 'application/json',
//                 'Accept-Encoding' => 'application/json'
//             ],
//         ]);
//         $cities = $res->getBody()->getContents();
//         $city = json_decode($cities,true);

        
        

//         foreach ($city['cities'] as $key => $value) {

// //echo $key;

//             if(SearchData::where('code', $value['code'])->exists()){

//             }else{

//                 $explode        = explode(',', $value['name']);
//                 $country_code   = $explode[3];
//                 unset($explode[3]);
//                 $name = implode(',', $explode);
                


//                 $s = new SearchData();
//                 $s->name = addslashes($name);
//                 $s->code = $value['code'];
//                 $s->type = 'city';
//                 $s->country_code = $country_code;
//                 $s->save();

//             }
//         }
//         $client = new Client();
//         $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/countries',[
//             'headers' => [
//                 'Content-Type' => 'application/json',
//                 'api-key' => 'b12092d579e8795a77c3abe759d6185f',
//                 'Accept' => 'application/json',
//                 'Accept-Encoding' => 'application/json'
//             ],
//         ]);
//         $countries = $res->getBody()->getContents();
//         // dd($countries);
//         $countries = json_decode($countries,true);
//         // $countries = ['countries'=>[]];
        //return view('frontend.pages.index',['countries'=>collect($countries['countries'])->pluck('name','code')]);
    return view('frontend.pages.index');
    }

    public function getCities(Request $request){
        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/cities?country='.$request->country,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $cities = $res->getBody()->getContents();


        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/destinations?country='.$request->country,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $destinations = $res->getBody()->getContents();
        $destinations = json_decode($destinations, true);
        if($destinations['total'] > 0){
            $destinations = collect($destinations['destinations'])->pluck('name','code');
        }else{
            $destinations = [];
        }
        $cities = json_decode($cities,true);
        if($cities['total'] > 0){
            $cities = collect($cities['cities'])->pluck('name','code');
        }else{
            $cities = [];
        }
        return response()->json(['cities'=>$cities,'destinations'=>$destinations]);
    }

    public function searchResults(Request $request){
// $request->trip_type = "one_way";
// $request['trip_type'] = "one_way";
        // dd($request->all());
         
 // dd($request->all());
        $action = $request->action;
        switch($action){
            case'bus':
                Session::put('request_search',$request->all());
                $results = $this->searchBus($request);
                $action = 'bus';
                // dd($results);
                return view('website.pages.search-result-bus',['results'=>$results,'action'=>$action,'request'=>$request]);
            break;

            case'flight':      
                $airlineCodes = [];
                $airlines = null;
                $action = 'flight';
                $tripType = $request->trip_type;
                Session::put('request_search',$request->all());

                $results = $this->searchFlight($request);
                // dump($results);
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
                // dump($airlines);
                return view('website.pages.search-result-flight',['results'=>$results,'action'=>$action,'airlines'=>$airlines,'tripType'=>$tripType,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);
            break;

            case'hotel':
                dd($request->all());
            break;
        }
    }

    public function searchFlight($request){

            // dd($request->all());
        $json = [
                'AdultCount' => $request->adult,
                'ChildCount' => $request->child,
                'InfantCount' => $request->infants,
                'DirectFlight' => true,
                'OneStopFlight' => true,
                'JourneyType' => ($request->trip_type == 'one_way')?1:2,
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
        }
        if($request->trip_type == 'one_way' || $request->trip_type == 'round'){
            $depart = Carbon::parse($request->depart)->format('Y-m-d');
            // Session::put('depart_date',);
            $returning = Carbon::parse($request->returning)->format('Y-m-d');
             $from = explode('-',$request->from);
            $to = explode('-',$request->to);

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


        Session::put('search_request',$json);
        $results = FlightApi::search($json);
        Session::put('trace_id',$results['Response']['TraceId']);
        return $results;
    }


public function advance_search(Request $request){

   // dd($request->all());

    $action='flight';
    $search = Session::get('search_request');
    $trip_data = [1=>'one_way',2=>'round'];
    $tripType = 'one_way';//$search['JourneyType'];
    $airlines=null;
    if(!empty($request->PreferredAirlines)){

        // dump($request->PreferredAirlines);
    $search['PreferredAirlines']=  $request->PreferredAirlines; 
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
        //dd($search);

    $results = FlightApi::search($search);

    // dd($results);

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
                return view('website.pages.search-result-flight',['results'=>$results,'action'=>$action,'airlines'=>$airlines,'tripType'=>$tripType,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);


}

    protected function searchBus($request){
        $request->to = Carbon::parse($request->journey_date)->format('Y-m-d');
        $request->source = $request->bus_from;
        $request->destination = $request->bus_to;
        $busApi = BusApi::searchBus($request);
        return $busApi;
    }

    protected function fare_rule($index){
        $jsonData = [
                'EndUserIp' => "202.14.121.198",
                'TokenId' => Session::get('flight_token'),
                "TraceId"=> Session::get('trace_id'),
                "ResultIndex"=>$index
            ];
        $client = new Client();
        $res = $client->request('POST',$this->api_url.'FareRule',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return $res_data = json_decode($res->getBody()->getContents(),true);
    }

protected function fare_quote($index){
        $jsonData = [
                'EndUserIp' => "202.14.121.198",
                'TokenId' => Session::get('flight_token'),
                "TraceId"=> Session::get('trace_id'),
                "ResultIndex"=>$index
            ];
        $client = new Client();
        $res = $client->request('POST',$this->api_url.'FareQuote',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return $res_data = json_decode($res->getBody()->getContents(),true);
    }


    protected function ssr($index){
        $jsonData = [
                'EndUserIp' => "202.14.121.198",
                'TokenId' => Session::get('flight_token'),
                "TraceId"=> Session::get('trace_id'),
                "ResultIndex"=>$index
            ];
        $client = new Client();
        $res = $client->request('POST',$this->api_url.'SSR',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return $res_data = json_decode($res->getBody()->getContents(),true);
    }


    public function flightDetails(Request $request){
        if($request->isMethod('post')){
            $flight_details = json_decode($request['flight_details'], true);
           // $fare_rule = $this->fare_rule($flight_details['ResultIndex']);
           // $fare_quote = $this->fare_quote($flight_details['ResultIndex']);
           $requestData['ResultIndex'] = $flight_details['ResultIndex'];//$fare_quote['Response']['Results'];
           //$ssr = $this->ssr($flight_details['ResultIndex']);
            // dump($fare_rule, $fare_quote, $ssr);
            $requestData = Session::get('request_search');
            if($requestData['trip_type'] == 'one_way'){
                Session::put('selected_flight',$request->flight_details);
            }elseif($requestData['trip_type'] == 'round'){
                Session::put('flight_one',$request->depart);
                Session::put('flight_two',$request->return);
            }elseif($requestData['trip_type'] == 'multi_city'){
                Session::put('selected_flights',$request->flights);
            }
        }else{
            $requestData = Session::get('request_search');
        }
         $requestData['ResultIndex'] = $flight_details['ResultIndex'];

       
        return view('website.pages.flight-details',['request_data'=>$requestData]);
    }

    public function bookFlightNow(Request $request, $book_status = null){
         
        if($request->has('book_status')){
            if($request->f_code == 'Ok'){
                $bookingStatus = explode('?',$request->book_status);
                $processing_id = explode('=',$bookingStatus[1]);
                $model = PaymentRequest::find($processing_id[1]);
                $model->request_response = json_encode($request->all());
                $model->payment_status = 'success';
                $model->save();
                // $customerDetails = $request->all();
                $customerDetails = Session::get('customer_details');
                $request_search = Session::get('request_search');

                $result = FlightApi::bookFlightFromWebsite($customerDetails,$model->id);
                if($request_search['trip_type'] == 'one_way'){
                    if($result['Response']['Error']['ErrorCode'] != 0){
                        Session::flash('error',$result['Response']['Error']['ErrorMessage']);
                        return redirect()->route('index');
                    }else{
                        Session::flash('success','Flight booked successfully!');
                        FlightApi::removeSessions($result,'one_way');
                        return redirect()->route('fight.book.success');
                    }
                }else{
                    $errorStatus = false;
                    $message = '';
                    $successArray = [];
                    if(isset($result['Response'])){
                        Session::flash('error',$result['Response']['Error']['ErrorMessage']);
                        return redirect()->route('index');
                    }
                    foreach($result as $key => $value){
                        if($value['error_status'] != 0){
                            $errorStatus = true;
                            $message = $value['result']['Response']['Error']['ErrorMessage'];
                        }else{
                            $successArray[] = $value;
                        }
                    }
                    if($errorStatus){
                        Session::flash('error',$message);
                        return redirect()->route('index');
                    }else{
                        FlightApi::removeSessions($successArray,'round');
                        return redirect()->route('fight.book.success');
                    }
                }
                
            }else{
                Session::flash('error','Unable to process payment!');
                return redirect()->route('index');
            }
        }else{

            $requestData = Session::get('request_search');


            if($requestData['trip_type'] == 'round'){
                $flightOne = json_decode(Session::get('flight_one'),true);
                $flightTwo = json_decode(Session::get('flight_two'),true);
                $totalPayableAmount = $flightOne['Fare']['PublishedFare'] + $flightTwo['Fare']['PublishedFare'];
            }else{

             $fare_rule = $this->fare_rule($request['ResultIndex']);
            $fare_quote = $this->fare_quote($request['ResultIndex']);
            $ssr = $this->ssr($request['ResultIndex']);

            dump($quote = $fare_quote['Response']['Results']);

            $data_request = [
                    "EndUserIp"=> "202.14.121.198",
                    "TokenId"=> Session::get('flight_token'),
                    "TraceId"=> Session::get('trace_id'),
                    "ResultIndex"=> $request['ResultIndex'],
                    "Passengers"=> [
                                        [
                                            "Title"=>"Mr",
                                            "FirstName"=> "paljinder",
                                            "LastName"=> "dhillon",
                                            "PaxType"=> 1,
                                            "DateOfBirth"=> "1987-12-06T00:00:00",
                                            "Gender"=> 1,
                                            "PassportNo"=> "KJHHJKHKJH",
                                            "PassportExpiry"=>"2020-12-06T00:00:00",
                                            "AddressLine1"=> "123, Test",
                                            "AddressLine2"=> "",
                                            "City"=> "Gurgaon",
                                            "CountryCode"=> "IN",
                                            "CountryName"=> "India",
                                            "Nationality"=> "IN",
                                            "ContactNo"=> "9879879877",
                                            "Email"=> "harsh@tbtq.in",
                                            "IsLeadPax"=> true,
                                            "FFAirlineCode"=> null,
                                            "FFNumber"=> "",
                                            "GSTCompanyAddress"=> "",
                                            "GSTCompanyContactNumber"=> "",
                                            "GSTCompanyName"=> "",
                                            "GSTNumber"=> "",
                                            "GSTCompanyEmail"=> "",
                                            "Fare"=> [
                                                        "Currency"=> $quote['fare']['Currency'],
                                                        "BaseFare"=> $quote['FareBreakdown'],
                                                        "Tax"=> 6712,
                                                        "YQTax"=> 5542,
                                                        "AdditionalTxnFeePub"=> 0.0,
                                                        "AdditionalTxnFeeOfrd"=> 0.0,
                                                        "OtherCharges"=> $quote['fare']['OtherCharges'],
                                                        "Discount"=> $quote['fare']['Discount'],
                                                        "PublishedFare"=> $quote['fare']['PublishedFare'],
                                                        "OfferedFare"=> $quote['fare']['OfferedFare'],
                                                        "TdsOnCommission"=> $quote['fare']['TdsOnCommission'],
                                                        "TdsOnPLB"=> $quote['fare']['TdsOnPLB'],
                                                        "TdsOnIncentive"=> $quote['fare']['TdsOnIncentive'],
                                                        "ServiceFee"=> $quote['fare']['ServiceFee']
                                                    ]
                                        ]
                                    ]
                ];

                dump($data_request);

                

                dump(Session::get('flight_token'));
                dump(Session::get('trace_id'));

                dd($requestData , $request->all());



                $flightDetails = json_decode(Session::get('selected_flight'),true);

                $totalPayableAmount = $flightDetails['Fare']['PublishedFare'];
            }

            Session::put('customer_details',$request->all());
            $existingCustomer = Customer::where(['email'=>$request->email])->first();
            if($existingCustomer == null){
                $customer = new Customer;
                $customer->name = $request->firstname[0];
                $customer->email = $request->email;
                $customer->password = Hash::make($request->contact);
                $customer->mobile = $request->contact;
                $customer->address = 'India';
                $customer_id = $customer->save();
            }else{
                $customer_id = $existingCustomer->id;
            }
            $paymentOptions = [];
            $paymentOptions['amount'] = $totalPayableAmount;
            $paymentOptions['return_to'] = route('book.customer.flight.now',['book_status'=>'book-now']);
            $paymentOptions['client_code'] = $customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $request->firstname[0];
            $paymentOptions['customer_details']['customer_email'] = $request->email;
            $paymentOptions['customer_details']['customer_mobile'] = $request->contact;
            $paymentOptions['customer_details']['billing_address'] = str_replace(["\n","\r"],"",'India');
            $paymentOptions['customer_details']['customer_account_id'] = $customer_id;
            $url = PaymentProcess::process($paymentOptions);
            return redirect()->to($url);
        }
    }

    public function flightBookedSuccess(){
        return view('website.pages.flight-booking-success');
    }

    public function getSeatDetails(Request $request, $bus_id){
        $seatDetails = BusApi::getSeats($bus_id);
        if(isset($seatDetails['maxSeatsPerTicket'])){
            $maxSeats = $seatDetails['maxSeatsPerTicket'];
        }else{
            $maxSeats = 6;
        }
        $seatDetails = collect($seatDetails['seats']);
        //zIndex = 1 for upper and 0 for lower
        $seatData = $seatDetails->groupBy('zIndex')->map(function($records){
            return $records->groupBy('row');
        });
        Session::put('selected_bus',$request->all());
        return view('administrator.booking.bus-booking.seats',['seatData'=>$seatData,'request'=>$request->all(),'maxSeats'=>$maxSeats,'bus_id'=>$bus_id,'from'=>'webiste'])->render();
    }

    public function busBokingPassenger(Request $request){
        Session::put('selected_seats',$request->all());
        return view('website.pages.bus-details');
    }

    public function bookBus(Request $request){
        $bookingArray = [];
        $bookingDetails = json_decode($request->booking_details, true);
        $boardingPoint = explode('-',$bookingDetails['boarding_point']);
        $seats = explode(',',$bookingDetails['seats_selected']);

        $bookingArray['availableTripId'] = $bookingDetails['bus_id'];
        $bookingArray['boardingPointId'] = $boardingPoint[0];
        $bookingArray['destination'] = $bookingDetails['destination'];
        $bookingArray['source'] = $bookingDetails['source'];
        $bookingArray['inventoryItems'] = [];

        $requestData = $request->all();

        for($i = 0; $i < count($requestData['name']); $i++){
            $details = [];
            $details['seatName'] = $seats[$i];
            $details['ladiesSeat'] = false;
            $details['fare'] = ($bookingDetails['total_price']/count($seats));
            if($i == 0){
                $details['passenger']['age'] = $requestData['age'][$i];
                $details['passenger']['primary'] = true;
                $details['passenger']['name'] = $requestData['name'][$i];
                $details['passenger']['title'] = $requestData['title'][$i];
                $details['passenger']['gender'] = $requestData['gender'][$i];
                $details['passenger']['idType'] = $requestData['id_proof_type'];
                $details['passenger']['email'] = $requestData['email'];
                $details['passenger']['idNumber'] = $requestData['id_no'];
                $details['passenger']['address'] = $requestData['address'];
                $details['passenger']['mobile'] = $requestData['mobile'];
            }else{
                $details['passenger']['age'] = $requestData['age'][$i];
                $details['passenger']['primary'] = false;
                $details['passenger']['name'] = $requestData['name'][$i];
                $details['passenger']['title'] = $requestData['title'][$i];
                $details['passenger']['gender'] = $requestData['gender'][$i];
            }
            $bookingArray['inventoryItems'][] = $details;
        }
        BusApi::bookBus($bookingArray);
        dd($bookingArray);
    }


    public function bookBusNow(Request $request){
        if($request->has('book_status')){
            if($request->f_code == 'Ok'){
                $bookingStatus = explode('?',$request->book_status);
                $processing_id = explode('=',$bookingStatus[1]);
                $model = PaymentRequest::find($processing_id[1]);
                $model->request_response = json_encode($request->all());
                $model->payment_status = 'success';
                $model->save();
                // $customerDetails = $request->all();
                $customerDetails = Session::get('customer_details');
                $request_search = Session::get('request_search');
                $result = FlightApi::bookFlightFromWebsite($customerDetails,$model->id);
                if($request_search['trip_type'] == 'one_way'){
                    if($result['Response']['Error']['ErrorCode'] != 0){
                        Session::flash('error',$result['Response']['Error']['ErrorMessage']);
                        return redirect()->route('index');
                    }else{
                        Session::flash('success','Flight booked successfully!');
                        FlightApi::removeSessions($result,'one_way');
                        return redirect()->route('fight.book.success');
                    }
                }else{
                    $errorStatus = false;
                    $message = '';
                    $successArray = [];
                    if(isset($result['Response'])){
                        Session::flash('error',$result['Response']['Error']['ErrorMessage']);
                        return redirect()->route('index');
                    }
                    foreach($result as $key => $value){
                        if($value['error_status'] != 0){
                            $errorStatus = true;
                            $message = $value['result']['Response']['Error']['ErrorMessage'];
                        }else{
                            $successArray[] = $value;
                        }
                    }
                    if($errorStatus){
                        Session::flash('error',$message);
                        return redirect()->route('index');
                    }else{
                        FlightApi::removeSessions($successArray,'round');
                        return redirect()->route('fight.book.success');
                    }
                }
                
            }else{
                Session::flash('error','Unable to process payment!');
                return redirect()->route('index');
            }
        }else{
            $requestData = Session::get('request_search');
            $selectedBus = Session::get('selected_bus');
            $selectedSeats = Session::get('selected_seats');
            // dd($selectedSeats);
            Session::put('customer_details',$request->all());
            $existingCustomer = Customer::where(['email'=>$request->email])->first();
            if($existingCustomer == null){
                $customer = new Customer;
                $customer->name = $request->name[0];
                $customer->email = $request->email;
                $customer->password = Hash::make($request->mobile);
                $customer->mobile = $request->mobile;
                $customer->address = 'India';
                $customer_id = $customer->save();
            }else{
                $customer_id = $existingCustomer->id;
            }
            $paymentOptions = [];
            $paymentOptions['amount'] = $selectedSeats['total_price'];
            $paymentOptions['return_to'] = route('webste.book.bus',['book_status'=>'book-now']);
            $paymentOptions['client_code'] = $customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $request->name[0];
            $paymentOptions['customer_details']['customer_email'] = $request->email;
            $paymentOptions['customer_details']['customer_mobile'] = $request->mobile;
            $paymentOptions['customer_details']['billing_address'] = str_replace(["\n","\r"],"",'India');
            $paymentOptions['customer_details']['customer_account_id'] = $customer_id;
            $url = PaymentProcess::process($paymentOptions);
            return redirect()->to($url);
        }
    }

    public function hotelsResults(Request $request){
        //dd($request->all());
        $hotel_detail=HotelInfo::where('city_code',$request->code)->pluck('code'); 
        $hotel_codes = $hotel_detail->toArray();

        //dump($hotel_codes);
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
            'hotel_category' => [2,5]
        ];

        $start = 1;
        foreach ($request->adults as $rkey => $rvalue) {
            $rooms[$rkey]['adults'] = $rvalue;
            if(isset($request['ch_age'][$start])){
                $rooms[$rkey]['children_ages'] = $request['ch_age'][$start];
            }
            $start++;
            // $rooms[$start]['children_ages'] = $rvalue['adults'];
        }
    
        $jsonData['rooms'] = $rooms;

        // dd($jsonData);
        $client = new Client();
        $res = $client->request('POST','https://api-sandbox.grnconnect.com/api/v3/hotels/availability',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=> $jsonData
        ]);

        Session::put('hotel_req',$jsonData);


        $results    =   $res->getBody()->getContents();
        $hotel      =   json_decode($results,true);

        dump( $jsonData, $hotel);

        if(!empty($hotel['errors']))

        {
            return "<p class='red-text ml5'>No Result Found.</p>";
        }
        $collection =   collect($hotel['hotels']);

        $info = $collection->keyBy('hotel_code');
        //Session::put('hotel',$hotel);
        //Session::put('hotel_result',$info);
        //
        // return response()->json($hotel);
        // 
        
        
        return view('website.pages.search-result-hotel',['results'=>json_decode($results,true), 'request'=> $jsonData]);
    }


    public function hotel_recheck(Request $request){

        $client = new Client();
        $res = $client->request('POST','https://api-sandbox.grnconnect.com/api/v3/hotels/availability/'.$request->search_id.'/rates/?action=recheck',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>[

                'rate_key'=>$request->rate_key,
                'group_code'=>$request->group_code 
                 ]
        ]);
        $results    =   $res->getBody()->getContents();
        $recheck      =   json_decode($results,true);

dump($recheck, $recheck['hotel']['rate']['rooms'][0]['room_reference']);

$sess = Session::get('hotel_req');

$booking_item = [
                'search_id'=> $recheck['search_id'],
                'hotel_code'=> $recheck['hotel']['hotel_code'],
                'group_code'=> $recheck['hotel']['rate']['group_code'],
                'city_code'=> $recheck['hotel']['city_code'],
                'checkin'=> $sess['checkin'],
                'checkout'=> $sess['checkout'],
                'booking_comments'=> "taskintttt",
                'payment_type'=> "AT_WEB",
                'group_code'=>$request->group_code, 
                'booking_items'=> [
                                    [   "room_code"=>$recheck['hotel']['rate']['room_code'],
                                        "rate_key"=>$recheck['hotel']['rate']['rate_key'],
                                        "rooms"=>[
                                            [
                                        "room_reference"=>$recheck['hotel']['rate']['rooms'][0]['room_reference'],
                                            "paxes"=>[
                                                    [
                                                    "title"=>"Mr.",
                                                    "name"=>"Paljinder",
                                                    "surname"=>"singh",
                                                    "type"=>"AD"
                                                ],[
                                                    "title"=>"Mr.",
                                                    "name"=>"harjit",
                                                    "surname"=>"singh",
                                                    "type"=>"AD"
                                                ]
                                            ]
                                        ]]
                                    ]
                                ],

                 "holder"=> [
        "title"=> "Mr.",
        "name"=> "James",
        "surname"=> "Patrick",
        "email"=> "james@pat.com",
        "phone_number"=> "6614565589",
        "client_nationality"=> "IN"]
         ];




$nclient = new Client();
        $nres = $nclient->request('POST','https://api-sandbox.grnconnect.com/api/v3/hotels/bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$booking_item
        ]);



        $nresults    =   $nres->getBody()->getContents();
        $nrecheck      =   json_decode($nresults,true);

dd($booking_item, $nresults);
        dd($nrecheck, Session::get('hotel_req'));
    }





    public function hotel_book(Request $request){



        $hotel  = Session::get('hotel_req');
        // $search_id = $hotel['search_id'];
        $checkin = $hotel['checkin'];
        $checkout = $hotel['checkout'];

        $hotel_code = $request->hotel_code;
        $city_code  = $request->city_code; 
        $group_code  = $request->group_code; 
        $rate_key  = $request->rate_key; 
        $room_code  = $request->room_code;
        $price  = $request->price;


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

        $resu    =   $re_res->getBody()->getContents();
        $recheck = json_decode($resu, true);
        $recheck['price'] =  $price;




return view('frontend.pages.booking_form', compact('recheck'));

}

   protected function put_final_request_data($request){

     $rate_key   =   $request['rate_key'];
        $room_code  =   $request['room_code'];
        $group_code =   $request['group_code'];
        $hotel_code =   $request['hotel_code'];
        $city_code  =   $request['city_code'];

        $search_id  = $request['search_id'];
        $checkin    = $request['checkin'];
        $checkout   = $request['checkout'];

        $reqData = [
                        'search_id'=>  $search_id,
                        'hotel_code'=> $hotel_code,
                        'city_code'=> $city_code,
                        'group_code'=> $group_code ,
                        'checkin'=>  $checkin,
                        'checkout'=> $checkout,
                        "booking_comments"=> "Testing",
                        'payment_type'=> 'AT_WEB',
                        "booking_items"=>[
                                        [

                                         "room_code"=> $room_code,
                                         "rate_key"=> $rate_key,
                                         "rooms"=>  $request['room']['rooms'],
                                      
                                ]
                            ], 
                        "holder"=>  [
                                        "title"=>   $request['holder']['title'],
                                        "name"=>    $request['holder']['name'],
                                        "surname"=> $request['holder']['surname'],
                                        "email"=>   $request['holder']['email'],
                                        "phone_number"=> $request['holder']['phone_number'],
                                        "client_nationality"=> "in"
                                    ]
                       
                    ];

        Session::put('final_book', $reqData);
   }

    public function final_book($processing_id=null, request $request ){

        if(empty($processing_id)){

           $info= $this->put_final_request_data($request);
           dd($info);
            $paymentOptions = [];
            $paymentOptions['payment_for'] ="hotel";
            $paymentOptions['amount'] =$request->price;
            $paymentOptions['return_to'] = route('hotel.confirm.book');
            $paymentOptions['client_code'] = 13;//$customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $request['holder']['name'];//'paljinder$request->firstname[0];
            $paymentOptions['customer_details']['customer_email'] = $request['holder']['email'];//$request->email;
            $paymentOptions['customer_details']['customer_mobile'] = $request['holder']['phone_number'];
            $paymentOptions['customer_details']['billing_address'] = str_replace(["\n","\r"],"",'India');
            $paymentOptions['customer_details']['customer_account_id'] = 13;
            $url = PaymentProcess::process($paymentOptions);
           // return redirect($url);//->to($url);

        }

        

    }



    public function booking_confirm(request $request){


        $reqData = Session::get('final_book');
        $client = new Client();
        $res = $client->request('post','https://api-sandbox.grnconnect.com/api/v3/hotels/bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key'   => 'b12092d579e8795a77c3abe759d6185f',
                'Accept'    => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$reqData
        ]);
        $results        =   $res->getBody()->getContents();
        $confirmation   =   json_decode($results, true);
        return view('frontend.pages.booking_confirm', compact('confirmation'));


    }

    public function hotel_payment(Request $request, $processing_id){

        dd(123);

        dd($request->all());

    }

}
