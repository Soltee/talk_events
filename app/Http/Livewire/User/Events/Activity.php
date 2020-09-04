<?php

namespace App\Http\Livewire\User\Events;

use Livewire\Component;
use App\Event;
use App\Activity as EventActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Activity extends Component
{
	use WithPagination;

	protected $listeners = [
        'reviewSectionRefresh' => '$refresh',
    ];

	public $event;
	public $auth;
	public $message;

	public function mount(Event $event)
    {

        $this->event = $event;
        $this->auth  = Auth::guard()->user();

    }

    public function render()
    {
    	// dd('ff');
    	$activities = $this->event
    						->activities()
    						->latest()
    						->with(['user', 'replies'])
    						->paginate(2);
        return view('livewire.user.events.activity', [
        	'event'       => $this->event,
        	'activities'  => $activities
        ]);
    }

    /**Post Message */
    public function post(){
    	if($this->auth){

	    	$data = $this->validate([
	    		'message' => 'required'
	    	]);
	    	// dd($this->event->activities);
	    	$this->event->activities()->create([
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
