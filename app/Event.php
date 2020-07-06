<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'company_id', 'cover', 'name', 'venue', 'price', 'start_time', 'end_time', 'book_before', 'ticket', 'description' , 
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function company(){
    	return $this->belongsTo(Company::class);
    }

    public function speakers(){
    	return $this->hasMany(Speaker::class);
    }

    public function sponsers(){
    	return $this->hasMany(Sponser::class);
    }

    public function location(){
        return $this->hasOne(Venue::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function slug()
    {
        return Str::slug($this->name);
    }
}
