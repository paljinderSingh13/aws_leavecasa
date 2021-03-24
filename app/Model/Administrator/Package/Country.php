<?php

namespace App\Model\Administrator\Package;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "pck_countries"; 
    public $timestamps = true; 
    public $fillable = ['name', 'iso', 'status'];


    // public function states(){
    // 	return $this->hasMany('App\Model\Admin\States','country_id');
    // }
}



