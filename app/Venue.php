<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
     protected $fillable = [
      'event_id', 'country_id', 'state_id', 'city_id', 'image', 'thumbnail', 'name', 'street_address', 'latitude', 'longitude',
    ];

    public function event(){
    	return $this->belongsTo(Event::class);
    }

    public function country(){
    	return $this->belongsTo(Country::class);
    }

    public function state(){
    	return $this->belongsTo(State::class);
    }

    public function city(){
    	return $this->belongsTo(City::class);
    }
}
