<?php

use Faker\Generator as Faker;

$factory->define(App\Good::class, function (Faker $faker) {
    return [
    	'barcode' => $faker->randomNumber(6),
        'name' => $faker->firstNameMale,      
        'price' => $faker->randomNumber(5),
        'good_category_id' => $faker->randomNumber(1),
        'vendor_id' => $faker->randomNumber(1),
    ];
});
