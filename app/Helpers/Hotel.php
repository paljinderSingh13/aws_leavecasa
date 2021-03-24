<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use App\Model\HotelLog;
use Session;
use App\Model\Administrator\ApiSettings\HotelsMarkup;
/**
 * 
 */
class Hotel  
{

  //testingh
protected static $hotel_url = 'https://api-sandbox.grnconnect.com/api/v3/hotels/availability/'; //leavecasa@562  nitesha@acmemedia.in
protected static $hotel_key = 'b12092d579e8795a77c3abe759d6185f';
	
  // live
	//protected $hotel_url = 'https://v4-api.grnconnect.com/api/v3/hotels/availability/';
  //protected $hotel_key = '7a0ad1b28d1b56ec461f9bd0c3034d86';

  public static function hotel_mark_ups($city_code){

   $mark =  HotelsMarkup::select(['amount_by','amount','star_ratting'])->where(['city_code'=> $city_code,'visibility'=>1])->get();
   return $mark;
  }

  public static function city_rating_mark($city_code, $rating){

    $mark =  HotelsMarkup::select(['amount_by','amount','star_ratting'])->where(['city_code'=> $city_code,'visibility'=>1,'star_ratting'=>$rating])->first();
    return $mark;
  }
 

public static function cal_markup_percent_val($price, $percent){
  
  $mark_price  =  $price/100*$percent;
 return (int)$mark_price;
}



	public static function get_policy_by_code($sid, $rate_key, $cp_code, $live=null){

    

		$client = new Client();

    // if(!empty($live)){
    //     $live_url=  'https://api-sandbox.grnconnect.com/api/v3/hotels/availability/';
    //      $live_hotel_key = '7a0ad1b28d1b56ec461f9bd0c3034d86';
    //    $res = $client->request('POST',$live_url.$sid.'/rates/cancellation_policies/',[ 
    //               'headers' => [
    //                   'Content-Type' => 'application/json',
    //                   'api-key' =>  $live_hotel_key,
    //                   'Accept' => 'application/json',
    //                   'Accept-Encoding' => 'application/json'
    //               ],
    //                 'json'=>[ "rate_key"=> $rate_key,
    //             "cp_code"=>$cp_code]
    //           ]);

    // }else{

        $res = $client->request('POST',self::$hotel_url .$sid.'/rates/cancellation_policies/',[ 
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => self::$hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
             	'json'=>[ "rate_key"=> $rate_key,
    			"cp_code"=>$cp_code]
        ]);
    //}


		$results    =   $res->getBody()->getContents();
    return json_decode($results,true);
	}


public static function recheck($sid, $rate_key, $gr_code){

      $client = new Client();
        // $res = $client->request('POST',$this->hotel_url.$sid.'/rates/?action=recheck',[
      $res = $client->request('POST',self::$hotel_url.$sid.'/rates/?action=recheck',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => self::$hotel_key,
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
                'json'=>[ "rate_key"=> $rate_key,
                "group_code"=>$gr_code]
        ]);

        $results    =   $res->getBody()->getContents();
       return json_decode($results,true);
    }

    public static function hotel_log_session_start($city_code){
        $ho = HotelLog::orderBy('id','desc')->first();
        if(empty($ho)){
          $uid =1;
        }else{
          $uid = $ho->id+1;
        }
        Session::put('uid', $uid);
         $hlog =  new HotelLog();
         $hlog->uid = Session::get('uid');
         $hlog->city_code = $city_code;
         $hlog->save();
         return $uid;
    }

    public static function hotel_log($field, $data, $logid=null){
      
      if(!empty($logid)){
        $uid = $logid;
      }else{
        $uid = Session::get('uid');
      }
      $ho = HotelLog::find($uid);
      if($field == 'request_for' && !empty($ho->request_for) ) {
        $new[] = json_decode($ho->request_for, true);
        $new[] = json_decode($data, true);
        $data = json_encode($new);
      } 
      $ho->{$field} = $data;
      $ho->save();

    }

    public static function cancel_booking_log($bref, $detail){


      HotelLog::where('booking_reference', $bref)->update(['cancellation_detail'=>$detail]);
    }


public static function money_convert($amount)
{
//$amount = '100000';
setlocale(LC_MONETARY, 'en_IN');
// $amount = number_format('%!i', $amount);
return $amount;
}


}


?>