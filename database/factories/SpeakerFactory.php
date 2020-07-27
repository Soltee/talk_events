<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Event;
use App\Speaker;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Speaker::class, function (Faker $faker) {
    return [
    	'user_id' => function(){
    		$us = User::role('manager')->inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($us);
    	},
        'avatar' => $faker->imageUrl($width = 200, $height = 200),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
    ];
});
