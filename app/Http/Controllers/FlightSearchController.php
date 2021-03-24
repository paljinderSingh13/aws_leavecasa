<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;
use Session;
class FlightSearchController extends Controller
{
    public function index(Request $request){
        $results = [];
        if($request->isMethod('post')){
            $client = new Client();
            $res = $client->request('POST','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search',[
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'EndUserIp' => '103.232.151.175',
                    'TokenId' => 'eef9e753-47cf-45fa-bbba-958ee5a3a1dd',
                    'AdultCount' => $request->adult_count,
                    'ChildCount' => $request->childs_count,
                    'InfantCount' => 0,
                    'DirectFlight' => true,
                    'OneStopFlight' => true,
                    'JourneyType' => 1,
                    'PreferredAirlines' => '',
                    'Segments' => [[
                        'Origin' => $request->from,
                        'Destination' => $request->to,
                        'FlightCabinClass' => 1,
                        'PreferredDepartureTime' => $request->departure.'T00:00:00',
                        'PreferredArrivalTime' => $request->arrival.'T00:00:00'
                    ]]
                ]
            ]);
            $results = json_decode($res->getBody()->getContents(),true);
            return view('administrator.api_settings.flight-search',['results'=>$results]);
        }
        return view('administrator.api_settings.flight-search',['results'=>$results]);
    }
    

    public function searchForBusses(Request $request){
        $result = [];
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key'    => 'nfIhtSBzbhbYDCyJyfW1JnfCPNf9iX',
            'consumer_secret' => 'zKEYjXydHeKKMMzaxs5mDdgS2VqdhT',
            'token'           => '',
            'token_secret'    => ''
        ]);
        $stack->push($middleware);

        $client = new Client([
            'base_uri' => 'http://api.seatseller.travel',
            'handler' => $stack,
            'auth' => 'oauth'
        ]);
        if($request->isMethod('post')){
            $res = $client->get('availabletrips?source='.$request->source.'&destination='.$request->destination.'&doj='.$request->to);
            $result = json_decode($res->getBody()->getContents(),true);
        }
        $sources = [];
        $sources = $client->get('sources');
        $sources = json_decode($sources->getBody()->getContents(),true);
            
        
        // dd(json_decode($res->getBody()->getContents(),true));

        return view('administrator.api_settings.bus-search',['sources'=>$sources,'result'=>$result]);
    }


    public function searchForHotel(Request $request){
        $results = [];
        if($request->isMethod('post')){
            $client = new Client();
            $res = $client->request('POST','http://api-sandbox.grnconnect.com/api/v3/hotels/availability',[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'application/json'
                ],
                'json' => [
                    'destination_code' => 'C!000555',
                    'checkin' => '2018-03-30',
                    'checkout' => '2018-04-05',
                    'client_nationality' => 'IN',
                    'cutoff_time' => '5000',
                    'currency' => 'INR',
                    'more_result' => true,
                    'hotel_info' => true,
                    'rates' => 'comprehensive',
                    'hotel_category' => [2,6],
                    'rooms' => [
                        [
                            'adults' => '1'
                        ],
                        [
                            'adults' => '2',
                            'children_ages' => ['3']
                        ]
                    ]
                ]
            ]);
            $results = json_decode($res->getBody()->getContents(),true);
            return view('administrator.api_settings.hotel-search',['results'=>$results]);
        }
        return view('administrator.api_settings.hotel-search',['results'=>$results]);
    }
}
