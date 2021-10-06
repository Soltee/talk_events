<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speaker extends Model
{
	use HasFactory;
	
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
