<?php

namespace Tests\Feature;

use App\Card;
use App\Deck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudyTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    function empty_deck_not_have_study_mode()
    {

        $deck = factory(Deck::class)->create();

        $this->get($deck->path('study'))
            ->assertRedirect($deck->path());

    }

    /** @test */
    function get_card_of_today_before()
    {

        $deck = factory(Deck::class)->create();


        $card = factory(Card::class, 10)->create([
            'deck_id' => $deck->id,
            'check_date' => now()->addDays(rand(-2, 5))
        ])->first();

        $this->get($deck->path('study'))->assertOk();

        $this->assertLessThanOrEqual(now()->toDateTimeString(), $card->check_date);

    }


    /** @test */
    function get_card_by_state_order()
    {

        $deck = factory(Deck::class)->create();

        $cards = factory(Card::class, 10)->create([
            'deck_id' => $deck->id,
            'state' => rand(0, 5)
        ])->sortBy('state')->first();


        $this->get($deck->path('study'))
            ->assertSee($cards->first()->front);

    }
}
