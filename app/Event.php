<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'category_id', 'user_id', 'cover', 'thumbnail', 'title', 'slug', 'sub_title', 'price', 'start_time', 'end_time', 'book_before', 'ticket', 'description' ,
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function location(){
        return $this->hasOne(Venue::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function speakers(){
        return $this->hasMany(Speaker::class);
    }

    public function sponsers(){
        return $this->hasMany(Sponser::class);
    }

     public function members(){
        return $this->hasMany(User::class);
    }

    public function slug()
    {
        return Str::slug($this->name);
    }
}
