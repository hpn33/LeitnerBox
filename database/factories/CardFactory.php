<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'deck_id' => factory('App\Deck'),
        'front' => $faker->sentence,
        'back' => $faker->sentence,
        'check_date' => now(),
        'state' => -1
    ];
});
