<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'first_name', 'last_name', 'email',  'price', 'quantity', 'payment_type', 'payment_id',  'sub_total', 'taxes',  'grand_total'
    ];


    public function user(){
    	return $this->belongsTo(User::class);
    }


    public function event(){
    	return $this->belongsTo(Event::class);
    }
}
