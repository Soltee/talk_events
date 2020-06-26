<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
$factory->define(Booking::class, function (Faker $faker) {
	$price    = $faker->price;
	$qty      = $faker->numberBetween(1, 4);
	$subTotal = $price * $qty;
	$taxes = (15/100) * $subTotal;
	$grand = $subTotal + $taxes;
    return [
        'user_id'       =>  function(){
        	$users = App\User::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($users);
        }  , 
        'event_id'      =>  function(){
        	$events = App\Event::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($events);
        }  , 
        'price'         =>  $price  , 
        'quantity'      =>  $qty , 
        'payment_type'  =>  function(){
        	$methods = ['stripe', 'braintree', 'paypal'];
    		return Arr::random($methods);
        }  , 
        'payment_id'    =>  $faker->bankAccountNumber  , 
        'sub_total'     =>  $subTotal  , 
        'taxes'         =>  $taxes  , 
        'grand_total'   =>  $grand 
    ];
});
