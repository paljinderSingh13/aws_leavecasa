<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusBookingSource extends Model
{
    protected $fillable = ['city_id','city_name','state_name','state_id'];

    public static function getCitiesName(){
        $model = self::orderBy('city_name','asc')->pluck('city_id','city_name');
        $dataArray = [];
        foreach($model as $city_name => $city_id){
            $dataArray[] = ['id'=>$city_id,'name'=>$city_name];
        }
        return json_encode($dataArray);
    }

    public static function city_code_to_name($code){
        $model = self::where(['city_id'=>$code])->first();
        return $model->city_name;
    }

    public static function getIdProofs(){
        return [
            'Pan Card' => 'Pan Card',
            'Driving Licence' => 'Driving Licence',
            'Voting Card' => 'Voting Card',
            'Aadhar Card' => 'Aadhar Card'
        ];
    }

    public static function getMrMrs(){
        return [
            'Mr' => 'Mr.',
            'Mrs' => 'Mrs.',
            'Ms' => 'Ms.'
        ];
    }
}
