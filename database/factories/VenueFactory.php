<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venue;
use App\Event;
use App\Country;
use App\State;
use App\City;
use Faker\Generator as Faker;

$factory->define(Venue::class, function (Faker $faker) {
    return [
        'event_id' => function(){
    		$ev = Event::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($ev);
    	},
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'country_id' => function() {
            $c =  Country::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($c);
        },
        'state_id' => function() {
            $state =  State::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($state);
        },
        'city_id' => function() {
            $city =  City::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($city);
        },
        'street_address' => $faker->streetAddress,
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180)
    ];
});
