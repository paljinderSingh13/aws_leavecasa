<?php

namespace App\Model\Administrator\Accounts;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['permission_for','module_id','role_id','route_action','permission'];
}
