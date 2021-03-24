<?php

namespace App\Http\Controllers\Administrator\Booking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FlightApi;
use App\Helpers\PaymentProcess;
use Session;
use App\Model\Customer;
use Carbon\Carbon;
use App\Model\FlightBooking;
use Route;
class FlightBookingController extends Controller
{
    public function index(){
        return view('administrator.booking.flight-booking.index');
    }

    public function searchForBooking(Request $request){
        $json = [
            'AdultCount' => $request->adult_count,
            'ChildCount' => $request->child_count,
            'InfantCount' => $request->infant,
            'DirectFlight' => ($request->direct_flight == 'true')?true:false,
            // 'OneStopFlight' => true,
            'JourneyType' => $request->journey_type,
            'PreferredAirlines' => '',
            'Segments' => [[
                'Origin' => $request->from,
                'Destination' => $request->to,
                'FlightCabinClass' => $request->cabin_class,
                'PreferredDepartureTime' => $request->departure_date.'T00:00:00',
                'PreferredArrivalTime' => $request->arrival_date.'T00:00:00'
            ]]
        ];
        if($request->journey_type == 2){
            $firstSegment = $json['Segments'][0];
            $destination = $firstSegment['Destination'];
            $firstSegment['Destination'] = $firstSegment['Origin'];
            $firstSegment['Origin'] = $destination;
            $firstSegment['PreferredDepartureTime'] = $request->return_date.'T00:00:00';
            $firstSegment['PreferredArrivalTime'] = $request->return_date.'T00:00:00';
            $json['Segments'][] = $firstSegment;
        }
        $results = FlightApi::search($json);
        if($results['Response']['Error']['ErrorMessage'] != ''){
            return response()->json(['status'=>false,'message'=>$results['Response']['Error']['ErrorMessage']], 500);
        }
       // dump($results['Response']['Results'][0][0]);
        return view('administrator.booking.flight-booking.result',['results'=>$results,'markup_include'=>$request->markup_included,'journey_type'=>$request->journey_type,'request'=>$request])->render();
    }

    public function bookingFlight(Request $request){
        return view('administrator.booking.flight-booking.booking',['request'=>$request]);
    }

    public function customerModal(Request $request){
        return view('administrator.booking.flight-booking.customer_modal')->render();
    }

    public function insertToCustomersList(Request $request){
        $customersList = Session::get('customers_list');
        if($customersList != null){
            $customersList[] = $request->data;
        }else{
            $customersList = [];
            $customersList[] = $request->data;
        }
        Session::put('customers_list',$customersList);
        return response()->json(['pass_list'=>$customersList]);
    }

    public function getCustomersList(){
        $customersList = Session::get('customers_list');
        return response()->json(['pass_list'=>$customersList]);
    }

    public function deleteCustomer($index){
        $customersList = Session::get('customers_list');
        unset($customersList[$index]);
        $customersList = array_values($customersList);
        Session::put('customers_list',$customersList);
        return response()->json(['pass_list'=>$customersList]); 
    }

    public function bookFlight(Request $request){
        if($request->isMethod('post')){
            $customersList = Session::get('customers_list');
            $flightData = $request->all();
            Session::put('flight_data',$flightData);
        }
        return view('administrator.booking.user-register.user-register');
    }

    public function bookingConfirmation(){
        
        $customersList = Session::get('customers_list');
        $flightData = Session::get('flight_data');
        return view('administrator.booking.flight-booking.confirmation',['customers'=>$customersList,'flight_details'=>$flightData]);
    }

    public function processPayment(Request $request){
        $customersList = Session::get('customers_list');
        $flightData = Session::get('flight_data');
        $client_id = Session::get('client_id');
        $client_details = Customer::find($client_id);
        Session::put('request',json_encode($request->all()));
        $totalPayableAmount = $flightData['single_amount'];
        $paymentOptions = [];
        $paymentOptions['amount'] = $totalPayableAmount;
        $paymentOptions['return_to'] = route('admin.payment.response',['next_route'=>'book-flight-api']);
        $paymentOptions['client_code'] = Session::get('client_id');
        $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
        $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
        $paymentOptions['customer_details']['customer_name'] = $client_details->name;
        $paymentOptions['customer_details']['customer_email'] = $client_details->email;
        $paymentOptions['customer_details']['customer_mobile'] = $client_details->mobile;
        $paymentOptions['customer_details']['billing_address'] = str_replace(["\n","\r"],"",$client_details->address);
        $paymentOptions['customer_details']['customer_account_id'] = $client_id;
        $url = PaymentProcess::process($paymentOptions);
        return redirect()->to($url);
    }

    public function bookFlightNow(){
        $result = FlightApi::bookFlight('admin');
        if(isset($result['status']) && $result['status'] == false){
            Session::flash('error','Error From API|'.$result['result']['Response']['Error']['ErrorMessage']);
            return redirect()->route('book.flight');
        }elseif(@$result['Result']['Response']['Error']['ErrorMessage'] != ''){
            Session::flash('error','Error From API|'.$result['Response']['Error']['ErrorMessage']);
            return redirect()->route('book.flight');
        }else{
            return redirect()->route('flight.booking.done',$result['model']->id);
        }
    }

    public function bookingDone($booking_id){
        $model = FlightBooking::find($booking_id);
        return view('administrator.booking.flight-booking.done_booking',['model'=>$model]);
    }

}
