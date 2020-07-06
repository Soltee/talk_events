<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];

    public function events(){
    	return $this->hasMany(Event::class);
    }

    
    public function slug()
    {
        return Str::slug($this->name);
    }
}
