<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
    	'thumbnail',  'name', 'email', 'country', 'city', 'street_address', 'company_type', 'description', 'twitter', 'facebook', 'instagram', 'youtube'
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function events(){
    	return $this->hasMany(Event::class);
    }
}
