<?php

use App\Card;
use App\Deck;
use Illuminate\Database\Seeder;

class ADeckManyCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $deck = factory(Deck::class)->create();

        factory(Card::class, 30)->create(['deck_id' => $deck->id]);

    }
}
