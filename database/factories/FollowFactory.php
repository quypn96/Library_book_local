<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Follow;
use Faker\Generator as Faker;

$factory->define(Follow::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'object_id' => $faker->numberBetween($min = 0, $max = 20),
        'type' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
