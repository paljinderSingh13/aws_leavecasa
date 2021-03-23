<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelLog extends Model
{

	protected $table = "hotel_log";
	protected $fillable = ['request_for', 'search_id', 'availability_response', 'availability_response_one', 'availability_response_two' ,  'availability_response_three', 'availability_response_four', 'availability_response_five', 'availability_response_six', 'availability_response_seven', 'availability_response_eight', 'availability_response_nine', 'availability_response_ten', 'refetch_result','more_detail_response', 'booking_detail', 'booking_reference', 'booking_id', 'booking_status', 'recheck_request', 'booking_error', 'recheck_response','log_by','cancellation_detail'];

	public $timestamps = false;
    //
}
