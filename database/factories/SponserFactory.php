<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Sponser;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class SponserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sponser::class;

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
            'full_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'company_name' => $this->faker->company
        ];
    }
}
