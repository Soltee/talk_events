<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venue;
use App\Event;
use Faker\Generator as Faker;

$factory->define(Venue::class, function (Faker $faker) {
    return [
        'event_id' => function(){
    		$ev = Event::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($ev);
    	},
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'name' => $faker->name,
        'address' => $faker->address,
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180)
    ];
});
