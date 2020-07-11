<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use App\State;
use App\City;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country,
    ];
});

$factory->define(State::class, function (Faker $faker) {
    return [
        'country_id' => function(){
        	$c =  Country::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($c);
        },
        'name' => $faker->unique()->state,
    ];
});

$factory->define(City::class, function (Faker $faker) {
    return [
        'country_id' => function(){
        	$c =  Country::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($c); 
        },
        'state_id' => function() {
            $state =  State::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($state);
        },
        'name' => $faker->unique()->city
    ];
});