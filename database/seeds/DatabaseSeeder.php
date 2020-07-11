<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)->create();
        factory(App\Category::class, 12)->create();
        factory(App\Event::class, 50)->create();
        factory(App\Country::class, 50)->create();
        factory(App\State::class, 50)->create();
        factory(App\City::class, 50)->create();
        factory(App\Venue::class, 50)->create();
        factory(App\Speaker::class, 120)->create();
        factory(App\Topic::class, 200)->create();
        factory(App\Sponser::class, 200)->create();
        factory(App\Booking::class, 120)->create();
    }
}
