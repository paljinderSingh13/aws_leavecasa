<?php

namespace App\Http\Controllers\Administrator\BookingStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FlightApi;
use App\DataTables\Administrator\BookingStatus\FlightBookingDatatable;
use Session;
class BookingStatusController extends Controller
{
    public function bookedFlights(FlightBookingDatatable $dataTable){
        return $dataTable->render('administrator.booking_status.index');
    }

    public function cancelFlight($booking_id,$source){
        $result = FlightApi::cancelFlight($booking_id, $source);
        if($result['Response']['Error']['ErrorMessage'] == ''){
            Session::flash('error','Error From API|'.$result['Response']['Error']['ErrorMessage']);
            return back();
        }else{
            Session::flash('success','Successfully Canceled|Flight Canceled Successfully!');
            return back();
        }
    }
}
