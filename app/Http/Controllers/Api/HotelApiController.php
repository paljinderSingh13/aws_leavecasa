<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Model\HotelInfo;
use App\Model\SearchData;
use Carbon\Carbon;
use App\Helpers\Hotel;

class HotelApiController extends Controller
{
    protected $hotel_url = 'https://api-sandbox.grnconnect.com/api/v3//hotels/'; //leavecasa@562  nitesha@acmemedia.in
    protected $hotel_key = 'b12092d579e8795a77c3abe759d6185f';
    
//live
    //protected $hotel_url = 'https://v4-api.grnconnect.com/api/v3/hotels/';
    //protected $hotel_key = '7a0ad1b28d1b56ec461f9bd0c3034d86';

    public function city_data($city){
       // $search = SearchData::Where('name', 'like', $city .'%')->pluck('name','code');
        $result = SearchData::select(['code','name'])->where('name', 'like', $city .'%')->get();
        return response()->json($result);
    }

     public function book_detail($bref) {
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
            return response()->json($status);
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
        Hotel::cancel_booking_log($bref, json_encode($cancel_res));
        return response()->json($cancel_res);
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
        $jsonData['rooms'] = $request->rooms;
        $client = new Client();
        $res = $client->request('POST',$this->hotel_url.'availability',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' =>  $this->hotel_key,
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


      $logid = Hotel::hotel_log_session_start($request->destination_code);
      Hotel::hotel_log('request_for', json_encode($request->toArray()) , $logid );
      Hotel::hotel_log('log_by','mobile' , $logid );


        $no_of_hotels =0;
        $hotel_detail = HotelInfo::where('city_code',$request->destination_code)->pluck('code');
        $hotel_codes = $hotel_detail->toArray();
        $new = [];
        if(count($hotel_codes) > 250 ){
            $chunk = array_chunk( $hotel_codes, 250);
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

                Hotel::hotel_log($parm , json_encode($hotel), $logid);
                if(!empty($hotel['no_of_hotels'])){
                    $no_of_hotels = $no_of_hotels + $hotel['no_of_hotels'];
                 }
                 if(!empty($hotel[0]['errors'])) {
                 	unset($new[$i]);
                   }
            }
            $hotel = $new;
        }else{
           $hotel[] = $this->hotel_availablity($request,   $hotel_codes);
             Hotel::hotel_log('availability_response' , json_encode($hotel[0]), $logid);

           if(!empty($hotel[0]['no_of_hotels'])){
           	$no_of_hotels = $hotel[0]['no_of_hotels'];
           }
       }
             $mark_up =  Hotel::hotel_mark_ups($request->destination_code);
            

    return response()->json(['status'=>'success', 'results'=>$hotel, 'no_of_hotels'=>$no_of_hotels,  'logid'=>$logid,'markup'=>$mark_up ]);
}

public function hotel_detail(Request $request){// dd($request->all());
    $mark_up =null;
	$sid 	= $request['search_id'];
	$code 	= $request['hotel_code'];
	$logid 	= $request['logid'];
    $client = new Client();
    $hotel_res= $client->request('GET',$this->hotel_url.'availability/'.$sid.'?hcode='.$code.'&bundled=true',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ]
        ]);

    $response = $hotel_res->getBody()->getContents();
    $hotel = json_decode($response,true);
if(!empty($hotel['hotel']['city_code'])){

 $mark_up =  Hotel::hotel_mark_ups($hotel['hotel']['city_code']);
}


    Hotel::hotel_log('search_id' , $hotel['search_id'], $logid);
    Hotel::hotel_log('refetch_result' , json_encode($hotel), $logid);
    if(!empty($hotel['errors'][0])){
        return response()->json(['status'=>'error', 'results'=>$hotel]);
       } 
    return response()->json(['status'=>'success', 'results'=>$hotel, 'logid'=>$logid, 'markup'=> $mark_up ]);

}


    public function hotel_images($code){

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
        $hotel_imgs = $image['images'];
        return response()->json(['status'=>'success', 'results'=>$hotel_imgs]);
    }


    public function cancelation_policy(Request $request){

        $sid = $request->search_id;
        $rate_key = $request->rate_key;
        $cp_code  = $request->cp_code;

       $data = Hotel::get_policy_by_code($sid, $rate_key, $cp_code);

       return response()->json(['status'=>'success', 'result'=>$data]);
    }

    public function recheck(request $request){

         //Hotel::hotel_log('recheck_response', json_encode($request->toArray()) , $logid);

      
        $logid  = $request['logid'];
        $recheck = new Client();
        $re_res = $recheck->request('post',$this->hotel_url.'availability/'.$request->search_id.'/rates/?action=recheck',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->hotel_key,
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
        Hotel::hotel_log('recheck_response', json_encode($result), $logid);

        $mark_up =  Hotel::hotel_mark_ups($result['hotel']['city_code']);


    return response()->json(['status'=>'success', 'results'=>$result,'markup'=>$mark_up]);

    }

    public function final_book(request $request){

        $logid  = $request['logid'];
        if(empty($request['customer_id'])){
            return response()->json(['status'=>'error', 'results'=>"mandatory login"]);
        }

        Hotel::hotel_log('booking_detail' , json_encode($request->toArray()), $logid  );

        //dd(123);
        $client = new Client();
        $res = $client->request('post',$this->hotel_url.'/bookings',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key'   => $this->hotel_key,
                'Accept'    => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
            'json'=>$request->all()
        ]);
        $results        =   $res->getBody()->getContents();
        $confirmation   =   json_decode($results, true);

        if(!empty($confirmation['booking_id']) && !empty($confirmation['booking_reference'])){
            Hotel::hotel_log('booking_id' , $recheck['booking_id'], $logid  );
            Hotel::hotel_log('booking_reference' , $recheck['booking_reference'], $logid  );
            Hotel::hotel_log('customer_id' ,$request['customer_id'], $logid);
            Hotel::hotel_log('booking_detail' , json_encode($recheck),$logid);
        }
        elseif(!empty($confirmation['errors'])){
            $error = $recheck['errors'];
            Hotel::hotel_log('booking_error' , json_encode($error));
            return response()->json(['status'=>'error', 'results'=>$error]);
        }

        return response()->json(['status'=>'success', 'results'=>$confirmation]);
    }

}
