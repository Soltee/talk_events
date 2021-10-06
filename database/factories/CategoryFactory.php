<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = Str::slug($name);
        return [
            'user_id'      => function(){
                $users = User::role('event manager')->inRandomOrder()->pluck('id')->toArray();
                return Arr::random($users);
            },
            'name'      => $name,
            'slug'      => $slug,
            'thumbnail' => '/images/placeholder.png'
            // 'thumbnail' => $this->faker->imageUrl($width = 200, $height = 200)
        ];
    }
}
