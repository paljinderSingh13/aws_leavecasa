<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerWallet extends Model
{
    protected $fillable = ['user_id','amount'];
}
