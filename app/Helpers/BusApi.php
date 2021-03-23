<?php

/**

 * Created by PhpStorm.

 * User: rahul

 * Date: 26-05-2018

 * Time: 22:56

 */
namespace App\Helpers;

use GuzzleHttp\Client;

use GuzzleHttp\RequestOptions;

use GuzzleHttp\HandlerStack;

use GuzzleHttp\Subscriber\Oauth\Oauth1;

use App\Model\BusLog;

use App\Model\Administrator\ApiSettings\BussesMarkup;

use Session;


class BusApi{

    protected $apiRequest;


    public function __construct(){

        $stack = HandlerStack::create();

        // Test Credentials: 

// Consumer Key: MCycaVxF6XVV0ImKgqFPBAncx0prPp 
// Consumer Secret: 5f0lpy9heMvXNQ069lQPNMomysX6rt 

        // $middleware = new Oauth1([

        //     'consumer_key'    => 'MCycaVxF6XVV0ImKgqFPBAncx0prPp',

        //     'consumer_secret' => '5f0lpy9heMvXNQ069lQPNMomysX6rt',

        //     'token'           => '',

        //     'token_secret'    => ''

        // ]);

//live
        $middleware = new Oauth1([

            'consumer_key'    => 'nfIhtSBzbhbYDCyJyfW1JnfCPNf9iX',

            'consumer_secret' => 'zKEYjXydHeKKMMzaxs5mDdgS2VqdhT',

            'token'           => '',

            'token_secret'    => ''

        ]);

// $middleware = new Oauth1([

//             'consumer_key'    => 'nfIhtSBzbhbYDCyJyfW1JnfCPNf9iX',

//             'consumer_secret' => 'zKEYjXydHeKKMMzaxs5mDdgS2VqdhT',

//             'token'           => '',

//             'token_secret'    => ''

//         ]);



        $stack->push($middleware);

        $client = new Client([

            'base_uri' => 'http://api.seatseller.travel',

            'handler' => $stack,

            'auth' => 'oauth'

        ]);

        $this->apiRequest = $client;
    }

    public static function get_destination($s_id){

         $object = new self;

         //http://api.seatseller.travel/destinations?source=3

        $res = $object->apiRequest->get('destinations?source='.$s_id);

        $result = json_decode($res->getBody()->getContents(),true);

        return $result;

    }



    public static function searchBus($request){

        $object = new self;

        $res = $object->apiRequest->get('availabletrips?source='.$request->source.'&destination='.$request->destination.'&doj='.$request->to);
        
        //$marup = $this->markup($request->source, $request->destination);
        $result = json_decode($res->getBody()->getContents(),true);


        //$markUp = BussesMarkup::where(['source'=>$request->source , 'destination'=> $request->destination ,'status'=>1]);


        // $data = "";
        // if($markUp->exists()){
            
        //     $data = $markUp->first();
        // }

        $mark = self::markup($request->source, $request->destination );
        $result['markup'] = $mark;
        return $result;
    }




    public  static function percentage_markup($percent, $fare){

        return (int)$fare / 100 * (int)$percent;


    }

 public  static function cal_time($time){
    $departureTime = $time;
    $hours = floor($departureTime/60)%24;
    $minutes = $departureTime%60;
    $dtime =  \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
    return $dtime;
            
   }  
    public static function markup($source, $destination){

        $markUp = BussesMarkup::where(['source'=>$source , 'destination'=> $destination ,'status'=>1]);


        $data = "";
        if($markUp->exists()){
            
            $data = $markUp->first();
           // $data = $data->all();
        }


        // if(empty($markUp)){

        //     return null;
        // }

        return $data;


    }

    public static function sourcesList(){

        $object = new self;

        $apiResponse = $object->apiRequest->get('sources');

        return json_decode($apiResponse->getBody()->getContents(),true);

    }



    public static function getSeats($id){

        $object = new self;

        $apiResponse = $object->apiRequest->get('tripdetails?id='.$id);

        return json_decode($apiResponse->getBody()->getContents(),true);

    }



    public static function bookBus(Array $array){

        $object = new self;

        try{

            $apiResponse = $object->apiRequest->post('blockTicket',

                ['json' => $array]

            );

        }catch(\Exception $e){

           // dump('error ',$e->getMessage());

           $response = $e->getResponse();
            $jsonBody = (string) $response->getBody();

            return ['status'=>'error', 'message'=> $jsonBody];

            //dd($response, $jsonBody);



        }

        return ['status'=>'success','BlockKey'=>(string) $apiResponse->getBody()];

        // dump($apiResponse, (string) $apiResponse->getBody());
                // json_decode($res->getBody()->getContents(),true);
       // dd('erooor 2',$apiResponse);

    }


   public static  function conirmTicket($block){
  //  dd($blockKey);
        $object = new self;
         try{
                $apiResponse = $object->apiRequest->post('bookticket?blockKey='.$block);
            }catch(\Exception $e){
                $response = $e->getMessage();//->getBody()->getContents();
                dump($response);
                $response = $e->getResponse();
                $jsonBody = (string) $response->getBody();
                return ['status'=>'error', 'message'=> $jsonBody];
            }
    // dump(json_decode($apiResponse->getBody()->getContents(),true) );

        return ['status'=>'success','tin'=>(string) $apiResponse->getBody()];
    }

    public static function tiket_detail($tin){

        $object = new self;
         try{
                $apiResponse = $object->apiRequest->get('ticket?tin='.$tin);
            }catch(\Exception $e){
                $response = $e->getMessage();//->getBody()->getContents();
                dump($response);
                $response = $e->getResponse();
                $jsonBody = (string) $response->getBody();
                return ['status'=>'error', 'message'=> $jsonBody];
            }
            $detail = json_decode($apiResponse->getBody()->getContents(),true);
        return ['status'=>'success','detail'=>$detail];
    }


    public static function bus_log($customer_id, $tin, $detail, $req_by ){


        $busLog = new BusLog();
        $busLog->customer_id= $customer_id;
        $busLog->booking_id= $tin;
        if(Session::has('searchBus')){
            $busLog->route = json_encode( Session::get('searchBus'));
        }
        $busLog->booking_detail =  $detail;
        $busLog->req_by = $req_by;
        $busLog->save();
    }

}


