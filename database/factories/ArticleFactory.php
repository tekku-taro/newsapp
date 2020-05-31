<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(),
        'description'=>implode(".", $faker->sentences()),
        'url'=>$faker->url,
        'content'=>$faker->text(),
        'news_site_id'=>App\NewsSite::all()->random()->first()->id,
    ];
});
