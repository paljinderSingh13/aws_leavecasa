<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use App\Model\FlightLogs;
use Session;
use Auth;
// use App\Model\CustomerBookingHistory;

/**
 * 
 */
class FlightLog
{

	public static function mobile_track_route($req, $track_id, $token){


			$new = new FlightLogs();
			$new->token = $token;
			$new->track_id =$track_id;
			$new->route = $req;
			$new->req_by = "mobile";
			$new->save();
			return $new->id;
	}

	public static  function token_track(){

		$route = json_encode( Session::get('request_search'));
			$new = new FlightLogs();
			$new->token = Session::get('flight_token');
			$new->track_id = Session::get('trace_id');
			$new->route = $route;
			$new->save();
	}

	public static function mobile_booking($log_id , $booking_detail, $customer_id ){

 		$flog = FlightLogs::find($log_id);
		$flog->update(['customer_id'=>$customer_id, 'booking_detail'=>json_encode($booking_detail)] );
		return $flog->first()->id;


	}





	public static function booking($booking_id , $booking_detail){

		// foreach ($data as $key => $sucResp)
		// {
		// 	if((!empty($sucResp['Response']['Error']['ErrorMessage']))||(!empty(@$sucResp['Response']['Response']['Message']))){
		// 		$b_id='error';
		// 	}
		// 	else{	
		// 		$b_id=$sucResp['Response']['Response']['BookingId'];
		// 	}
		// }
		if(!empty($booking_id[1])){
			$booking_id = json_encode($booking_id);
		}else{
			$booking_id = $booking_id[0];
		}
		// $result = json_encode( Session::get('flight_success_data'));
		$customer_id = Auth::guard('customer')->id();
		$flog = FlightLogs::where(['token'=>Session::get('flight_token'),'track_id'=>Session::get('trace_id')]);
		$flog->update(['customer_id'=>$customer_id, 'booking_id'=> $booking_id, 'booking_detail'=>json_encode($booking_detail)] );
		$log_id = $flog->first()->id;
		// $history = new CustomerBookingHistory();
		// $history->customer_id = $customer_id;
		// $history->log_id = $log_id;
		// $history->type = "air";
		// $history->booking_id = "air";
	}

	public static  function error_log($error){

		$flog = FlightLogs::where(['token'=>Session::get('flight_token'),'track_id'=>Session::get('trace_id')]);
		$flog->update(['error'=> $error] );

		

	}
}