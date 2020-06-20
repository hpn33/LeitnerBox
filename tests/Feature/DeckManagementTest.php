<?php

namespace Tests\Feature;

use App\Deck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeckManagementTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_show_deck_detail_on_a_page()
    {

        $deck = factory('App\Deck')->create();

        $this->get($deck->path())
            ->assertSee($deck->name);

    }

    /** @test */
    function create_a_deck()
    {

        $attribute = [
            'name' => 'good name',
            'description' => 'good description'
        ];

        $this->post('/decks/', $attribute);

        $this->assertDatabaseHas('decks', $attribute);

    }

    /** @test */
    function can_delete_a_deck()
    {

        $deck = factory('App\Deck')->create();

        $this->delete($deck->path())
            ->assertRedirect('/decks/');

        $this->assertDatabaseMissing('decks', $deck->toArray());

    }

    /** @test */
    function can_update_a_deck()
    {

        $deck = factory('App\Deck')->create();

        $attribute = [
            'name' => 'new Name',
            'description' => 'new Description'
        ];

        $this->patch($deck->path(), $attribute);

        $deck->refresh();

        $this->assertEquals($attribute['name'], $deck->name);

    }

    /** @test */
    function exam_of_card()
    {

        $deck = factory(Deck::class)->create();

        $this->get($deck->path('exam'))->assertOk();

    }
}
