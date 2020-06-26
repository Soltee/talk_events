<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'company_id', 'cover', 'name', 'venue', 'price', 'start_time', 'end_time', 'book_before', 'ticket', 'description' , 'venue_name','venue_address', 'venue_latitude', 'venue_longitude',
    ];
}
