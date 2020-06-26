<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'event_id',  'price', 'quantity', 'payment_type', 'payment_id',  'sub_total', 'taxes',  'grand_total'
    ];
}
