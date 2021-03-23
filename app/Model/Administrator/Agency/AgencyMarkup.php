<?php

namespace App\Model\Administrator\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyMarkup extends Model
{
   protected  $fillable = ['markup_hotel', 'markup_flight', 'markup_bus'];
}
