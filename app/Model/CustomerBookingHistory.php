<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerBookingHistory extends Model
{
    protected $fillable = [`booking_id`, `log_id`, `customer_id`, `type`];

    // protected $timestamps = false;
}
