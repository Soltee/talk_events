<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
    	'thumbnail',  'name', 'country', 'city', 'street_address', 'company_type', 'description', 'twitter', 'facebook', 'instagram', 'youtube'
    ];
}
