<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
	protected $fillable = [
	    'event_id' ,
	    'avatar'   ,
	    'first_name' , 'last_name', 'email',
	    'about'   , 'linkedin_link', 'twitter_link'
	];


	public function event(){
    	return $this->belongsTo(Event::class);
    }
    
    public function social(){
        return $this->hasOne(Social::class);
    }
}
