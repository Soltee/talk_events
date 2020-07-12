<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponser extends Model
{
    protected $fillable = [
       'event_id', 'user_id', 'avatar', 'full_name', 'email', 'about', 'company_name', 'company_link' ,
    ];

    public function event(){
    	return $this->belongsTo(Event::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
