<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
     protected $fillable = [
        'event_id', 'speaker_id', 'name', 'when'
    ];
}
