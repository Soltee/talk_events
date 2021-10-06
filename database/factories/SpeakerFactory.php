<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speaker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                $us = User::role('manager')->inRandomOrder()->pluck('id')->toArray();
                return Arr::random($us);
            },
            'avatar' => $this->faker->imageUrl($width = 200, $height = 200),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
