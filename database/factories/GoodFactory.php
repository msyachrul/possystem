<?php

use Faker\Generator as Faker;

$factory->define(App\Good::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
        'cost_of_good' => $faker->randomNumber(5),
        'price' => $faker->randomNumber(6),
        'good_category_id' => $faker->randomNumber(1),
        'vendor_id' => $faker->randomNumber(2),
    ];
});
