<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $filable = [
    	'user_id', 'thumbnail', 'image_url', 'caption', 'slug', 
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
