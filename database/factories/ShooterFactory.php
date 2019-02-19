<?php

$factory->define(App\Models\ShooterModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'club_id' => $factory->create(\App\Models\ClubModel::class)->id,
        'shooting_license' => $faker->randomNumber(4). '/' . $faker->year(),
    ];
});
