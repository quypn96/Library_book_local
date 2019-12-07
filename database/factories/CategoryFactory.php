<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween($min = 1, $max = 20),
        'status' => $faker->numberBetween($min = 0, $max = 1),
    ];
});
