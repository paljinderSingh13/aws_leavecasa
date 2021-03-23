<?php

namespace App\Model\Administrator\ApiSettings;

use Illuminate\Database\Eloquent\Model;
class BussesMarkup extends Model
{
    protected $fillable = ['source','destination','amount_by','amount_or_percent','status'];


    public function start(){

    	return $this->belongsTo('App\Model\BusBookingSource' , 'source', 'city_id' );
    } 

    public function des(){

    	return $this->belongsTo('App\Model\BusBookingSource' , 'destination', 'city_id' );
    }
}
