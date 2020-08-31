<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'first_name', 'last_name', 'email',  'price', 'payment_type', 'payment_id',  'sub_total', 'taxes',  'grand_total'
    ];


    public function user(){
    	return $this->belongsTo(User::class);
    }


    public function event(){
    	return $this->belongsTo(Event::class);
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

    //Check For Payment Type
    public function typeOfPayment(){
    	if($this->payment_type === 'stripe'){
    		return '<img src="/images/stripe.png" class="mr-3 h-12 w-12 object-contain rounded" />';
    	} elseif($this->payment_type === 'braintree' || $this->payment_type === 'paypal'){
    		return '<img src="/images/braintree.png" class="mr-3 h-12 w-12 object-contain rounded" />';
    	} else {
    		return '<img src="/images/visa.png" class="mr-3 h-12 w-12 object-contain rounded" />';    		
    	}
    }
}
