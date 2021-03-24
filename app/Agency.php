<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Agency extends Authenticatable
{
	 use Notifiable;
    //

    protected $fillable = ['name', 'image', 'address', 'state', 'city', 'contact_no', 'email', 'gst_no', 'status','sub_domain'];


     protected $hidden = [
        'password', 'remember_token',
    ];

}
