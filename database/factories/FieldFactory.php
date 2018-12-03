<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Field::class, function (Faker $faker) {
    $title = $faker->unique()->words(3, true);

    return [
        'title' => $title,
        'key'   => str_slug($title),
        'type'  => $faker->randomElement(\App\Models\Field::TYPES),
    ];
});
