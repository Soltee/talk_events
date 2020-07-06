<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
     protected $fillable = [
        'event_id', 'speaker_id', 'name', 'when'
    ];

    public function event(){
    	return $this->belongsTo(Event::class);
    }

    public function speaker(){
    	return $this->belongsTo(Sponser::class);
    }
}
