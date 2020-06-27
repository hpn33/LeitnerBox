<?php

namespace App\Http\Controllers;

use App\Card;
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

                $card->update(['state' => 0]);

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


    function result(Card $card)
    {


        $data = request()->all();


        $days = 0;
        switch ($card->state) {

            case 0:
                $days = 1;
                break;

            case 1:
                $days = 3;
                break;

            case 2:
                $days = 7;
                break;

            case 3:
                $days = 16;
                break;

            case 4:
                $days = 31;
                break;

            case 5:
                $days = 90;
                break;

            default:
                $days = 200;

        }

        $data['check_date'] = now()->addDays($days);

        $card->update($data);

//        return $data;
        return $card->toArray();

    }


    function save(Card $card) {

        $card->update(\request()->all());
        return $card->toArray();


    }

}
