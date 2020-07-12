<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

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


    public function social(){
        return $this->hasOne(Social::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
  
}
