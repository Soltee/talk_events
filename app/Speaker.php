<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
	protected $fillable = [
	    'event_id' ,
	    'avatar'   ,
	    'first_name' , 'last_name', 'email',
	    'description'   ,
	    'twitter'   ,
	    'facebook'   ,
	    'linkedin'   ,
	    'full_description'   ,
	];
}
