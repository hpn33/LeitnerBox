<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{

    use RefreshDatabase;


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
