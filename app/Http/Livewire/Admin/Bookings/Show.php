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
    public $event_status = '';
    public $modal;
    public $status;

    public function mount($booking)
    {
    	$booking = Booking::findOrfail($booking);
    	$this->event   = $booking->event;
        $this->booking = $booking;
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
        return view('livewire.admin.bookings.show', [
        		'booking'       => $this->booking,
        		'event'         => $this->event,
        		'event_status'  => $this->event_status
        ])->extends('layouts.admin');
    }

    /* Set Model Visiibility*/
    public function setVisibility(){
        $this->modal  = !$this->modal;
        $this->status = '';
    }

    /* Remove the Booking */
    public function drop($booking){
    	// $this->booking->delete();
    	session()->flash('success', 'Booking dropped');
    	return redirect()->to('/admin/bookings');
    }
}
