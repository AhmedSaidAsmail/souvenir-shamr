<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Section::class, function (Faker $faker) {
    return [
        'en_name' => $faker->unique()->name,
        'ar_name' => $faker->unique()->name,
        'it_name' => $faker->unique()->name,
        'ru_name' => $faker->unique()->name,
        'sort_order' => $faker->numberBetween(0, 100),
        'status' => $faker->boolean(),
        'home' => $faker->boolean(),
        'home_sort_order' => $faker->numberBetween(0, 100),
        'home_img' => $faker->imageUrl($width = 1170, $height = 250),
        'symbol' => null,
        'banner_img' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
