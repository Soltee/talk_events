<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
	protected $updatesQueryString = ['title', 'price', 'venue_name', 'created_at', 'start'];
    public $title        = '';
    public $price        = '';
    public $venue_name   = '';
    public $created_at   = '';
    public $start        = '';
    public $message      = '';
    public $status       = false;

    public function render()
    {	
        if($this->title || $this->price || $this->venue_name || $this->start || $this->created_at){
            $this->goToPage(1);
        }

    	$paginate            = Event::latest()
                                ->where('title' ,   'LIKE', '%'. $this->title .'%')
                                ->where('price' ,   'LIKE', '%'. $this->price .'%')
                                ->where('venue_name' ,   'LIKE', '%'. $this->venue_name .'%')
                                ->where('start' ,   'LIKE', '%'. $this->start .'%')
                                ->where('start' ,   'LIKE', '%'. $this->created_at .'%')
                                ->with(['user', 'bookings'])
                                ->paginate(10)
                                ->appends(request()->query());

        return view('livewire.admin.events.index', [
            'events'       => $paginate,
            'first'        => $paginate->firstItem(),
            'last'         => $paginate->lastItem(),
            'total'        => $paginate->total()
        ]);

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
