<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'activity_id', 'event_id', 'user_id', 'message'
    ];

    public function activity(){
    	return $this->belongsTo(Activity::class);
    }

    public function event(){
    	return $this->belongsTo(Event::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
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
