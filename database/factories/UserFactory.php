<?php

$factory->define(App\Models\UserModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'login' => $faker->email,
        'password' => (new \Illuminate\Hashing\BcryptHasher())->make($faker->password),
        'last_login_at' => $faker->dateTimeThisCentury(),
    ];
});
