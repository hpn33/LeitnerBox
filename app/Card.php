<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //

    protected $fillable = ['deck_id', 'front', 'back'];


    function deck()
    {

        return $this->belongsTo('App\Deck');

    }
}
