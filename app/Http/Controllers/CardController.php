<?php

namespace App\Http\Controllers;

use App\Card;
use App\Deck;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Deck $deck)
    {

        return view('card.create', compact('deck'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Deck $deck
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request ,Deck $deck)
    {

        $deck->cards()->create([
            'front' => request('front'),
            'back' => request('back')
        ]);

        return redirect($deck->path());

    }

    /**
     * Display the specified resource.
     *
     * @param Card $card
     * @return Application|Factory|View
     */
    public function show(Card $card)
    {

        return view('card.show', compact('card'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Card $card
     * @return Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Card $card
     * @return Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Card $card
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Card $card)
    {

        $card->delete();

        return redirect($card->deck->path());

    }
}
