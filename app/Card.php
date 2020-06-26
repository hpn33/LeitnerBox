<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //

    protected $fillable = ['deck_id', 'front', 'back', 'state', 'check_date', 'again'];


    function path($extension = '')
    {

        $path = "/cards/{$this->id}";

        if ($extension != '')
        {

            $path .= "/{$extension}";

        }

        return $path;

    }

    function deck()
    {

        return $this->belongsTo('App\Deck');

    }

}
