<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
    	'user_id', 'speaker_id', 'sponser_id', 'member_id', 'linkedin_link', 'twitter_link', 'facebook_link', 'youtube_link', 'instagram_link'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function speaker(){
    	return $this->belongsTo(Speaker::class);
    }

    public function sponser(){
    	return $this->belongsTo(Sponser::class);
    }
    
    public function member(){
    	return $this->belongsTo(Member::class);
    }
}
