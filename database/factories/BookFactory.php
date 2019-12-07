<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 20),
        'description' => $faker->text($maxNbChars = 400),
        'content' => $faker->text($maxNbChars = 500),
        'publisher_id' => $faker->numberBetween($min = 1, $max = 10),
        'status' => $faker->numberBetween($min = 0, $max = 1),
        'quantity' => $faker->numberBetween($min = 0, $max = 100),
        'image' => 'book-default.png',
    ];
});
