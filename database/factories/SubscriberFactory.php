<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name'  => $faker->firstName,
        'state' => $faker->randomElement(\App\Models\Subscriber::STATES),
    ];
});
