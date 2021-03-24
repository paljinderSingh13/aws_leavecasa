<?php

namespace App\Helpers;
use App\Model\Administrator\Accounts\Permission;
use Auth;
class Permissions{

    public static function havePermission($action){
        $permission = Permission::where(['role_id'=>Auth::user()->role_id,'route_action'=>$action,'permission'=>1])->first();
        if($permission != null){
            return true;
        }else{
            return false;
        }
    }
}