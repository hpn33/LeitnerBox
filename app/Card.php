<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //



    function deck()
    {

        return $this->belongsTo('Deck');

    }
}
