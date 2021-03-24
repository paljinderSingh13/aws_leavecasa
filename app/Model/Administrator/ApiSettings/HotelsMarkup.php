<?php

namespace App\Model\Administrator\ApiSettings;

use Illuminate\Database\Eloquent\Model;

class HotelsMarkup extends Model
{
    protected $fillable = ['country','city','destination','amount_by','amount','visibility','star_ratting'];

    public static function starRating(){
        $ratingArray = [];
        for($i = 1; $i <= 5; $i++){
            $ratingArray[$i] = $i;
        }
        return $ratingArray;
    }
}
