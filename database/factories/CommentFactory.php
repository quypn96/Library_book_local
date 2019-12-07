<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->name,
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'book_id' => $faker->numberBetween($min = 0, $max = 20),
        'parent_id' => $faker->numberBetween($min = 0, $max = 10),
        'status' => $faker->numberBetween($min = 0, $max = 1),
    ];
});
