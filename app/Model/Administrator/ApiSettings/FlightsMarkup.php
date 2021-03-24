<?php

namespace App\Model\Administrator\ApiSettings;

use Illuminate\Database\Eloquent\Model;

class FlightsMarkup extends Model
{
    protected $fillable = ['flight_number','airline','location_from','location_to','plus_amount','plus_percent','visibility_status','amount_by'];


    public static function markupAmountAndStatus($airline, $flightNumber, $airlineCode, $from, $to, $callStatus = false){
        $model = self::where(['airline'=>$airline.'-'.$airlineCode,'flight_number'=>$flightNumber,'location_from'=>$from,'location_to'=>$to])->first();
        if($callStatus == false){
            if($model == null){
                return ['amount'=>0,'status'=>'null','percent'=>0,'amount_by'=>'percent'];
            }else{
                return ['amount'=>$model->plus_amount,'status'=>$model->visibility_status,'percent'=>$model->plus_percent,'amount_by'=>$model->amount_by];
            }
        }else{
            return $model;
        }
    }

    public static function getVisibilityStatus(){

    }

}
