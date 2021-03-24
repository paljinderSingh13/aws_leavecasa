<?php

namespace App\Model\Administrator\Package;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "pck_cities"; 
    public $timestamps = true; 
    protected $fillable =['country_id', 'name', 'iso', 'status'];

    public function country(){
    	 return $this->belongsTo('App\Model\Administrator\Package\Country','country_id');
    }
}
