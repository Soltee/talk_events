<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'thumbnail'  =>  $faker->imageUrl($width = 640, $height = 480),
        'name'       => $faker->company,
        'country'    =>  $faker->countryCode,
        'city'       =>  $faker->city,
        'street_address'  => $faker->address, 
        'company_type'    =>  $faker->name,
        'description'     =>  $faker->text($maxNbChars = 200)
});
