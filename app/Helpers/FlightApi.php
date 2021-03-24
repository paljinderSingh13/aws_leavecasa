<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 08-05-2018
 * Time: 07:52
 */

namespace App\Helpers;
use App\Model\FlightBooking;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;
use Session;
use App\Model\AirToken;
// make changes in following methods to change api to sand or live
// authenticate

class FlightApi{
//test
    // protected static $API = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';
    // protected static $IP =  '103.232.151.175';
// live
    protected static $API = "https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/";
   protected static $IP =  "202.14.121.198";
    //protected  $api_url = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';
    

    protected static $token = 'c550b274-7ebc-47a6-9f80-4ad4ae9e1a96';


    // Details For Galilio
    protected static $TARGETBRANCH = '';

    protected static $CREDENTIALS = 'Universal API/uAPI5943083982-4140beaf:8Ww&r/T2A3';

    protected static $Provider = 'ACH';


    public static function authenticate($test=null){

        

        $token = null; 
        $current_date = date('Y-m-d');
        AirToken::where(['date'=>$current_date])->delete();
        $token = AirToken::where(['date'=>$current_date]);
       if($token->exists()){
         $token =  self::$token =   $token->first()->token_no;
           Session::put('flight_token',self::$token);


       }else{

        // dd($test);

//sandbox
 //if(!empty($test)){
//         $url = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate';
//         $jsonData = [
//                 'ClientId' => 'Apiintegrationnew',
//                 'UserName' => 'Leavecasa',
//                 'Password' => 'Leave@123',
//                 'EndUserIp' => '202.14.121.198'
//             ];
       
// }else{

    //sandbox
        // $url = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate';
        // $jsonData = [
        //         'ClientId' => 'Apiintegrationnew',
        //         'UserName' => 'Leavecasa',
        //         'Password' => 'Leave@123',
        //         'EndUserIp' => '202.14.121.198'
        //     ];

// live
         $url = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate';
         $jsonData = [
                'ClientId' => 'tboprod',
                'UserName' => 'DELA608',
                'Password' => 'Acme@Tbo-121#@#',//'tbolive##2019@@',
                'EndUserIp' => '202.14.121.198'
            ];

//}
        $client = new Client();
        $res = $client->request('POST',$url,[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        $result = json_decode($res->getBody()->getContents(),true);
        // dd( $result);
        Session::put('flight_token',$result['TokenId']);

            $new_token =  new AirToken();
            $new_token->date = $current_date;
            $new_token->token_no = $result['TokenId'];
            $new_token->save();

//dump( $result['TokenId']);
            $token =self::$token = $result['TokenId'];
        }

// dd($token);
        return $token;
    }



    public static function search($json, $test=null){

// if(!empty($test)){
//         self::$API = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';
//         $token = self::authenticate($test);
//          $jsonData = [
//                 'EndUserIp' => '103.232.151.175',
//                 'TokenId' => self::$token
//             ];
// }else{

        $token = self::authenticate();
        $jsonData = [
                'EndUserIp' => self::$IP,
                'TokenId' => self::$token
            ];
// }

        $jsonData = array_merge($jsonData,$json);
        //dump(json_encode($jsonData));
        //dump(2,$json);

        $client = new Client();
        $res = $client->request('POST',self::$API.'Search',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
         //dd($res->getBody()->getContents());
         $res_data = json_decode($res->getBody()->getContents(),true);
         Session::put('trace_id', $res_data['Response']['TraceId']);
         //if(!empty($test)){
             $res_data['token_id'] = $token;
        // }
        return   $res_data;//json_decode($res->getBody()->getContents(),true);
    }



public static function calculate_fare($FareBreakdown ){


        $size_break_down = count($FareBreakdown);

        for($j=0; $j< $size_break_down; $j++){

            $calculateFare = $FareBreakdown[$j]['BaseFare']  /      $FareBreakdown[$j]['PassengerCount'];
            $calculateTax = $FareBreakdown[$j]['Tax']  /      $FareBreakdown[$j]['PassengerCount'];
            $calculateYQTax = $FareBreakdown[$j]['YQTax']  /      $FareBreakdown[$j]['PassengerCount'];
            $calculateAdditionalTxnFeeOfrd = $FareBreakdown[$j]['AdditionalTxnFeeOfrd']  /      $FareBreakdown[$j]['PassengerCount'];
            $calculateAdditionalTxnFeePub = $FareBreakdown[$j]['AdditionalTxnFeePub']  /      $FareBreakdown[$j]['PassengerCount'];
            $fare[$FareBreakdown[$j]['PassengerType']]['BaseFare']  =  $calculateFare;
            $fare[$FareBreakdown[$j]['PassengerType']]['Tax']       =  $calculateTax;
            $fare[$FareBreakdown[$j]['PassengerType']]['YQTax']     =  $calculateYQTax;
            $fare[$FareBreakdown[$j]['PassengerType']]['AdditionalTxnFeeOfrd'] =  $calculateAdditionalTxnFeeOfrd;
            $fare[$FareBreakdown[$j]['PassengerType']]['AdditionalTxnFeePub'] =  $calculateAdditionalTxnFeePub;
        }

        return $fare;

    }

    


        public static function fare_rule($index , $token=null, $trace_id=null){

        if(!empty($token)){

                 //   self::$API = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';


             $jsonData = [
                        'EndUserIp' => "202.14.121.198",// '103.232.151.175',
                        'TokenId' => $token,
                        "TraceId"=> $trace_id,
                        "ResultIndex"=>$index
                    ];


        }else{

                $jsonData = [
                        'EndUserIp' => "202.14.121.198",
                        'TokenId' => Session::get('flight_token'),
                        "TraceId"=> Session::get('trace_id'),
                        "ResultIndex"=>$index
                    ];

                   
        }
        $client = new Client();
        $res = $client->request('POST',self::$API.'FareRule',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return $res_data = json_decode($res->getBody()->getContents(),true);
    }

public static function fare_quote($index, $token=null, $trace_id=null, $test=null ){

     if(!empty($token)){

        //'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';
    

        // self::$API = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';

             $jsonData = [
                        'EndUserIp' => "202.14.121.198", //'103.232.151.175',
                        'TokenId' => $token,
                        "TraceId"=> $trace_id,
                        "ResultIndex"=>$index
                    ];
        }else{
        $jsonData = [
                'EndUserIp' => "202.14.121.198",
                'TokenId' => Session::get('flight_token'),
                "TraceId"=> Session::get('trace_id'),
                "ResultIndex"=>$index
            ];
        }
        $client = new Client();
        $res = $client->request('POST',self::$API.'FareQuote',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return $res_data = json_decode($res->getBody()->getContents(),true);
    }


    public static function ssr($index, $token=null, $trace_id=null){

        if(!empty($token)){

                   // self::$API = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/';

             $jsonData = [
                        'EndUserIp' => "202.14.121.198",//'103.232.151.175',
                        'TokenId' => $token,
                        "TraceId"=> $trace_id,
                        "ResultIndex"=>$index
                    ];

        }else{
            $jsonData = [
                'EndUserIp' => "202.14.121.198",
                'TokenId' => Session::get('flight_token'),
                "TraceId"=> Session::get('trace_id'),
                "ResultIndex"=>$index
            ];
        }
        $client = new Client();
        $res = $client->request('POST',self::$API.'SSR',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return $res_data = json_decode($res->getBody()->getContents(),true);
    }


    

   

    public static function galilioApi(){

    }

    protected function getFareResult($TokenId, $TraceId, $ResultIndex){
        $fareQuote = self::$API.'FareQuote';
        $fareQuoteJson = [
            'EndUserIp' => '202.14.121.198',
            'TokenId' => $TokenId,
            'TraceId' => $TraceId,
            'ResultIndex' => $ResultIndex
        ];
        $client = new Client();
        $res = $client->request('POST',$fareQuote,[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $fareQuoteJson
        ]);
        return json_decode($res->getBody()->getContents(),true);
    }

    public static function bookFlight($bookFrom){

       
        $selfObject = new self;
        $url = self::$API.'Book';

        $customersList = Session::get('customers_list');
        $flightData = Session::get('flight_data');
        $client_id = Session::get('client_id');
        $flight_token = Session::get('flight_token');

        if($flightData['journey_type'] == 2){
            $flight_1_details = json_decode($flightData['flight_details_1'],true);
            $ResultIndex_1 = $flight_1_details['ResultIndex'];
            $flight_2_details = json_decode($flightData['flight_details_2'],true);
            $ResultIndex_2 = $flight_2_details['ResultIndex'];
            $TraceId = $flightData['trace_id'];        
            $TokenId = $flight_token;
            $result_1 = $selfObject->getFareResult($TokenId, $TraceId, $ResultIndex_1);
            if($result_1['Response']['Error']['ErrorCode'] != 0){
                return ['result'=>$result_1,'status'=>false];
            }

            //For Second Flight
            $result_2 = $selfObject->getFareResult($TokenId, $TraceId, $ResultIndex_2);
            if($result_2['Response']['Error']['ErrorCode'] != 0){
                return ['result'=>$result_2,'status'=>false];
            }

        }else{
            $flightDetails = json_decode($flightData['flight_details'],true);
            $ResultIndex = $flightDetails['ResultIndex'];
            $TraceId = $flightData['trace_id'];        
            $TokenId = $flight_token;
            $result = $selfObject->getFareResult($TokenId, $TraceId, $ResultIndex);
            if($result['Response']['Error']['ErrorCode'] != 0){
                return $result;
            }
        }

        if($flightData['journey_type'] == 1){
            $Passengers = [];
            foreach($customersList as $key => $customer){
                $customerData = [];
                $customerData['Title'] = $customer['title'];
                $customerData['FirstName'] = $customer['first_name'];
                $customerData['LastName'] = $customer['last_name'];
                $customerData['PaxType'] = 1;
                $customerData['DateOfBirth'] = $customer['date_of_birth'];
                $customerData['Gender'] = $customer['gender'];
                $customerData['GSTCompanyAddress'] = 'A-fhgjkhsjkfd';
                $customerData['GSTCompanyContactNumber'] = '9898989898';
                $customerData['GSTCompanyName'] = 'ACME MEDIA CREATIONS';
                $customerData['GSTNumber'] = '07AASFA7870NIZL';
                $customerData['GSTCompanyEmail'] = 'nikhil123@gmail.com';
                $customerData['PassportNo'] = $customer['passport_no'];
                $customerData['PassportExpiry'] = $customer['passport_expiry'].'T00:00:00';
                $customerData['AddressLine1'] = $customer['address_line'];
                $customerData['City'] = $customer['city'];
                $customerData['CountryCode'] = $customer['country'];
                $customerData['CountryName'] = $customer['country'];
                $customerData['ContactNo'] = $customer['contact_number'];
                $customerData['Email'] = $customer['email'];
                $customerData['IsLeadPax'] = $customer['isleadpax'];
                $customerData['Fare'] = $result['Response']['Results']['Fare'];
                $Passengers[] = $customerData;
            }

            $jsonData = [
                'EndUserIp' => '202.14.121.198',
                'TokenId' => $TokenId,
                'TraceId' => $TraceId,
                'ResultIndex' => $ResultIndex,
                'Passengers' => $Passengers
            ];
            $client = new Client();
            $res = $client->request('POST',$url,[
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => $jsonData
            ]);
            $result = json_decode($res->getBody()->getContents(),true);
            $classObject = new self;
            if($result['Response']['Error']['ErrorMessage'] == ''){
                $model = $classObject->putFlightBookings($jsonData, $result);
                return ['status'=>true,'model'=>$model,'result'=>$result];
            }else {
                return ['status'=>false,'result'=>$result];
            }
        }else{
            $Passengers_1 = [];
            $Passengers_2 = [];
            foreach($customersList as $key => $customer){
                $customerData = [];
                $customerData['Title'] = $customer['title'];
                $customerData['FirstName'] = $customer['first_name'];
                $customerData['LastName'] = $customer['last_name'];
                $customerData['PaxType'] = 1;
                $customerData['DateOfBirth'] = $customer['date_of_birth'];
                $customerData['Gender'] = $customer['gender'];
                $customerData['GSTCompanyAddress'] = 'A-fhgjkhsjkfd';
                $customerData['GSTCompanyContactNumber'] = '9898989898';
                $customerData['GSTCompanyName'] = 'ACME MEDIA CREATIONS';
                $customerData['GSTNumber'] = '07AASFA7870NIZL';
                $customerData['GSTCompanyEmail'] = 'nikhil123@gmail.com';
                $customerData['PassportNo'] = $customer['passport_no'];
                $customerData['PassportExpiry'] = $customer['passport_expiry'].'T00:00:00';
                $customerData['AddressLine1'] = $customer['address_line'];
                $customerData['City'] = $customer['city'];
                $customerData['CountryCode'] = $customer['country'];
                $customerData['CountryName'] = $customer['country'];
                $customerData['ContactNo'] = $customer['contact_number'];
                $customerData['Email'] = $customer['email'];
                $customerData['IsLeadPax'] = $customer['isleadpax'];
                $customerData['Fare'] = $result_1['Response']['Results']['Fare'];
                $Passengers_1[] = $customerData;
            }
            foreach($customersList as $key => $customer){
                $customerData = [];
                $customerData['Title'] = $customer['title'];
                $customerData['FirstName'] = $customer['first_name'];
                $customerData['LastName'] = $customer['last_name'];
                $customerData['PaxType'] = 1;
                $customerData['DateOfBirth'] = $customer['date_of_birth'];
                $customerData['Gender'] = $customer['gender'];
                $customerData['GSTCompanyAddress'] = 'A-fhgjkhsjkfd';
                $customerData['GSTCompanyContactNumber'] = '9898989898';
                $customerData['GSTCompanyName'] = 'ACME MEDIA CREATIONS';
                $customerData['GSTNumber'] = '07AASFA7870NIZL';
                $customerData['GSTCompanyEmail'] = 'nikhil123@gmail.com';
                $customerData['PassportNo'] = $customer['passport_no'];
                $customerData['PassportExpiry'] = $customer['passport_expiry'].'T00:00:00';
                $customerData['AddressLine1'] = $customer['address_line'];
                $customerData['City'] = $customer['city'];
                $customerData['CountryCode'] = $customer['country'];
                $customerData['CountryName'] = $customer['country'];
                $customerData['ContactNo'] = $customer['contact_number'];
                $customerData['Email'] = $customer['email'];
                $customerData['IsLeadPax'] = $customer['isleadpax'];
                $customerData['Fare'] = $result_2['Response']['Results']['Fare'];
                $Passengers_2[] = $customerData;
            }

            
            $result_1 = $selfObject->bookFlightMethod($TokenId, $TraceId, $ResultIndex_1, $Passengers_1, $url);
            if($result_1['response']['Response']['Error']['ErrorMessage'] != ''){
                return ['status'=>false,'result'=>$result_1];
            }
            $result_2 = $selfObject->bookFlightMethod($TokenId, $TraceId, $ResultIndex_2, $Passengers_2, $url);
            if($result_2['response']['Response']['Error']['ErrorMessage'] != ''){
                return ['status'=>false,'result'=>$result_2];
            }

            $model_1 = $selfObject->putFlightBookings($result_1['jsonData'], $result_1);
            $model_2 = $selfObject->putFlightBookings($result_2['jsonData'], $result_2);

            return ['status'=>true,'model'=>$model_1,'result'=>$result,'model_2'=>$model_2];
        }
        
    }


    public static function bookFlightFromWebsite($customerDetails, $customer_id){
        $selfObject = new self;
        $url = self::$API.'Book';
        $selected_flight = Session::get('selected_flight');
        $request_search = Session::get('request_search');

        if($request_search['trip_type'] == 'one_way'){

            $flightDetails = json_decode($selected_flight,true);            
            $ResultIndex = $flightDetails['ResultIndex'];
            $TraceId = Session::get('trace_id');
            $TokenId = Session::get('flight_token');
            $result = $selfObject->getFareResult($TokenId, $TraceId, $ResultIndex);
            if($result['Response']['Error']['ErrorCode'] != 0){
                return $result;
            }
            $Passengers = [];
            for($i = 0; $i < count($customerDetails['title']); $i++){
                $customerData = [];
                $customerData['Title'] = $customerDetails['title'][$i];
                $customerData['FirstName'] = $customerDetails['firstname'][$i];
                $customerData['LastName'] = $customerDetails['lastname'][$i];
                $customerData['PaxType'] = '1';
                $customerData['Gender'] = ($customerDetails['title'][$i] == 'Mr')?'1':'2';
                $customerData['GSTCompanyAddress'] = 'A-fhgjkhsjkfd';
                $customerData['GSTCompanyContactNumber'] = '9898989898';
                $customerData['GSTCompanyName'] = 'ACME MEDIA CREATIONS';
                $customerData['GSTNumber'] = '07AASFA7870NIZL';
                $customerData['GSTCompanyEmail'] = 'nikhil123@gmail.com';
                $customerData['AddressLine1'] = $flightDetails['Segments'][0][0]['Origin']['Airport']['CityName'];
                $customerData['City'] = $flightDetails['Segments'][0][0]['Origin']['Airport']['CityName'];
                $customerData['CountryCode'] = 'IN';
                $customerData['CountryName'] = 'India';
                $customerData['ContactNo'] = $customerDetails['contact'];
                $customerData['Email'] = $customerDetails['email'];
                $customerData['IsLeadPax'] = 'true';
                $customerData['Fare'] = $result['Response']['Results']['Fare'];
                $Passengers[] = $customerData;

            }
            $jsonData = [
                'EndUserIp' => '202.14.121.198',
                'TokenId' => $TokenId,
                'TraceId' => $TraceId,
                'ResultIndex' => $ResultIndex,
                'Passengers' => $Passengers
            ];
            // dd($jsonData);
            $client = new Client();
            $res = $client->request('POST',$url,[
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => $jsonData
            ]);
           return $result = json_decode($res->getBody()->getContents(),true);
            $model = new FlightBooking();
            $model->customer_id = $customer_id;
            $model->total_amount = $flightDetails['Fare']['PublishedFare'];
            $model->request_data = json_encode($jsonData);
            $model->response_data = json_encode($result);
            $model->payment_from = 'atom';
            $model->booked_by = 1;
            $model->booking_id = $result['Response']['Response']['BookingId'];
            $model->save();
            return $result;
        }else{

            $flightOne = json_decode(Session::get('flight_one'),true);
            $flightTwo = json_decode(Session::get('flight_two'),true);
            $flightsData[] = $flightOne;
            $flightsData[] = $flightTwo;
            $bookingResults = [];
            foreach($flightsData as $key => $flight){
                $ResultIndex = $flight['ResultIndex'];
                $TraceId = Session::get('trace_id');
                $TokenId = Session::get('flight_token');
                $result = $selfObject->getFareResult($TokenId, $TraceId, $ResultIndex);
                if($result['Response']['Error']['ErrorCode'] != 0){
                    return $result;
                }
                $Passengers = [];
                for($i = 0; $i < count($customerDetails['title']); $i++){
                    $customerData = [];
                    $customerData['Title'] = $customerDetails['title'][$i];
                    $customerData['FirstName'] = $customerDetails['firstname'][$i];
                    $customerData['LastName'] = $customerDetails['lastname'][$i];
                    $customerData['PaxType'] = '1';
                    $customerData['Gender'] = ($customerDetails['title'][$i] == 'Mr')?'1':'2';
                    $customerData['GSTCompanyAddress'] = 'A-fhgjkhsjkfd';
                    $customerData['GSTCompanyContactNumber'] = '9898989898';
                    $customerData['GSTCompanyName'] = 'ACME MEDIA CREATIONS';
                    $customerData['GSTNumber'] = '07AASFA7870NIZL';
                    $customerData['GSTCompanyEmail'] = 'nikhil123@gmail.com';
                    $customerData['AddressLine1'] = $flight['Segments'][0][0]['Origin']['Airport']['CityName'];
                    $customerData['City'] = $flight['Segments'][0][0]['Origin']['Airport']['CityName'];
                    $customerData['CountryCode'] = 'IN';
                    $customerData['CountryName'] = 'India';
                    $customerData['ContactNo'] = $customerDetails['contact'];
                    $customerData['Email'] = $customerDetails['email'];
                    $customerData['IsLeadPax'] = 'true';
                    $customerData['Fare'] = $result['Response']['Results']['Fare'];
                    $Passengers[] = $customerData;

                }
                $jsonData = [
                    'EndUserIp' => '202.14.121.198',
                    'TokenId' => $TokenId,
                    'TraceId' => $TraceId,
                    'ResultIndex' => $ResultIndex,
                    'Passengers' => $Passengers
                ];
                $client = new Client();
                $res = $client->request('POST',$url,[
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'json' => $jsonData
                ]);
                $result = json_decode($res->getBody()->getContents(),true);
                $model = new FlightBooking();
                $model->customer_id = $customer_id;
                $model->total_amount = $flight['Fare']['PublishedFare'];
                $model->request_data = json_encode($jsonData);
                $model->response_data = json_encode($result);
                $model->payment_from = 'atom';
                $model->booked_by = 1;
                $model->booking_id = $result['Response']['Response']['BookingId'];
                $model->save();
                $bookingResults[] = ['error_status'=>$result['Response']['Error']['ErrorCode'],'result'=>$result];
            }
            return $bookingResults;
        }
    }

    protected function bookFlightMethod($TokenId, $TraceId, $ResultIndex, $Passengers, $url){
        $jsonData = [
            'EndUserIp' => '202.14.121.198',
            'TokenId' => $TokenId,
            'TraceId' => $TraceId,
            'ResultIndex' => $ResultIndex,
            'Passengers' => $Passengers
        ];
        $client = new Client();
        $res = $client->request('POST',$url,[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        return ['response'=>json_decode($res->getBody()->getContents(),true),'jsonData'=>$jsonData];
    }


    public static function journeyType(){
        return [
            1   =>  'OneWay',
            2   =>  'Return',/*
            3   =>  'Multi Stop',
            4   =>  'AdvanceSearch',
            5   =>  'Special Return'*/
        ];
    }

    public static function cabinClasses(){
        return [
            1   =>  'All',
            2   =>  'Economy',
            3   =>  'PremiumEconomy',
            4   =>  'Business',
            5   =>  'PremiumBusiness',
            6   =>  'First'
        ];
    }

    public function putFlightBookings($requestData, $responseData){
        $customersList = Session::get('customers_list');
        $flightData = Session::get('flight_data');
        $client_id = Session::get('client_id');
        $flight_token = Session::get('flight_token');
        $model = new FlightBooking();
        $model->customer_id = $client_id;
        $model->total_amount = count($customersList)*$flightData['single_amount'];
        $model->request_data = json_encode($requestData);
        $model->response_data = json_encode($responseData);
        $model->payment_from = 'wallet';
        $model->booked_by = 1;
        $model->booking_id = $responseData['Response']['Response']['BookingId'];
        $model->save();
        return $model;
    }

    public static function cancelFlight($booking_id, $source){
        self::authenticate();
        $url = self::$API.'ReleasePNRRequest';
        $jsonData = [
            'EndUserIp' => self::$IP,
            'TokenId' => self::$token,
            'BookingId' => $booking_id,
            'Source' => $source
        ];
        $client = new Client();
        $res = $client->request('POST',$url,[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $jsonData
        ]);
        $result = json_decode($res->getBody()->getContents(),true);
        return $result;
    }

    public static function removeSessions($successArray, $tripType){
        Session::flash('success','Flight booked successfully!');
        Session::forget('customer_details');
        Session::forget('selected_flight');
        Session::forget('request_search');
        Session::put('flight_success_data',$successArray);
        Session::put('trip_type', $tripType);
    }

    public static function bookFlightFromApi($request){
        self::authenticate();
        $bookedFlights = [];
        foreach($request->result_index as $key => $index){
            $traceId = $request->trace_id;
            $flight_token = Session::get('flight_token');
            $resultindex = $index;
            $selfObject = new self;
            $fareResult = $selfObject->getFareResult($flight_token, $traceId, $resultindex);
            if($fareResult['Response']['Error']['ErrorCode'] != 0){
                return ['status'=>'error','result'=>$result,'booked_flights'=>$bookedFlights];
            }
            if(!is_array($request->customers) || count($request->customers) == 0){
                return ['status'=>'error','result'=>'At least one customer should exist!','booked_flights'=>$bookedFlights];
            }
            $Passengers = $selfObject->putCustomers($request->customers);

            $jsonData = [
                'EndUserIp' => '202.14.121.198',
                'TokenId' => $flight_token,
                'TraceId' => $traceId,
                'ResultIndex' => $resultindex,
                'Passengers' => $Passengers
            ];
            $client = new Client();
            $res = $client->request('POST',$url,[
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => $jsonData
            ]);
            $result = json_decode($res->getBody()->getContents(),true);
            if($result['Response']['Error']['ErrorCode'] != 0){
                return ['status'=>'error','result'=>$result,'booked_flights'=>$bookedFlights];
            }else{
                $bookedFlights[] = $result;
            }
        }
        return ['status'=>'success','result'=>[],'booked_flights'=>$bookedFlights];
    }

    protected function putCustomers($customers){
        $Passengers = [];
        foreach($customers as $key => $customer){
            $customerData = [];
            $customerData['Title'] = $customer['title'];
            $customerData['FirstName'] = $customer['firstname'];
            $customerData['LastName'] = $customer['lastname'];
            $customerData['PaxType'] = '1';
            $customerData['Gender'] = ($customer['title'] == 'Mr')?'1':'2';
            $customerData['GSTCompanyAddress'] = 'A-fhgjkhsjkfd';
            $customerData['GSTCompanyContactNumber'] = '9898989898';
            $customerData['GSTCompanyName'] = 'ACME MEDIA CREATIONS';
            $customerData['GSTNumber'] = '07AASFA7870NIZL';
            $customerData['GSTCompanyEmail'] = 'nikhil123@gmail.com';
            $customerData['AddressLine1'] = $customer['address'];
            $customerData['City'] = $customer['city'];
            $customerData['CountryCode'] = $customer['country_code'];
            $customerData['CountryName'] = $customer['country_name'];
            $customerData['ContactNo'] = $customer['contact'];
            $customerData['Email'] = $customer['email'];
            $customerData['IsLeadPax'] = 'true';
            $customerData['Fare'] = $fareResult['Response']['Results']['Fare'];
            $Passengers[] = $customerData;
        }
    }

}