<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
	protected $fillable = [
	    'user_id' ,
	    'avatar'   ,
	    'first_name' , 'last_name', 'email',
	    'about'   , 'linkedin_link', 'twitter_link'
	];


	public function events(){
    	return $this->belongsToMany(Event::class);
    }
    
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function social(){
        return $this->hasOne(Social::class);
    }
}
