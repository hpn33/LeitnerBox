<?php

namespace Tests\Feature;

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
}
