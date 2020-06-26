<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Speaker;
use App\Event;
use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'event_id' => function(){
    		$ev = Event::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($ev);
    	},
    	'speaker_id' => function(){
    		$ev = Speaker::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($ev);
    	},
    ];
});
