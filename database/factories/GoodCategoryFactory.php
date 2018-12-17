<?php

use Faker\Generator as Faker;

$factory->define(App\GoodCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
    ];
});
