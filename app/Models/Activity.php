<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id', 'user_id', 'message'
    ];

    public function event(){
    	return $this->belongsTo(Event::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
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
