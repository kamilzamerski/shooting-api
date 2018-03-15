<?php

$factory->define(App\Models\ClubModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'license_no' => $faker->randomNumber(2). '/' . $faker->year(),
    ];
});
