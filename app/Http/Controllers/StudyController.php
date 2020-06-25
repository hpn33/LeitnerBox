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

        // new card for new study day
        if ($deck->last_study < today() || $deck->last_study == null) {
            // update last study date to today
            $deck->update(['last_study' => today()]);

            # ready three card for new study round
            $cards = $deck->cards()
                ->where('state', '-1')
                ->inRandomOrder()
                ->limit(3)
                ->get();

            # update state to ready
            foreach ($cards as $card) {

                $card->state = 0;
                $card->save();

            }

        }

        // get study cards
        $cards = $deck->cards()
            ->where('state', '>=', 0)
            ->whereDate('check_date', '<=', now())
            ->get();


        if (request()->wantsJson()) {
            return ['cards' => $cards];
        }

        return $cards;

    }


}
