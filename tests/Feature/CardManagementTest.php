<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardManagementTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function create_card()
    {

        $deck = factory('App\Deck')->create();

        $attribute = [
            'front' => 'front',
            'back' => 'back'
        ];

        $this->post($deck->path('card'), $attribute)
            ->assertRedirect($deck->path());

        $attribute['deck_id'] = $deck->id;

        $this->assertDatabaseHas('cards', $attribute);

    }

    /** @test */
    function delete_card()
    {

        $card = factory('App\Card')->create();

        $this->delete($card->path())
            ->assertRedirect($card->deck->path());

        $this->assertDatabaseMissing('cards', $card->only(['id', 'deck_id']));

    }

    /** @test */
    function show_card_detail()
    {

        $card = factory('App\Card')->create();

        $this->get($card->path())
            ->assertOk()
            ->assertSee($card->front)
            ->assertSee($card->back);

    }
}
