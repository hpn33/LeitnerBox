<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    //
    protected $fillable = ['name', 'description'];

    /**
     * @return string
     */
    function path($extention = ''): string
    {
        $path = "/decks/{$this->id}";

        if ($extention != '') {

            $path .= "/{$extention}";

        }

        return $path;

    }

    function cards()
    {

        return $this->hasMany('cards');

    }
}
