<?php


use Tests\TestCase;

class DeckTest extends TestCase
{



    /** @test */
    public function can_make_own_path()
    {
        $deck = factory('App\Deck')->make();

        $this->assertequals("/decks/{$deck->id}/", $deck->path());
    }

}
