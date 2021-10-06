<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
    	'user_id', 'linkedin_link', 'twitter_link', 'facebook_link', 'youtube_link', 'instagram_link'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
