<?php

namespace App\Http\Livewire\User\Events;

use Livewire\Component;
use App\Activity;
use App\Reply as ActivityReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Reply extends Component
{
	use WithPagination;

	public $activity;
	public $auth;

	public function mount(Activity $activity)
    {

        $this->activity = $activity;
        $this->auth  = Auth::guard()->user();

    }

    public function render()
    {
        $replies = $this->activity
    						->replies()
    						->latest()
    						->with(['user'])
    						->paginate(1);
        return view('livewire.user.events.reply', [
        	'activity'       => $this->activity,
        	'replies'     => $replies
        ]);
    }
}
