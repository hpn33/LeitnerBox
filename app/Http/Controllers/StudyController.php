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

//    function result()
//    {
//
//        $state = request('state');
//
//    }

    function getCard(Deck $deck)
    {

        if ($deck->last_study < today()) {
            $deck->update(['last_study' => today()]);

            # ready three card for new study round
            $cards = $deck->cards()->where('state', '==', -1)->inRandomOrder()->limit(3);

            foreach ($cards as $card) {
                $card->update(['state' => 0]);
            }

        }

        if (request()->wantsJson()) {
            return ['card' => $deck->study_card];
        }

        return $deck;

    }


}
