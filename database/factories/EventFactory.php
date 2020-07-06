<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use App\User;
use App\Company;
use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Event::class, function (Faker $faker) {
    return [
    	'category_id' => function(){
    		$cat = Category::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($cat);
    	},
        'company_id' => function(){
            $companies = Company::inRandomOrder()->pluck('id')->toArray();
            return Arr::random($companies);
        },
        'cover' => $faker->imageUrl($width = 640, $height = 480),
        'name' => $faker->firstName,
        'price' => function() { 
        	$p = [50, 60, 70, 100];
        	return Arr::random($p);
        }, 
        'start_time' => function() { 
        	$start = [50, 60, 70, 90, 100];
        	return now()->addDays(Arr::random($start));
        }, 
        'end_time' => function() { 
        	$end = [100, 102, 104, 106, 108, 110];
        	return now()->addDays(Arr::random($end));
        }, 
        'book_before' => function() { 
        	$end = [10, 20, 25, 30, 40, 45];
        	return now()->addDays(Arr::random($end));
        },
        'ticket'   => function(){
        	return Arr::random([100, 120, 140, 200, 60]);
        },
        'description' => $faker->text($maxNbChars = 200)
    ];
});
