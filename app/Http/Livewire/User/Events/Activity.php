<?php

namespace App\Http\Livewire\User\Events;

use Livewire\Component;
use App\Models\Event;
use App\Models\Activity as EventActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Activity extends Component
{
	use WithPagination;

	// protected $listeners = ['reply'];

	public $event;
	public $auth;
	public $message;
	public $reply;
	public $show = false;

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
        ])->extends('layouts.user')
            ->section('content');
    }

    /* Toggle The Replies */
    public function toggle(){
    	$this->show = !$this->show;
    }

    /**Post Message */
    public function post(){
    	if($this->auth){

	    	$data = $this->validate([
	    		'message' => 'required'
	    	]);
	    	// dd($this->event->activities);
	    	$this->event->activities()->create([
	    		'user_id'   => $this->auth->id,
	    		'message'   => $this->message
	    	]);

	    	$this->goToPage(1);
	    	$this->message = '';
	    	// $this->$refresh;
	        // $this->emit('reviewSectionRefresh');
    	}
    }

    /**Reply Message */
    public function reply(int $id){
    	if($this->auth){
	    	$data = $this->validate([
	    		'reply' => 'required'
	    	]);
	    	$eventActivity = EventActivity::findOrfail($id);
	    	// dd($eventActivity->id);
	    	$eventActivity->replies()->create([
	    		'user_id' => $this->auth->id,
	    		'event_id'  => $this->event->id,
	    		'message' => $this->reply
	    	]);

	    	// $this->goToPage(1);
	    	$this->reply = '';
	    	$this->show  = false;
	    	// $this->$refresh;
	        // $this->emit('reviewSectionRefresh');
    	}
    }
}
