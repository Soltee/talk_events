<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponser extends Model
{
   use HasFactory;
   
    protected $fillable = [
       'user_id', 'avatar', 'full_name', 'email', 'about', 'company_name', 'company_link' ,
    ];

    public function events(){
    	return $this->belongsToMany(Event::class, 'event_sponser');
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
