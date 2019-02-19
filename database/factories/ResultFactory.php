<?php

$factory->define(App\Models\ResultModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(50),
        'shooter_id' => $factory->create(\App\Models\ShooterModel::class)->id,
        'event_id' => $factory->create(\App\Models\EventModel::class)->id,
        'competition' => $faker->numberBetween(1, 20),
        'results' => json_encode([]),
        'point_sum' => $faker->numberBetween(1, 500),
        'time_sum' => $faker->numberBetween(1, 120)
    ];
});
