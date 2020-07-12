<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
    	'user_id', 'linkedin_link', 'twitter_link', 'facebook_link', 'youtube_link', 'instagram_link'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
