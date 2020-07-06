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
        // $this->call(UserSeeder::class);
        factory(App\User::class, 30)->create();
        factory(App\Admin::class)->create([
	        'first_name' => 'Admin',
	        'last_name' => 'Last',
	        'email' => 'admin@example.com',
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Illuminate\Support\Str::random(10),
        ]);
        
        factory(App\Category::class, 12)->create();
        factory(App\Company::class, 30)->create();
        factory(App\Event::class, 50)->create();
        factory(App\Venue::class, 30)->create();
        factory(App\Speaker::class, 30)->create();
        factory(App\Topic::class, 30)->create();
        factory(App\Sponser::class, 30)->create();
        factory(App\Booking::class, 80)->create();
    }
}
