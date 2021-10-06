<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = Str::slug($name);
        $randomPrice = Arr::random([0, 50, 60, 100]);

        return [
            'category_id' => function(){
                $cat = Category::inRandomOrder()->pluck('id')->toArray();
                return Arr::random($cat);
            },
            'user_id' => function(){
                $users = User::role('event manager')->inRandomOrder()->pluck('id')->toArray();
                return Arr::random($users);
            },
            'cover' => '/images/placeholder.png',
            'title' => $name,
            'slug'  => $slug,
            'price' => $randomPrice,
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
            'is_paid'   => function($randomPrice){
                if($randomPrice = 0){
                    return 0;
                } else {
                    return 1;
                }
                // return Arr::random([true, false]);
            },
            'description' => $this->faker->text(600),
            'venue_name' => $this->faker->streetName,
            'venue_full_address' => $this->faker->streetAddress,
            'venue_latitude' => $this->faker->latitude(),
            'venue_longitude' => $this->faker->longitude()
        ];
    }
}
