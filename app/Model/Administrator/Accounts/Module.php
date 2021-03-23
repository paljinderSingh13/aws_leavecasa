<?php

namespace App\Model\Administrator\Accounts;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['module_name','module_slug'];

    public static function moduleList(){
        return self::orderBy('id','asc')->pluck('module_name','module_slug');
    }


    public static function module_slug_to_id($module_slug){
        return self::where('module_slug',$module_slug)->first()->id;
    }

    public static function module_id_to_module_name($module_id){
        return self::find($module_id)->module_name;
    }
}
