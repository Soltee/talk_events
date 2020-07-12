<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	$name = $faker->name;
	$slug = Illuminate\Support\Str::slug($name);
    return [
        'user_id'      => function(){
        	$users = User::role('event-manager')->inRandomOrder()->pluck('id')->toArray();
            return Arr::random($users);
        },
        'name'      => $name,
        'slug'      => $slug,
        'thumbnail' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
