<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deck;
use Faker\Generator as Faker;

$factory->define(Deck::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});
