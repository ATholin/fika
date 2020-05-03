<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Time::class, function (Faker $faker) {
    return [
        'start' => $faker->date('H:i'),
        'end' => $faker->date('H:i'),
        'fika_id' => factory(App\Fika::class)->create()->getAttribute('id')
    ];
});
