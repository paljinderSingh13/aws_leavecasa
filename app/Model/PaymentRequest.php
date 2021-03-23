<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $fillable = ['payment_for','transaction_id','customer_id','transaction_date','amount_to_pay','request_send','request_response','payment_status'];
}
