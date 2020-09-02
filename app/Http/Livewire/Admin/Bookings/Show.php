<?php

namespace App\Http\Livewire\Admin\Bookings;

use Livewire\Component;
use App\Booking;
use App\Event;
use App\User;

class Show extends Component
{
	public $booking;
	public $event;
	public $status;

    public function mount($booking)
    {
    	$booking = Booking::findOrfail($booking);
    	$this->event   = $booking->event;
        $this->booking = $booking;
        if(now() < $this->event->start){
        	$this->status = 'Incoming';
        } elseif(now() > $this->event->end){
        	$this->status = 'Ended';
        } else {
        	$this->status = 'OnGoing';
        }

    }


    public function render()
    {
        return view('livewire.admin.bookings.show', [
        		'booking' => $this->booking,
        		'event'   => $this->event,
        		'status'  => $this->status
        	]);
    }


    /* Remove the Booking */
    public function drop(){
    	$this->booking->delete();
    	session()->flash('success', 'Booking dropped');
    	return redirect()->to('/admin/bookings');
    }
}
