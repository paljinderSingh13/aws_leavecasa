<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = ['customer_id','total_amount','from_destination','to_destination','request_data','response_data','booked_by','payment_from'];
}
