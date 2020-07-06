<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'thumbnail' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
