<?php

use Faker\Generator as Faker;

$factory->define(App\Vendor::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'id_card_number' => $faker->unique()->nik,
        'owner' => $faker->name,
        'address' => $faker->address,
        'phone_number' => $faker->randomNumber(8),
        'status' => true,
    ];
});
