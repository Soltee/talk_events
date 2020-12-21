<?php

namespace App\Http\Livewire\User\Bookings;

use Livewire\Component;
use App\Booking as Book;
use Illuminate\Support\Facades\Auth;

class Booking extends Component
{
	public $booking;
	public $event;
	public $status;

    public function mount($book)
    {
    	$booking = Book::findOrfail($book);
    	$this->event   = $booking->event->only('id', 'title', 'cover', 'slug', 'start', 'time', 'end', 'venue_name', 'venue_full_address');
        $this->booking = $booking;
        if(now() < $this->event['start']){
        	$this->status = 'Incoming';
        } elseif(now() > $this->event['end']){
        	$this->status = 'Ended';
        } else {
        	$this->status = 'OnGoing';
        }
    	
    }


    public function render()
    {
    	// dd($this->event['cover']);
    	
        return view('livewire.user.bookings.booking', [
        		'booking' => $this->booking,
        		'event'   => $this->event,
        		'status'  => $this->status
        	])
            ->extends('layouts.user')
            ->section('content');
    }
    
}

