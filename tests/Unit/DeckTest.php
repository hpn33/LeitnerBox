<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeckTest extends TestCase
{


    use RefreshDatabase;

    /** @test */
    public function can_make_own_path()
    {

        $deck = factory('App\Deck')->create();

        $this->assertequals("/decks/{$deck->id}", $deck->path());

    }

}
