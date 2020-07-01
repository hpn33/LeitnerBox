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
//    function get_card_of_today_before()
//    {
//
//        $deck = factory(Deck::class)->create();
//
//
//        $card = factory(Card::class, 10)->create([
//            'deck_id' => $deck->id,
//            'check_date' => now()->addDays(rand(-2, 5))
//        ])->first();
//
//        $this->get($deck->path('study'))->assertOk();
//
//        $this->assertLessThanOrEqual(now()->toDateTimeString(), $card->check_date);
//
//    }


    /** @test */
//    function get_card_by_state_order()
//    {
//
//        $deck = factory(Deck::class)->create();
//
//        $cards = factory(Card::class, 10)->create([
//            'deck_id' => $deck->id,
//            'state' => rand(0, 5)
//        ])->sortBy('state')->first();
//
//        $this->get($deck->path('study'))
//            ->assertSee($cards->first()->front);
//
//    }


    /** @test */
    function set_last_study_date_to_today()
    {

        $deck = factory(Deck::class)->create();

        $this->get('/study/' . $deck->id);

        $this->assertEquals(today(), $deck->fresh()->last_study);

    }


    /** @test */
    function ready_three_card_for_new_study_day()
    {

        $deck = factory(Deck::class)->create();
        $cards = factory(Card::class, 3)->create(['deck_id' => $deck->id]);

        $this->get('/study/' . $deck->id);

        $this->assertEquals(0, $cards->fresh()->first()->state);

    }


    /** @test */
    function add_time_to_card()
    {

        $card = factory(Card::class)->create();
        $current_time = clone $card->check_date;

        $this->post('/study/' . $card->id . '/save', [
            'card' => $card->toArray(),
            'y' => 1,
            'm' => 5,
            'h' => 1,
            'min' => 10,
            's' => 30
        ]);

        $current_time->addyears(1);
        $current_time->addMonths(5);
        $current_time->addHours(1);
        $current_time->addMinutes(10);
        $current_time->addSeconds(30);
        $this->assertEquals($current_time->toDateTimeString(), $card->fresh()->check_date);


    }


}
