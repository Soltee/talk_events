<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use App\Reply;
use App\Event;
use App\User;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {

    return [
    	'user_id' => function(){
    		$user = User::role('user')->inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($user);
    	},
        'event_id' => function(){
            $event = Event::inRandomOrder()->pluck('id')->toArray();
            return Arr::random($event);
        },
        'message' => $faker->text(600)
    ];
});

$factory->define(Reply::class, function (Faker $faker) {

    return [
    	'activity_id' => function(){
    		$activity = Activity::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($activity);
    	},
    	'user_id' => function(){
    		$user = User::role('user')->inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($user);
    	},
        'event_id' => function(){
            $event = Event::inRandomOrder()->pluck('id')->toArray();
            return Arr::random($event);
        },
        'message' => $faker->text(600)
    ];
});

