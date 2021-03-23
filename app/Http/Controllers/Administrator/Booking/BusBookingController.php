<?php

namespace App\Http\Controllers\Administrator\Booking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BusBookingSource;
use Carbon\Carbon;
use App\Helpers\BusApi;
class BusBookingController extends Controller
{
    public function index(Request $request){
        $searchResults = [];
        if($request->isMethod('post')){
            $request->to = Carbon::parse($request->journey_date)->format('Y-m-d');
            $request->source = $request->from;
            $busApi = BusApi::searchBus($request);
            $searchResults = $busApi;
        }
        $busSources = BusBookingSource::pluck('city_name','city_id');
        return view('administrator.booking.bus-booking.index',['sources'=>$busSources,'searchResults'=>$searchResults]);
    }

    public function getSeatDetails(Request $request, $bus_id){
        $seatDetails = BusApi::getSeats($bus_id);
        $maxSeats = $seatDetails['maxSeatsPerTicket'];
        $seatDetails = collect($seatDetails['seats']);
        //zIndex = 1 for upper and 0 for lower
        $seatData = $seatDetails->groupBy('zIndex')->map(function($records){
            return $records->groupBy('row');
        });
        return view('administrator.booking.bus-booking.seats',['seatData'=>$seatData,'request'=>$request->all(),'maxSeats'=>$maxSeats,'bus_id'=>$bus_id,'from'=>'admin'])->render();
    }

    public function pasengerDetails(Request $request){
        return view('administrator.booking.bus-booking.details',['request'=>$request]);
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
}