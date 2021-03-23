<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Helpers\PaymentProcess;
use App\Helpers\TransactionResponse;
use App\Model\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\FlightApi;
use App\Helpers\Hotel;
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
  //protected $api_url ="http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/";
    //protected $hotel_url = 'https://api-sandbox.grnconnect.com/api/v3/hotels/';
   //protected $hotel_key = 'b12092d579e8795a77c3abe759d6185f';

//live
    protected $hotel_url = 'https://v4-api.grnconnect.com/api/v3/hotels/';
    protected $hotel_key = '7a0ad1b28d1b56ec461f9bd0c3034d86';

    public function __construct(){

        // echo '<p>sand box api</p>';
      ini_set('memory_limit','-1');
    }
    
    public function  hotel_detail( $sid , $code){
      
        $hotel_req  = Session::get('hotel_req');
        // dd($hotel_req);
        unset($hotel_req['destination_code']);
        $hotel_req['hotel_codes'] = [$code];
        $hotel_req['rates'] = 'comprehensive';

        $client = new Client();
        $res = $client->request('GET',$this->hotel_url.$code.'/images',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $hotels_image = $res->getBody()->getContents();
        $image = json_decode($hotels_image,true);

       // dd($image);
        if(!empty($image['images'])){
            $hotel_imgs = $image['images'];
        }else{
            $hotel_imgs ='none';
        }
        $hotel_api = new Client();
        $hotel_res= $hotel_api->request('GET',$this->hotel_url.'availability/'.$sid.'?hcode='.$code.'&bundled=true',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ]
            
        ]);

        $response = $hotel_res->getBody()->getContents();
        $hotel = json_decode($response,true);
        Hotel::hotel_log('search_id' , $hotel['search_id']);
        Hotel::hotel_log('refetch_result' , json_encode($hotel));
       // dd($hotel);
        if(!empty($hotel['errors'][0])){
        // dump($hotel);
            $error = $hotel['errors'];
        return  view('frontend.pages.hotel.hotel_detail', compact('error'));//redirect()->route('index');
            
       }



        // if(!empty($hotel)){
        //     return redirect()->route('index');
        // }
        // dump($hotel);
        Session::put('rates', $hotel['hotel']);
        //return view('frontendo.pages.hotel_detail', compact('code', 'hotel_imgs', 'hotel', 'hotel_req'));

        return view('frontend.pages.hotel.hotel_detail', compact('code', 'hotel_imgs', 'hotel', 'hotel_req'));
    }

    public function check_status()
    {
       return view('frontend.pages.booking_status'); 
    }

     public function hotel_book_status(Request $request)
    {

        // $this->validate($request, [ 'bref'=>'required' ]);
        //dd($request->all());
        $bref = $request->bref;
        $status = new Client();
        $status_res= $status->request('GET',$this->hotel_url.'bookings/'.$bref.'?type=GRN',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ]
            
        ]);

         $response = $status_res->getBody()->getContents();
        $status_res = json_decode($response,true);
        if( !empty($status_res['errors'])){
            $error = $status_res['errors'];
            return view('website.pages.error', compact('error'));

        }
        // dd($status_res);
       return view('frontend.pages.booking_detail' , compact('status_res','bref') );
    }

    public function cancel_hotel_booking($bref)
    {
        $cancel = new Client();
        $cancel_res= $cancel->request('DELETE',$this->hotel_url.'bookings/'.$bref,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ]
            
        ]);

         $response = $cancel_res->getBody()->getContents();
        $cancel_res = json_decode($response,true);

        Hotel::cancel_booking_log($bref, json_encode($cancel_res),'live');
        //dd($cancel_res);

        return view('frontend.pages.cancel_book' , compact('cancel_res') );
    }
// use in ajax
    public function get_code($name){

        $code = SearchData::where('name',$name)->first();

        return response()->json($code);
    }

    //use in ajax
    public function search_data($search){

        $result = SearchData::Where('name', 'like', $search . '%')->pluck('id','name');
        // dd($result);
         $dataArray = [];
        foreach($result as $city_name => $city_id){
            $dataArray[] = ['id'=>$city_id,'name'=>$city_name];
        }
       return response()->json($dataArray);

        // $city = $result->map(function($item, $key){
        //         return null;
        //     });

        // return response()->json($city);
    }

    public function index(){

        return view('frontend.pages.index');
            // ,['countries'=>collect($countries['countries'])->pluck('name','code')]);
    }

    public function getCities(Request $request){
        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/cities?country='.$request->country,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $cities = $res->getBody()->getContents();


        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/destinations?country='.$request->country,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
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
  


    protected function hotel_availablity($request , $hotel_codes){
        $hotel_category = [2,7];
        if(!empty($request['stars'])){
            $hotel_category=[(int)$request['stars']];
        }
            $jsonData = [
            'hotel_codes' => $hotel_codes,
            'checkin' => Carbon::parse($request->checkin)->format('Y-m-d'),
            'checkout' => Carbon::parse($request->checkout)->format('Y-m-d'),
            'client_nationality' => 'IN',
            'more_results' => true,
            "cutoff_time"=> 50000,
            // "response"=>'fast',
            "currency"=> "INR",
            'hotel_info' => true,
            'rates' => 'concise',
            'hotel_category' => $hotel_category 
        ];


        // dd('json', $jsonData);

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
        $client = new Client();

        //https://api-sandbox.grnconnect.com/api/v3/hotels/availability

         
        $res = $client->request('POST',$this->hotel_url.'availability',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=> $jsonData
        ]);


        Session::put('hotel_req',$jsonData);
        $results    =   json_decode($res->getBody()->getContents(),true);
        
       
      return $results;//->toArray();
    }

    public function hotelsResults(Request $request){


Session::put('orginal_request', $request->all());
        //dump( Session::get('orginal_request'),  $request->all());

 // $paymentOptions = [];
 //            $paymentOptions['payment_for'] ="hotel";
 //            $paymentOptions['amount'] =1;//$request->price;
 //            $paymentOptions['return_to'] = 'https://paynetzuat.atomtech.in/paynetzclient/ResponseParam.jsp';
 //            $paymentOptions['client_code'] = 13;//$customer_id;
 //            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
 //            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
 //            $paymentOptions['customer_details']['customer_name'] = $request['holder']['name'];
 //            $paymentOptions['customer_details']['customer_email'] =$request['holder']['email'];
 //            $paymentOptions['customer_details']['customer_mobile'] = $request['holder']['phone_number'];
 //            $paymentOptions['customer_details']['billing_address'] = 'amritsar';
 //            $paymentOptions['customer_details']['customer_account_id'] = 1;
 //            $url = PaymentProcess::process($paymentOptions);
        // 428090201958- 5231 07-22

 //              return redirect($url);
         

        Hotel::hotel_log_session_start($request->code);
        Hotel::hotel_log('request_for', json_encode($request->toArray()));
        $no_of_hotels =0;
        $hotel_detail= HotelInfo::where('city_code',$request->code)->pluck('code'); 
        $hotel_codes = $hotel_detail->toArray();

        // dump( json_encode($hotel_codes) );
        $new = [];
        if(count($hotel_codes) > 100 ){
            $chunk = array_chunk( $hotel_codes, 99);
           // dump($chunk);
            $chunk_hotel_cod_size   = count($chunk);
            for($i=0; $i< $chunk_hotel_cod_size; $i++ ){
                 $new[$i] =  $hotel = $this->hotel_availablity($request,  $chunk[$i]);
                
                 if($i==0){$parm = 'availability_response'; }
                 if($i==1){$parm = 'availability_response_one'; }
                 if($i==2){$parm = 'availability_response_two'; }
                 if($i==3){$parm = 'availability_response_three'; }
                 if($i==4){$parm = 'availability_response_four'; }
                 if($i==5){$parm = 'availability_response_five'; }
                 if($i==6){$parm = 'availability_response_six'; }
                 if($i==7){$parm = 'availability_response_seven'; }
                 if($i==8){$parm = 'availability_response_eight'; }
                 if($i==9){$parm = 'availability_response_nine'; }
                 if($i==10){$parm = 'availability_response_ten'; }

                Hotel::hotel_log($parm , json_encode($hotel));
                   // dump(1, $hotel);        
                 if(!empty($hotel['no_of_hotels'])){
                    $no_of_hotels = $no_of_hotels + $hotel['no_of_hotels'];
                 }
                 if(!empty($hotel['errors'][0])) {
                        unset($new[$i]);
             //          dump($hotel['errors'][0]); 
                       // return view('website.pages.page-404');
                    }
            }
          // dd(json_encode($new));
            $hotel = $new;
        }else{
            
           $hotel[] = $this->hotel_availablity($request,   $hotel_codes);
           
            Hotel::hotel_log('availability_response' , json_encode($hotel));

          
           if(!empty($hotel[0]['no_of_hotels'])) {
                $no_of_hotels = $hotel[0]['no_of_hotels'];
            }
            // if(!empty($hotel[0]['errors']))
            // {
            //     dump($hotel[0]['errors']);
            //    return view('website.pages.page-404');
            // }
        }


        $mark_up = Hotel::hotel_mark_ups($request->code);

       

        // dd($hotel);

         // Hotel::hotel_log('availability_response' , json_encode($hotel));
        
        //return view('website.pages.search-result-hotel',['no_of_hotels'=>$no_of_hotels , 'results'=>$hotel, 'request'=> Session::get('hotel_req'),'mark_up'=>$mark_up ]);
        return view('frontend.pages.hotel.search-result-hotel',['no_of_hotels'=>$no_of_hotels , 'results'=>$hotel, 'request'=> Session::get('hotel_req'),'mark_up'=>$mark_up ]);
    }

    public function hotel_recheck(Request $request){

        $client = new Client();
        $res = $client->request('POST',$this->hotel_url.'availability/'.$request->search_id.'/rates/?action=recheck',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
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

//dump($recheck, $recheck['hotel']['rate']['rooms'][0]['room_reference']);

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
        $nres = $nclient->request('POST',$this->hotel_url.'bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$booking_item
        ]);



        $nresults    =   $nres->getBody()->getContents();
        $nrecheck      =   json_decode($nresults,true);

//dd($booking_item, $nresults);
       // dd($nrecheck, Session::get('hotel_req'));
    }

    protected function re_fetch_check($sid, $array){

        $nclient = new Client();
        $nres = $nclient->request('GET',$this->hotel_url.'availability/'.$sid.'?rates='.$array['rate_key'],[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
           
        ]);

        $nresults    =   $nres->getBody()->getContents();
        $nrecheck      =   json_decode($nresults,true);

        return $nrecheck;
    }

    public function hotel_book(Request $request){

        //dd($request->all());

        if($request->isMethod('post')){
            Session::put('hrequest', $request->all());
            $req =    $request->all();
        }else{
           $req = $request =  Session::get('hrequest');
        }
      

        $preserve = Session::get('rates');
       // dump($preserve);
        $preserve_rates= $preserve['rates'] ;
        if(!empty($request['rate_index'])){
            foreach ($request['rate_index'] as $key => $value) {
                $new_rates[$value] =   $preserve_rates[$value];
                //dump($new_rates[$value]);
                //dump( $req['search_id'], $new_rates[$value]['rate_key'], $new_rates[$value]['group_code']);
                // if($new_rates[$value]['rate_type'] =='recheck'){
                        $new_rates[$value] = Hotel::recheck($req['search_id'], $new_rates[$value]['rate_key'], $new_rates[$value]['group_code'], 'live');

                        if(!empty($new_rates[$value]['errors'])){
                            $error = $new_rates[$value]['errors'];
                            return view('frontend.pages.booking_form', compact('error'));
                        }
                     //dump(1, $new_rates[$value]);
                // }
            }
           //dd($new_rates);
            return view('frontend.pages.non_bundle_book', compact('new_rates', 'req', 'preserve'));
        }
       // dd(Session::get('rates'), $request->all());
 // dump(5, @$request['price']);
        $hotel  = Session::get('hotel_req');
        // $search_id = $hotel['search_id'];
        $checkin = $hotel['checkin'];
        $checkout = $hotel['checkout'];

        $hotel_code = $request['hotel_code'];
        $city_code  = $request['city_code']; 
        $group_code  = $request['group_code']; 
        $rate_key  = $request['rate_key']; 
        $room_code  = $request['room_code'];
        $price  = @$request['price'];


        $recheck = new Client();
        $re_res = $recheck->request('post',$this->hotel_url.'availability/'.$request['search_id'].'/rates/?action=recheck',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>[
                    'rate_key'=> $request['rate_key'], 
                    'group_code'=> $request['group_code']
                    ]

        ]);

                $recheck_request = [
                    'search'=> $request['search_id'],
                    'rate_key'=> $request['rate_key'], 'group_code'=> $request['group_code'] ];
                Hotel::hotel_log('recheck_request', json_encode($recheck_request));

        $resu    =   $re_res->getBody()->getContents();
        $recheck = json_decode($resu, true);

                        Hotel::hotel_log('recheck_response', json_encode($recheck));


        $recheck['price'] =  $price;
        if(!empty($recheck['errors'][0])){
            $error = $recheck['errors'];
            return view('frontend.pages.booking_form', compact('error'));
        }            


       // dd($recheck);
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
        $booking_name   = $request['booking_name'];

       return $reqData = [
                        'search_id'=>  $search_id,
                        'hotel_code'=> $hotel_code,
                        'city_code'=> $city_code,
                        'group_code'=> $group_code ,
                        'checkin'=>  $checkin,
                        'checkout'=> $checkout,
                        'booking_name'=> $booking_name,
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
                                        "client_nationality"=> "IN"
                                    ]
                       
                    ];

        Session::put('final_book', $reqData);
        //dd($reqData);
   }


   public function non_bundle_booking(Request $request){
         // dd(json_encode($request->all()));
        
//dd($request->all());

   // $request['booking_name'] = "leavecasa Acme media";

    $client = new Client();
        $re_res = $client->request('post',$this->hotel_url.'bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$request->all()

        ]);

         $resu    =   $re_res->getBody()->getContents();
        $recheck = json_decode($resu, true);
//dump($recheck);

        // Hotel::hotel_log('booking_id' , $recheck['booking_id'] );
        // Hotel::hotel_log('booking_reference' , $recheck['booking_reference'] );
        // Hotel::hotel_log('booking_detail' , json_encode($recheck) );
        return view('frontend.pages.booking_confirm', compact('recheck'));
        //dd($recheck);


   }


   public function hotel_payment(Request $request){

    // dd($request->all());
           $data = $this->put_final_request_data($request);
           Session::put('book_data',$data);

            $paymentOptions = [];
            $paymentOptions['payment_for'] ="hotel";
            $paymentOptions['amount'] = $request->price;
            $paymentOptions['return_to'] = route('pay');
            $paymentOptions['client_code'] = 13;//$customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $request['holder']['name'];
            $paymentOptions['customer_details']['customer_email'] =$request['holder']['email'];
            $paymentOptions['customer_details']['customer_mobile'] = $request['holder']['phone_number'];
            $paymentOptions['customer_details']['billing_address'] = 'amritsar';
            $paymentOptions['customer_details']['customer_account_id'] = 1;
            $url = PaymentProcess::process($paymentOptions);
            return redirect($url);

            // return view('button_payment',['urls'=>$url]);
            // return redirect()->to($url);
           // dd($url);https://

            // echo "<script> window.location = ".$url."</script>";//redirect()->away($url);
          // return  redirect::to($url);

          // return redirect()->route('pay');

   }

    public function payment_response(request $request){
//testing
       // return $this->final_book();
       
//live
        if($request['f_code'] == 'Ok'){
            return $this->final_book();
        }else{

            return view('frontend.pages.payment_failed', ['desc'=>$request['desc']]);
        }
    }

    public function final_book(){

        $data = Session::get('book_data');
     // dd($request->all());
          // $data = $this->put_final_request_data($request);

       // dd($data);
//dump($data);
           // $request['booking_name'] = "leavecasa Acme media";
    $client = new Client();
        $re_res = $client->request('post',$this->hotel_url.'bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$data
        ]);

        $resu    =   $re_res->getBody()->getContents();
        $recheck = json_decode($resu, true);

//dump($recheck);
if(!empty($recheck['booking_id']) && !empty($recheck['booking_reference'])){
    Hotel::hotel_log('booking_id' , $recheck['booking_id'] );
    Hotel::hotel_log('booking_reference' , $recheck['booking_reference'] );
    Hotel::hotel_log('booking_detail' , json_encode($recheck) );
}
elseif(!empty($recheck['errors'])){
        $error = $recheck['errors'];
        Hotel::hotel_log('booking_error' , json_encode($error));
        return view('website.pages.error', compact('error'));
    }

        return view('frontend.pages.booking_confirm', compact('recheck'));
        //   dd($recheck);
        // if(empty($processing_id)){

        //     //dd($info);
        //     $paymentOptions = [];
        //     $paymentOptions['payment_for'] ="hotel";
        //     $paymentOptions['amount'] =$request->price;
        //     $paymentOptions['return_to'] = route('hotel.confirm.book');
        //     $paymentOptions['client_code'] = 13;//$customer_id;
        //     $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
        //     $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
        //     $paymentOptions['customer_details']['customer_name'] = $request['holder']['name'];//'paljinder$request->firstname[0];
        //     $paymentOptions['customer_details']['customer_email'] = $request['holder']['email'];//$request->email;
        //     $paymentOptions['customer_details']['customer_mobile'] = $request['holder']['phone_number'];
        //     $paymentOptions['customer_details']['billing_address'] = str_replace(["\n","\r"],"",'India');
        //     $paymentOptions['customer_details']['customer_account_id'] = 13;
        //     $url = PaymentProcess::process($paymentOptions);
        //     return redirect($url);//->to($url);
        // }

    }



    public function booking_confirm(request $request){
        //dd($request);
        $reqData = Session::get('final_book');
        // $request['booking_name'] = "leavecasa Acme media";
        $client = new Client();
        $res = $client->request('post','http://api-sandbox.grnconnect.com/api/v3/hotels/bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key'   => $this->hotel_key,
                'Accept'    => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$reqData
        ]);
        $results        =   $res->getBody()->getContents();
        $recheck   =   json_decode($results, true);

        //dump(11,$recheck);
if(!empty($recheck['booking_id']) && !empty($recheck['booking_reference'])){
        Hotel::hotel_log('booking_id' , $recheck['booking_id'] );
        Hotel::hotel_log('booking_reference' , $recheck['booking_reference'] );

        Hotel::hotel_log('booking_detail' , json_encode($recheck) );
}else{

     if(!empty($recheck['errors'])){
                            $error = $recheck['errors'];
                            
                                    Hotel::hotel_log('booking_error' , json_encode($error) );

                            return view('website.pages.error', compact('error'));
                        }
} 


        dump($recheck);

        return view('frontend.pages.booking_confirm', compact('recheck'));


    }

   

   

}
// 446 4280902019585231 07/22