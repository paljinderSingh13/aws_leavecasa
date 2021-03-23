<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlightLogs extends Model
{
    protected $fillable = ['token', 'customer_id', 'track_id', 'route', 'booking_id', 'booking_detail', 'error','req_by'];

    // protected $timestamps = false;
}
