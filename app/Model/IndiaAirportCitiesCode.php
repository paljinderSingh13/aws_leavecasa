<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IndiaAirportCitiesCode extends Model
{
    protected $fillable = ['city_name','city_code'];

    public static function city_codes(){
        $modelData = self::orderBy('id','asc')->get();
        $citiesArray = [];
        foreach($modelData as $key => $data){
            $citiesArray[$data->city_code] = $data->city_name.' ('.$data->city_code.')';
        }
        return $citiesArray;
    }

    public static function city_codes_in_json(){
        $modelData = self::orderBy('id','asc')->get();
      //  $dataArray = [];
        foreach($modelData as $key => $value){
        //    $tempArray = [];

            $tempArray['id'] = $value->city_code;
            $tempArray['name'] = $value->city_name.'-'.$value->city_code;
            $dataArray[] = $tempArray;
        }
        return json_encode($dataArray);
    }
}
