<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'first_name', 'last_name', 'email', 'password', 'gender', 'about', 'country', 'city', 'state', 'zip_code', 'street_address', 'company_name', 'company_type', 
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function category(){
        return $this->hasMany(category::class);
    }


    public function social(){
        return $this->hasOne(Social::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }

    //Roles & permissions
    public function scopeRole($query, $name)
    {
       return $query->whereHas('roles', function ($query) use ($name) 
            {
                $query->where('name', $name);
            });
    }
      
    //Attach Role
    public function assignRole(string $name){
        $role  = Role::where('name', $name)->first();
        return $this->roles()->attach($role->id);
    }

    public function removeRole(string $name){
        $role  = Role::where('name', $name)->first();
        return $this->roles()->detach($role->id);
    }
}

///
// $user = $request->user();
// dd($user->hasRole('developer')); //will return true, if user has role
// dd($user->givePermissionsTo('create-tasks'));// will return permission, if not null
// dd($user->can('create-tasks')); 
