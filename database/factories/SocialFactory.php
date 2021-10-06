<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Social;
use App\Models\Speaker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Social::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                $us = User::inRandomOrder()->pluck('id')->toArray();
                return Arr::random($us);
            },
            'twitter_link' => 'http://twitter.com/',
        ];
    }
}
