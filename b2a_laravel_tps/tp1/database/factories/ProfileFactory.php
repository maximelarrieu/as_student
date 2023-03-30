<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'age' => $faker->dateTime,
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
