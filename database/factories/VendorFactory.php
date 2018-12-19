<?php

use Faker\Generator as Faker;

$factory->define(App\Vendor::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'address' => $faker->address,
        'phone_number' => $faker->randomNumber(8),
    ];
});
