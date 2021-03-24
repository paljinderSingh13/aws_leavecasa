<?php

namespace App\Model\Administrator\Accounts;

use Illuminate\Database\Eloquent\Model;

class AdminUserRole extends Model
{
    protected $fillable = ['role_name','description'];

    public static function roles($except = null){
        if($except == null){
            return self::orderBy('id','asc')->pluck('role_name','id');
        }else{
            return self::whereNotIn('id',$except)->orderBy('id','asc')->pluck('role_name','id');
        }
    }
}
