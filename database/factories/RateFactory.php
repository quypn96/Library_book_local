<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rate;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'book_id' => $faker->numberBetween($min = 0, $max = 20),
        'rate' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
