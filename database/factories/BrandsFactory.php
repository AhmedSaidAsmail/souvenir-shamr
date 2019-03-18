<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        'en_name' => $faker->unique()->word,
        'ar_name' => $faker->unique()->word,
        'it_name' => $faker->unique()->word,
        'ru_name' => $faker->unique()->word,
        'sort_order' => $faker->numberBetween(0, 100),
        'status' => $faker->boolean(),
    ];
});
