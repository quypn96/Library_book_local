<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 400),
    ];
});
