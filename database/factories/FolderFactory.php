<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Folder;
use Faker\Generator as Faker;

$factory->define(Folder::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(),
        'user_id'=>App\User::all()->random()->first()->id,
    ];
});
