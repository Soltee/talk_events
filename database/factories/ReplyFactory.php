<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Activity;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
            'message' => $this->faker->text(600)
        ];
    }
}
