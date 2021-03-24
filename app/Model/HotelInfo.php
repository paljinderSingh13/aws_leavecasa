<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelInfo extends Model
{
    public $table = "hotel_info";
    protected $fillable=["city_id", "city_code", "name", "longitude", "latitude", "facilities", "dest_code", "description", "country", "code", "postal_code", "category", "address"];
} 