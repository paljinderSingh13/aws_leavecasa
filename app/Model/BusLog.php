<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusLog extends Model
{
    protected $fillable = [ 'customer_id',  'route', 'booking_id', 'booking_detail', 'error', 'req_by'];

    public $table = "bus_log";

    // protected $timestamps = false;
}
