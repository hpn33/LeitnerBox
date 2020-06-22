<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $decks = Deck::all();

        return view('deck.index', compact('decks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        return view('deck.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {

        $deck = Deck::create([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect($deck->path());

    }

    /**
     * Display the specified resource.
     *
     * @param Deck $deck
     * @return Application|Factory|View
     */
    public function show(Deck $deck)
    {

        return view('deck.show', compact('deck'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Deck $deck
     * @return Application|Factory|View
     */
    public function edit(Deck $deck)
    {

        return view('deck.edit', compact('deck'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Deck $deck
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Deck $deck)
    {

        $deck->update([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect($deck->path());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Deck $deck
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Deck $deck)
    {

        $deck->delete();

        return redirect('/decks/');

    }


    function review(Deck $deck)
    {

        $cardsCount = $deck->cards->count();
        if ($cardsCount == 0) {
            return redirect($deck->path());
        }

        $cards = $deck->cards()->simplePaginate(1);

        return view('deck.review', compact('cards', 'cardsCount'));

    }



}
