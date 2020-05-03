<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;

$factory->define(\App\Fika::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'slug' => $faker->word . '-' . $faker->word,
        'password' => Hash::make($faker->word)
    ];
});
