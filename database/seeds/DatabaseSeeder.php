<?php

use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
use App\Permission;
use App\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
// use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $users = factory(App\User::class, 40)->create();
        //Roles & Permisssons
        $user_role = Role::create(['name' => 'user', 'slug' => 'user']);
        $user_role = Role::where('slug', 'user')->first();

        foreach($users as $user){
            $user->roles()->attach($user_role->id);
        }

        $us = factory(App\User::class)->create([
            'first_name'        => 'user',
            'last_name'         => 'no',
            'email'             => 'user@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('user1234'), // password
            'remember_token'    => Str::random(10)
        ]);

        $us->roles()->attach($user_role->id);   
             
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

        // Event manager
        $event_manager_role = new Role();
        $event_manager_role->name = 'event manager';
        $event_manager_role->slug = 'event-manager';
        $event_manager_role->save();
        $event_manager_role->permissions()->attach([
                1,2,3,4,5,6,7,8
            ]);


        $event_manager = factory(App\User::class)->create([
            'first_name'        => 'Event',
            'last_name'         => 'manager',
            'email'             => 'event@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $event_manager->roles()->attach($event_manager_role->id);   

        $event_manager->permissions()->attach([
            
              1,2,3,4,5,6,7,8

            ]);

        // Manager only
        $manager_role = new Role();
        $manager_role->name = 'manager';
        $manager_role->slug = 'manager';
        $manager_role->save();
        $manager_role->permissions()->attach([
                9,10,11,12,13,14,15,16
            ]);


        $manager = factory(App\User::class)->create([
            'first_name'        => 'man',
            'last_name'         => 'manager',
            'email'             => 'manager@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $manager->roles()->attach($manager_role->id);   

        $manager->permissions()->attach([
            
                9,10,11,12,13,14,15,16

            ]);
        // //super admin

        $super_admin_role = new Role();
        $super_admin_role->name = 'super admin';
        $super_admin_role->slug = 'super-admin';
        $super_admin_role->save();
        $super_admin_role->permissions()
                        ->attach([
                            1,2,3,4,5,
                            6,7,8,9,10,
                            11,12,13,14,15,
                            16,17,18,19,20
                        ]);
       

        $super_admin = factory(App\User::class)->create([
            'first_name'        => 'super-admin',
            'last_name'         => 'admin',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $super_admin->roles()->attach($super_admin_role->id);
        $super_admin
            ->permissions()->attach([
                1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
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
        factory(App\Activity::class, 300)->create();
        factory(App\Reply::class, 300)->create();
    }
}
