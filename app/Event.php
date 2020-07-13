<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Event extends Model
{
    protected $fillable = [
        'category_id', 'user_id', 'cover', 'thumbnail', 'title', 'slug', 'sub_title', 'price', 'start', 'time', 'end', 'book_before', 'ticket', 'description' , 'venue_name', 'venue_full_address', 'venue_latitude', 'venue_longitude'
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

    public function format_date($date){
        $date = Carbon::parse($date);
        return $date->translatedFormat('l jS F Y'); 
        // return $date->translatedFormat('g:i a l jS F Y'); 
    }


     public function format_time($time){
        $time = Carbon::parse($time);
        return $time->translatedFormat('g:i a'); 
    }

    public function Daysdiff()
    {
        $to = Carbon::createFromFormat('Y-m-d', $this->start);
        return $to->diffInDays(Carbon::createFromFormat('Y-m-d', $this->end));
    }


}
