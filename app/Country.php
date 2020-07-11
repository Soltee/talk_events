<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
      'name', 
    ];

    public function states(){
    	return $this->hasMany(State::class);
    }

     public function cities(){
    	return $this->hasMany(City::class);
    }

    public function venues(){
    	return $this->hasMany(Venue::class);
    }
}
