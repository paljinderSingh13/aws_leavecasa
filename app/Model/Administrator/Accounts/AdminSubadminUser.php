<?php

namespace App\Model\Administrator\Accounts;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminSubadminUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_whitelist','contact_no','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Model\Administrator\Accounts\AdminUserRole','role_id','id');
    }
}
