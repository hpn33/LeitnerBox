<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;

class StudyController extends Controller
{


    function study(Deck $deck)
    {

        if ($deck->cards()->count() == 0) {
            return redirect($deck->path());
        }

        return view('deck.study', compact('deck'));

    }

    function result()
    {

        $state = request('state');

    }

}
