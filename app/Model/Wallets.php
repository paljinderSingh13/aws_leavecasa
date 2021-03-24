<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $table ="wallet";
    protected $fillable = [ 'customer_id', 'booking_id', 'credited', 'debited', 'date_of_transaction', 'type', 'available_balance' ];
}
