<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 400),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'avatar' => 'default-avatar.jpg',
    ];
});
