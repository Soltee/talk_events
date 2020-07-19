<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\QueryBuilder\QueryBuilder as Builder;

class Event extends Model
{
    protected $fillable = [
        'category_id', 'user_id', 'cover', 'thumbnail', 'title', 'slug', 'sub_title', 'price', 'start', 'time', 'end', 'book_before', 'ticket', 'description' , 'venue_name', 'venue_full_address', 'venue_latitude', 'venue_longitude'
    ];

    public function scopeStartsAt(Builder $query, $date): Builder
    {
        return $query->where('start', '>=', Carbon::parse($date));
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function speakers(){
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    public function sponsers(){
        return $this->belongsToMany(Sponser::class, 'event_sponser');
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

    public function actual_date($date)
    {
        $d = date_create($date);
        return date_format($d, "m/d/Y");
    }


}
