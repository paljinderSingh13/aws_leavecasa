<?php

namespace App\Model\Administrator\Package;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $table = "pck_package_durations"; 
    public $timestamps = true; 
    public $fillable =[ 'name', 'day', 'night', 'status'];
}
