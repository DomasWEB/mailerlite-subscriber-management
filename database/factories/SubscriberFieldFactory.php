<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SubscriberField::class, function (Faker $faker) {
    $field = \App\Models\Field::inRandomOrder()->first();

    if ($field->type == \App\Models\Field::TYPE_DATE) {
        $value = $faker->date();
    } elseif ($field->type == \App\Models\Field::TYPE_BOOLEAN) {
        $value = $faker->boolean;
    } elseif ($field->type == \App\Models\Field::TYPE_NUMBER) {
        $value = $faker->numberBetween();
    } else {
        $value = $faker->word;
    }

    return [
        'field_id' => $field->id,
        'value'    => $value,
    ];
});
