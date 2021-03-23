<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Model\SearchData;
use App\Model\HotelInfo as hi;
use DB;



class HotelDataController extends Controller
{

	public function city_list(){

//$path = public_path('hotel.csv');
//$path=__DIR__.'/hotel.csv';

//need $query = "LOAD DATA  INFILE 'hotel.csv' INTO TABLE hotel_info FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'  IGNORE 1 LINES SET id=null";
// $query = "LOAD DATA LOCAL INFILE $path INTO TABLE hotel_master FIELDS TERMINATED BY ; ENCLOSED BY "" LINES TERMINATED BY '\\n' IGNORE 1 ROWS ;"; 
//$pdo = DB::connection()->getPdo();
// $recordsCount = $pdo->exec($query);


			// $data = SearchData::where('id','<',20)->pluck('name','code');
            $data = SearchData::where('code','C!000302')->pluck('name','code');
			
			return view('city_list', ['data'=>$data]);

	}

	public function get_hotel($city_code){

        $city = SearchData::where('code' , $city_code)->first();
        $city_id = $city->id;
		$client = new Client();

		 $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/hotels?city='.$city_code,[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        $hotel_data = $res->getBody()->getContents();
        $hotels = json_decode($hotel_data,true);


         // dd($hotels);

        foreach($hotels['hotels']  as $h_key => $h_val){
            if(hi::where('code', $h_val['code'])->exists()){
             }else{

            $hotel = new hi();
             $hotel->fill($h_val);

              $hotel->description = null;
              $hotel->address = null;

             $hotel->city_id = $city_id;
             $hotel->save();    
            dump($h_val);
        }}
	 }
    
}
