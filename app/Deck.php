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
    function path(): string
    {

        return "/decks/{$this->id}/";

    }

    function cards()
    {

        return $this->hasMany('cards');

    }
}
