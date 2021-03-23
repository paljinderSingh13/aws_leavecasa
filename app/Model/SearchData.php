<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class SearchData extends Model
{
    
    
    protected $fillable = ['code', 'name','country_code', 'type'];
}
