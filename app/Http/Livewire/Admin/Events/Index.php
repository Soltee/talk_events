<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
	protected $queryString = ['title', 'price', 'venue_name', 'created_at', 'start'];
    public $title        = '';
    public $price        = '';
    public $venue_name   = '';
    public $created_at   = '';
    public $start        = '';
    public $message      = '';
    public $status       = false;

    public function render()
    {	
        if($this->title){

            $paginate    = Event::latest()
                            ->where('title' ,   'LIKE', '%'. $this->title .'%')
                            ->with(['user', 'bookings'])
                            ->paginate(10)
                            ->appends(request()->query());
        } elseif($this->price) {

            $paginate    = Event::latest()
                            ->where('price' ,   'LIKE', '%'. $this->price .'%')
                            ->with(['user', 'bookings'])
                            ->paginate(10)
                            ->appends(request()->query());
        } elseif($this->venue_name) {

            $paginate    = Event::latest()
                            ->where('venue_name' ,   'LIKE', '%'. $this->venue_name .'%')
                            ->with(['user', 'bookings'])
                            ->paginate(10)
                            ->appends(request()->query());
        } elseif($this->start) {

            $paginate    = Event::latest()
                            ->where('start' ,   'LIKE', '%'. $this->start .'%')
                            ->with(['user', 'bookings'])
                            ->paginate(10)
                            ->appends(request()->query());
        } else {

    	   $paginate    = Event::latest()
                            ->with(['user', 'bookings'])
                            ->paginate(10)
                            ->appends(request()->query());
        }

        return view('livewire.admin.events.index', [
            'events'       => $paginate
        ])->extends('layouts.admin');

    }

    public function updatedTitle()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->title) {
            $this->title = null;
        }

        $this->gotoPage(1);
    }

    public function updatedPrice()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->price) {
            $this->price = null;
        }

        $this->gotoPage(1);
    }

    public function updatedVenue_name()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->venue_name) {
            $this->venue_name = null;
        }

        $this->gotoPage(1);
    }

    public function updatedStart()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->start) {
            $this->start = null;
        }

        $this->gotoPage(1);
    }
    

    /**Close*/
    public function close(){
        $this->status  = false;
        $this->message = '';
    }

    /* Remove the Event */
    public function drop($event){
        $event = Event::findOrfail($event);
        $event->delete();
        $this->status = true;
        $this->message = $event->id .' deleted.';
    }
}
