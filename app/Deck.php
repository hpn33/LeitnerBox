<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    //
    protected $fillable = ['name', 'description', 'last_study'];

    /**
     * @param string $extension
     * @return string
     */
    function path($extension = ''): string
    {
        $path = "/decks/{$this->id}";

        if ($extension != '') {

            $path .= "/{$extension}";

        }

        return $path;

    }

    function cards()
    {

        return $this->hasMany('App\Card');

    }

    function getStudyCardAttribute()
    {

        return $this->cards()
            ->whereDate('check_date', '<=', now())
            ->orderBy('state')
            ->orderBy('id')
            ->first();

    }

}
