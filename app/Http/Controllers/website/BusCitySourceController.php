<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BusBookingSource;
use App\Helpers\BusApi;
use Carbon\Carbon;
use Session;
use App\Helpers\PaymentProcess;
use Auth;



class BusCitySourceController extends Controller
{
    public function bus_city($parm){
    $data = BusBookingSource::where('city_name','like',$parm.'%')->pluck('city_name','city_id');

         $dataArray = [];

		foreach ($data as $key => $value) {
            $dataArray[] = ['id'=>$key,'name'=>$value];
		}

		return response()->json($dataArray);
    }


    public function get_bus_destination($source){

        $data = BusApi::get_destination($source);

       //dump( $data);
      foreach ( $data['cities'] as $key => $value) {
            if(is_array( $value)){
            	 $dataArray[$key] = $value;
             // $dataArray[$value['name']]=['id'=>$key,'name'=>$value];
            }else{
                if(!is_numeric($value)){

                    $dataArray[] = ['id'=>$key,'name'=>$value];
                }
            }
        }

        return response()->json($dataArray);

    }

    public function get_city_id($city_name){
    	return $data = BusBookingSource::where('city_name', $city_name)->first()->city_id;
    }

    public function searchResults(Request $request){

        $request->validate([
        'bus_from' => 'required',
        'bus_to' => 'required',
    ]);
       
        $action = $request->action;
         Session::put('searchBus',$request->all());
        $results = $this->searchBus($request);
        $action = 'bus';

      //dd($results);
        return view('website.pages.search-result-bus',['results'=>$results,'action'=>$action,'request'=>$request]);
    }
    protected function searchBus($request){
      //  dump($request->all());
        $request->to = Carbon::parse($request->journey_date)->format('Y-m-d');

        $request->source = $request->bus_from;
        $request->destination = $request->bus_to;

        Session::put('boardingPointId', $request->source);
        Session::put('destination', $request->bus_to);
        $busApi = BusApi::searchBus($request);

        //dd($busApi);
        return $busApi;
    }
    
    public function getSeatDetails(Request $request, $bus_id){

        $request['boarding_points'] =json_decode( $request['boarding_points'],true);
        $request['droping_time'] =json_decode( $request['droping_time'],true);

     

        $seatDetails = BusApi::getSeats($bus_id);

        if(isset($seatDetails['maxSeatsPerTicket'])){
            $maxSeats = $seatDetails['maxSeatsPerTicket'];
        }else{
            $maxSeats = 6;
        }
        $seatDetails = collect($seatDetails['seats']);
       
        $seatData = $seatDetails->groupBy('zIndex')->map(function($records){
            return $records->groupBy('row');
        });

      //  dump( $seatData->toArray());

        
         Session::put('selected_bus',$request->all());
        return view('website.pages.seats',['seatData'=>$seatData,'request'=>$request->all(),'maxSeats'=>$maxSeats,'bus_id'=>$bus_id,'from'=>'webiste']);//->render();
    }

    public function busBokingPassenger(Request $request){


        if($request->isMethod('get'))
        {
            if(Session::has('selected_seats')){
               $data = Session::get('selected_seats');   
            //dump($data);
            }
            
        }else{

           $data = $request->all();
            Session::put('selected_seats',$data);
        }

        
         $seats_data = explode(',',  $data['seats_selected']);
         // dump($seats_data);
             $data['total_fare'] = $data['total_price'];
             $data['markup_price'] = $data['markup_price'];

            // dump($data['markup_price']);
         $no_of_seats = count($seats_data);
         if($no_of_seats >1){

              $data['total_price'] = $this->calculate_fare($data['total_price'], $no_of_seats);
           // $request['seats_selected'] = 
         }


        return view('website.pages.bus.bus_book_form',['seats_data'=>$seats_data , 'req_data'=>$data]);
    }

    public function generate_block_key(Request $request){

       // dd( $request['markup_price']);

        $wallet_balance = PaymentProcess::wallet_balance();

        //dump($wallet_balance);

        $wallet_status  = false;

      //  dump( (int)$wallet_balance > (int)$request['markup_price']);
        if((int)$wallet_balance > (int)$request['markup_price']){
            $wallet_status  = true;
        }

        // dd($request->all());

        $response = BusApi::bookBus($request->all());

           // dump($request->all(), $response);
               $errorStatus = false;
                $errorMessage = '';
               
            if(!empty($response['status']) && $response['status']=="error"){
                $errorStatus = true;
                $errorMessage=  $response['message'];
            }

           

        return view('website.pages.bus.book_bus_ticket',['res'=>$response, 'wallet'=>  $wallet_status , 'req_data'=>$request->all(),'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);
        //dd($request->all());
    }



    protected  function calculate_fare($amount, $no_of_seat){

        return $amount/ $no_of_seat; 
    }




      public function bus_payment(Request $request){

        if(!empty($request['wallet'])){

            PaymentProcess::debit_wallet_balance($request['markup_price'], 'Bus Ticket');

            $wallet_balance = PaymentProcess::wallet_balance();

            return $this->confirmTicket($request['block_key']);

            return "wallet Money deduct now wallet balance ".$wallet_balance;

        }

 
          

        Session::put('blockKey',$request['block_key']);

           $paymentOptions = [];
            $paymentOptions['payment_for'] ="Bus";
            $paymentOptions['amount'] = $request->markup_price;
            $paymentOptions['return_to'] = route('bus.pay');
            $paymentOptions['client_code'] = 13;//$customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $request['name'];
            $paymentOptions['customer_details']['customer_email'] =$request['email'];
            $paymentOptions['customer_details']['customer_mobile'] = 9915482378;// $request['phone_number'];
            $paymentOptions['customer_details']['billing_address'] = 'amritsar';
            $paymentOptions['customer_details']['customer_account_id'] = 1;
            $url = PaymentProcess::process($paymentOptions);
          //  dd($url);
            return redirect($url);

            // return view('button_payment',['urls'=>$url]);
            // return redirect()->to($url);
           // dd($url);https://

            // echo "<script> window.location = ".$url."</script>";//redirect()->away($url);
          // return  redirect::to($url);

          // return redirect()->route('pay');

   }

   public function pay_response(request $request){

        if($request['f_code'] == 'Ok'){

            $block = Session::get('blockKey');
            $response = BusApi::conirmTicket($block);
          if(!empty($response['status']) && $response['status']=="error"){
                return  $response['message'];
            }

           $ticket_detail =  BusApi::tiket_detail($response['tin']);
           $cid = Auth::guard('customer')->id();
           //BusApi::bus_log($cid, $response['tin'], json_encode($ticket_detail),'web' );
           return view('website.pages.bus.bus_book_detail',['detail'=>$ticket_detail]);
        }else{
        	// dd($request->all());
            return view('frontend.pages.payment_failed', ['desc'=>$request['desc']]);
        }

   }


public function confirmTicket($block){
            
           	$response = BusApi::conirmTicket($block);
            $errorStatus = false;
            $errorMessage = '';
               
             if(!empty($response['status']) && $response['status']=="error"){
                $errorStatus = true;
                $errorMessage=  $response['message'];
            } 

           $ticket_detail =  BusApi::tiket_detail($response['tin']);

           $cid = Auth::guard('customer')->id();

           BusApi::bus_log($cid, $response['tin'], json_encode($ticket_detail),'web' );

        return view('website.pages.bus.bus_book_detail',['detail'=>$ticket_detail,'errorStatus'=>$errorStatus,'errorMessage'=>$errorMessage]);


           
}

public function book(){

    $bookingArray = [
    "availableTripId"=>"1000106732372959398",
    "boardingPointId"=>"19053792",
    "destination"=>"19098970",
    "source"=> "3",

    "inventoryItems"=>[
        [
            "fare"=>"650.0",
            "ladiesSeat"=>"false",
            "seatName"=> "3",
            "passenger"=>[
                "address"=>"some address",
                "age"=>"21",
                "email"=>"test@redbus.in",
                "gender"=>"MALE",
                "idNumber"=>"ID123",
                "idType"=>"PAN_CARD",
                "mobile"=>"9898989898",
                "name"=>"test",
                "primary"=>"true",
                "title"=>"Mr"
            ]
            
        ]
    ],
    ];



 $response = BusApi::bookBus($bookingArray);

       dd($bookingArray, $response);

}


    public function bookBus(Request $request){

dd($request->all());
 $bookingArray['availableTripId'] = $request['trip_id'];

 $bookingArray['boardingPointId'] = "25937";
 $bookingArray['destination'] = "79413";
 $bookingArray['source'] = "1369";

 $requestData = $request->all();

        for($i = 0; $i < count($requestData['name']); $i++){
            $details = [];
            $details['seatName'] = '38';//$requestData['seat'][$i];//$seats[$i];
            $details['ladiesSeat'] = "false";
            $details['fare'] = $requestData['total_price'];//($requestData['total_price']/count($requestData['seat']));
            if($i == 0){
                $details['passenger']['age'] = $requestData['age'][$i];
                $details['passenger']['primary'] = "true";
                $details['passenger']['name'] = $requestData['name'][$i];
                $details['passenger']['title'] = $requestData['title'][$i];
                $details['passenger']['gender'] = "MALE";//$requestData['gender'][$i];
                $details['passenger']['idType'] = "PAN_CARD"; //$requestData['id_proof_type'];
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

dump(json_encode($bookingArray)); 


       

 $response = BusApi::bookBus($bookingArray);

 dd($response);

// inventoryItems [ ]


    }
    // public function bookBus(Request $request){

    //     dd($request->all());
    //     $bookingArray = [];
    //     $bookingDetails = json_decode($request->booking_details, true);
    //     $boardingPoint = explode('-',$bookingDetails['boarding_point']);
    //     $seats = explode(',',$bookingDetails['seats_selected']);

    //     $bookingArray['availableTripId'] = $bookingDetails['bus_id'];
    //     $bookingArray['boardingPointId'] = $boardingPoint[0];
    //     $bookingArray['destination'] = $bookingDetails['destination'];
    //     $bookingArray['source'] = $bookingDetails['source'];
    //     $bookingArray['inventoryItems'] = [];

    //     $requestData = $request->all();

    //     for($i = 0; $i < count($requestData['name']); $i++){
    //         $details = [];
    //         $details['seatName'] = $seats[$i];
    //         $details['ladiesSeat'] = false;
    //         $details['fare'] = ($bookingDetails['total_price']/count($seats));
    //         if($i == 0){
    //             $details['passenger']['age'] = $requestData['age'][$i];
    //             $details['passenger']['primary'] = true;
    //             $details['passenger']['name'] = $requestData['name'][$i];
    //             $details['passenger']['title'] = $requestData['title'][$i];
    //             $details['passenger']['gender'] = $requestData['gender'][$i];
    //             $details['passenger']['idType'] = $requestData['id_proof_type'];
    //             $details['passenger']['email'] = $requestData['email'];
    //             $details['passenger']['idNumber'] = $requestData['id_no'];
    //             $details['passenger']['address'] = $requestData['address'];
    //             $details['passenger']['mobile'] = $requestData['mobile'];
    //         }else{
    //             $details['passenger']['age'] = $requestData['age'][$i];
    //             $details['passenger']['primary'] = false;
    //             $details['passenger']['name'] = $requestData['name'][$i];
    //             $details['passenger']['title'] = $requestData['title'][$i];
    //             $details['passenger']['gender'] = $requestData['gender'][$i];
    //         }
    //         $bookingArray['inventoryItems'][] = $details;
    //     }
    //     BusApi::bookBus($bookingArray);
    //     dd($bookingArray);
    // }

}