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

	protected $listeners = [
        'reviewSectionRefresh' => '$refresh',
    ];

	public $activity;
	public $auth;
	public $message;

	public function mount(Activity $activity)
    {

        $this->activity = $activity;
        $this->auth  = Auth::guard()->user();

    }

    public function render()
    {
        $query = $this->activity
    						->replies()
    						->latest()
    						->with(['user'])
    						->get();
    						// ->paginate(1);
  		// $replies = $query->items();
    // 	$prev    = $query->previousPageUrl();
    // 	$next    = $query->nextPageUrl();
        return view('livewire.user.events.reply', [
        	'activity'    => $this->activity,
        	'replies'     => $query,
        	// 'next'        => $next,
        	// 'prev'        => $prev
        ]);
    }

    /**Post Message */
    public function post(){
    	if($this->auth){

	    	$data = $this->validate([
	    		'message' => 'required'
	    	]);
	    	// dd($this->activity->activities);
	    	$this->activity->activities()->create([
	    		'user_id' => $this->auth->id,
	    		'message' => $this->message
	    	]);

	    	$this->goToPage(1);
	    	$this->message = '';
	    	// $this->$refresh;
	        $this->emit('reviewSectionRefresh');
    	}
    }
}
