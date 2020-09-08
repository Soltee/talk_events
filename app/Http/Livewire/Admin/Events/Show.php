<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Show extends Component
{
	use WithPagination;
	public $event;
	// public $bookings;
	public $user;
	public $modal          = false;
	public $event_status;
    public $status;

    public function mount(Event $event){

		$this->event       = $event;
        // $this->bookings    = $event->bookings()->paginate(1);
		$this->user        = $event->user;
        if(now() < $this->event->start){
        	$this->event_status = 'Incoming';
        } elseif(now() > $this->event->end){
        	$this->event_status = 'Ended';
        } else {
        	$this->event_status = 'OnGoing';
        }
	}

    public function render()
    {
        $bookings    = $this->event->bookings()->paginate(10);
        // dd($bookings);
        return view('livewire.admin.events.show', [
        	'event'       => $this->event,
        	'bookings_count'    => $bookings->total(),
        	'bookings'    => $bookings,
        	'user'        => $this->user
        ]);
    }


    /* Set Model Visiibility*/
    public function setVisibility(){
    	$this->modal  = !$this->modal;
        $this->status = '';
        // $this->dispatchBrowserEvent('close-modal');

    }

    /* Remove the User */
    public function drop($event){
    	$event = Event::findOrfail($event);
    	$event->delete();
    	
    	session()->flash('success', 'Event dropped');
    	return redirect()->to('/admin/events');
    }
}
