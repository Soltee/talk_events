<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];

    public function events(){
    	return $this->hasMany(Event::class);
    }
}
