<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NewsSite;
use Faker\Generator as Faker;

$factory->define(NewsSite::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(),
        'details'=>implode(".", $faker->sentences()),
        'url'=>$faker->url,
        'sources'=>$faker->randomElement(['bbc','ap','nikkei']),
        'category_id'=>App\Category::all()->random(1)->first()->id,
        'country_id'=>App\Country::all()->random(1)->first()->id,
    ];
});
