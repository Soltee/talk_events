<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Social;
use Faker\Generator as Faker;

$factory->define(Social::class, function (Faker $faker) {
    return [
        'user_id' => function(){
    		$us = User::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($us);
    	},
    	'twitter_link' => 'http://twitter.com/',
    ];
});
