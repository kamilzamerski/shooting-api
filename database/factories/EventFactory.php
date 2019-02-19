<?php

$factory->define(App\Models\EventModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(50),
        'date' => $faker->date()
    ];
});
