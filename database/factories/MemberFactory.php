<?php

$factory->define(App\Models\MemberModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'date_of_join' => $faker->dateTimeThisCentury(),
        'pesel' => $faker->randomNumber(11),
        'address_street' => $faker->streetName,
        'address_street_no' => $faker->buildingNumber,
        'address_apartment_no' => $faker->buildingNumber,
        'post_code' => $faker->postcode,
        'city' => $faker->city,
        'shooting_license' => $faker->randomNumber(4). '/' . $faker->year(),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'active_to' => $faker->dateTimeBetween('now', '+10 years')
    ];
});
