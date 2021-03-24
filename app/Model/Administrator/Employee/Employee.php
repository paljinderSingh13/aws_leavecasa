<?php

namespace App\Model\Administrator\Employee;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['employee_id','name','designation','bio','email','password'];

    public static function designations(){
        return [
            '0' => 'Junior',
            '1' => 'Senior'
        ];
    }
}
