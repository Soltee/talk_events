<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 40)->create();
        //Roles & Permisssons
        $user_role = Role::create(['name' => 'user']);
        $user_role = Role::findByName('user');

        foreach($users as $user){
            $user->assignRole($user_role);
        }

        $us = factory(App\User::class)->create([
            'first_name'        => 'user',
            'last_name'         => 'no',
            'email'             => 'user@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('user1234'), // password
            'remember_token'    => Str::random(10)
        ]);
        $us->assignRole($user_role);   
             
        Permission::create(['name' => 'add categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'add events']);
        Permission::create(['name' => 'update events']);
        Permission::create(['name' => 'view events']);
        Permission::create(['name' => 'delete events']);

        Permission::create(['name' => 'add speakers']);
        Permission::create(['name' => 'update speakers']);
        Permission::create(['name' => 'view speakers']);
        Permission::create(['name' => 'delete speakers']);

        Permission::create(['name' => 'add sponsers']);
        Permission::create(['name' => 'update sponsers']);
        Permission::create(['name' => 'view sponsers']);
        Permission::create(['name' => 'delete sponsers']);

        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'delete users']);

        //Event manager
        $event_manager_role = Role::create(['name' => 'event-manager']);
        $event_manager_role->givePermissionTo([
            
                'add categories',
                'update categories',
                'view categories',
                'delete categories',

                'add events',
                'update events',
                'view events',
                'delete events',

            ]);

        $event_manager = factory(App\User::class)->create([
            'first_name'        => 'Event',
            'last_name'         => 'manager',
            'email'             => 'event@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $event_manager->assignRole($event_manager_role);
        $event_manager->givePermissionTo([
            
                'add categories',
                'update categories',
                'view categories',
                'delete categories',

                'add events',
                'update events',
                'view events',
                'delete events',

            ]);

        //Others manager
        $manager_role = Role::create(['name' => 'manager']);
        $manager_role->givePermissionTo([
            
                'add speakers',
                'update speakers',
                'view speakers',
                'delete speakers',

                'add sponsers',
                'update sponsers',
                'view sponsers',
                'delete sponsers',

            ]);

        $manager = factory(App\User::class)->create([
            'first_name'        => 'only',
            'last_name'         => 'manager',
            'email'             => 'manager@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $manager->assignRole($manager_role);
        $manager->givePermissionTo([
            
                'add speakers',
                'update speakers',
                'view speakers',
                'delete speakers',

                'add sponsers',
                'update sponsers',
                'view sponsers',
                'delete sponsers',

            ]);

        //super admin

        $super_admin_role = Role::create(['name' => 'super-admin']);
        $super_admin_role
            ->givePermissionTo([
                'add categories', 
                'update categories',
                'delete categories',

                'add events',
                'update events',
                'view events',
                'delete events',

                'add speakers',
                'update speakers',
                'view speakers',
                'delete speakers',

                'add sponsers',
                'update sponsers',
                'view sponsers',
                'delete sponsers',

                'add users',
                'update users',
                'view users',
                'delete users'

            ]);
       

        $super_admin = factory(App\User::class)->create([
            'first_name'        => 'super-admin',
            'last_name'         => 'admin',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $super_admin->assignRole($super_admin_role);
        $super_admin
            ->givePermissionTo([
                'add categories', 
                'update categories',
                'delete categories',

                'add events',
                'update events',
                'view events',
                'delete events',

                'add speakers',
                'update speakers',
                'view speakers',
                'delete speakers',

                'add sponsers',
                'update sponsers',
                'view sponsers',
                'delete sponsers',

                'add users',
                'update users',
                'view users',
                'delete users'

            ]);
       

        factory(App\Category::class, 10)->create();
        factory(App\Event::class, 100)->create();
        factory(App\Speaker::class, 200)->create();

        foreach(App\Event::all() as $event){
            $speakers_ids = App\Speaker::latest()->inRandomOrder()->take(rand(1,3))->pluck('id');
            $event->speakers()->attach($speakers_ids);
        }

        factory(App\Sponser::class, 100)->create();

        foreach(App\Event::all() as $event){
            $sponsers_ids = App\Sponser::latest()->inRandomOrder()->take(rand(1,3))->pluck('id');
            $event->sponsers()->attach($sponsers_ids);
        }

        factory(App\Booking::class, 80)->create();
        factory(App\Social::class, 100)->create();
    }
}
