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

        return view('deck.study', [
            'deck_id' => $deck->id
        ]);

    }

    function result()
    {

        $state = request('state');

    }

    function getCard(Deck $deck)
    {

        if (request()->wantsJson()) {
            return ['card' => $deck->study_card];
        }

    }


}
