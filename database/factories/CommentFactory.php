<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(),
        'body'=>$faker->sentence(),
        'user_id'=>App\User::all()->random()->first()->id,
        'article_id'=>App\Article::all()->random()->first()->id,
    ];
});
