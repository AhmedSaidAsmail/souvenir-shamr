<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SectionDetail::class, function (Faker $faker) {
    return [
        'en_meta_title'=>$faker->word,
        'ar_meta_title'=>$faker->word,
        'it_meta_title'=>$faker->word,
        'ru_meta_title'=>$faker->word,
        'en_meta_keywords'=>$faker->word,
        'ar_meta_keywords'=>$faker->word,
        'it_meta_keywords'=>$faker->word,
        'ru_meta_keywords'=>$faker->word,
        'en_meta_description'=>$faker->word,
        'ar_meta_description'=>$faker->word,
        'it_meta_description'=>$faker->word,
        'ru_meta_description'=>$faker->word,
    ];
});
