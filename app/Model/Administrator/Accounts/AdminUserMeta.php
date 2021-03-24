<?php

namespace App\Model\Administrator\Accounts;

use Illuminate\Database\Eloquent\Model;

class AdminUserMeta extends Model
{
    protected $fillable = ['user_id','column_name','column_value'];
}
