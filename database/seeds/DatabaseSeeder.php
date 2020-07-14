<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 15)->create();
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

        //Event manager
        $event_manager_role = Role::create(['name' => 'event-manager']);
        $event_manager_role->givePermissionTo('add categories');
        $event_manager_role->givePermissionTo('update categories');
        $event_manager_role->givePermissionTo('view categories');
        $event_manager_role->givePermissionTo('delete categories');
        $event_manager_role->givePermissionTo('add events');
        $event_manager_role->givePermissionTo('update events');
        $event_manager_role->givePermissionTo('view events');
        $event_manager_role->givePermissionTo('delete events');

        $event_manager = factory(App\User::class)->create([
            'first_name'        => 'Event',
            'last_name'         => 'manager',
            'email'             => 'event@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $event_manager->assignRole($event_manager_role);

        //Others manager
        $manager_role = Role::create(['name' => 'manager']);
        $manager_role->givePermissionTo('add speakers');
        $manager_role->givePermissionTo('update speakers');
        $manager_role->givePermissionTo('view speakers');
        $manager_role->givePermissionTo('delete speakers');
        $manager_role->givePermissionTo('add sponsers');
        $manager_role->givePermissionTo('update sponsers');
        $manager_role->givePermissionTo('view sponsers');
        $manager_role->givePermissionTo('delete sponsers');

        $event_manager = factory(App\User::class)->create([
            'first_name'        => 'only',
            'last_name'         => 'manager',
            'email'             => 'manager@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $event_manager->assignRole($manager_role);

        //super admin
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'delete users']);

        $super_admin_role = Role::create(['name' => 'super-admin']);
        $super_admin_role->givePermissionTo('add categories');
        $super_admin_role->givePermissionTo('update categories');
        $super_admin_role->givePermissionTo('view categories');
        $super_admin_role->givePermissionTo('delete categories');
        $super_admin_role->givePermissionTo('add events');
        $super_admin_role->givePermissionTo('update events');
        $super_admin_role->givePermissionTo('view events');
        $super_admin_role->givePermissionTo('delete events');
        $super_admin_role->givePermissionTo('add speakers');
        $super_admin_role->givePermissionTo('update speakers');
        $super_admin_role->givePermissionTo('view speakers');
        $super_admin_role->givePermissionTo('delete speakers');
        $super_admin_role->givePermissionTo('add sponsers');
        $super_admin_role->givePermissionTo('update sponsers');
        $super_admin_role->givePermissionTo('view sponsers');
        $super_admin_role->givePermissionTo('delete sponsers');
        $super_admin_role->givePermissionTo('add users');
        $super_admin_role->givePermissionTo('update users');
        $super_admin_role->givePermissionTo('view users');
        $super_admin_role->givePermissionTo('delete users');

        $super_admin = factory(App\User::class)->create([
            'first_name'        => 'super-admin',
            'last_name'         => 'admin',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10)
        ]);

        $super_admin->assignRole($super_admin_role);


        factory(App\Category::class, 2)->create();
        factory(App\Event::class, 30)->create();
        factory(App\Speaker::class, 30)->create();
        factory(App\Sponser::class, 16)->create();
        factory(App\Booking::class, 10)->create();
        factory(App\Social::class, 60)->create();
    }
}
