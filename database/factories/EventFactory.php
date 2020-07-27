<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use App\User;
use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Event::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = Illuminate\Support\Str::slug($name);

    return [
    	'category_id' => function(){
    		$cat = Category::inRandomOrder()->pluck('id')->toArray();
    		return Arr::random($cat);
    	},
        'user_id' => function(){
            $users = User::role('event-manager')->inRandomOrder()->pluck('id')->toArray();
            return Arr::random($users);
        },
        'cover' => $faker->imageUrl($width = 400, $height = 300),
        'title' => $name,
        'slug'  => $slug,
        'price' => function() { 
        	$p = [50, 60, 70, 100];
        	return Arr::random($p);
        }, 
        'start' => function() { 
            $start = [50, 60, 70, 90, 100];
            return now()->addDays(Arr::random($start));
        },
        'time' => function() { 
            $time = [50, 60, 70, 90, 100];
            return now()->addMinutes(Arr::random($time));
        }, 
        'end' => function() { 
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
        'is_paid'   => function(){
            return Arr::random([true, false]);
        },
        'description' => $faker->text(),
        'venue_name' => $faker->streetName,
        'venue_full_address' => $faker->streetAddress,
        'venue_latitude' => $faker->latitude(),
        'venue_longitude' => $faker->longitude()
    ];
});
