<?php

namespace Tests\Feature;

use App\Deck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function empty_deck_not_have_review_mode()
    {

        $deck = factory(Deck::class)->create();

        $this->get($deck->path('review'))
            ->assertRedirect($deck->path());

    }

    /** @test */
    public function review_cards_of_deck()
    {

        $this->withoutExceptionHandling();
        $deck = factory('App\Deck')->create();

        $cards = factory('App\Card', 10)->create([ 'deck_id' => $deck->id ]);

        $this->get($deck->path('review'))
            ->assertOk()
            ->assertSee($cards->first()->front)
            ->assertSee($cards->first()->back);

    }
}
