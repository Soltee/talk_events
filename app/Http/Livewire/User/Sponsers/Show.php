<?php

namespace App\Http\Livewire\User\Sponsers;

use Livewire\Component;
use App\Sponser;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;


class Show extends Component
{
	use WithPagination;
    public $sponser;

    public function mount(Sponser $sponser, $slug){
    	$this->sponser = $sponser;
    }

    public function render()
    {
        $events       = $this->sponser->events()->paginate(2);
        $recent_event = $this->sponser->events()
                                        ->latest()
                                        ->first();
        return view('livewire.user.sponsers.show', [
        		'sponser'       => $this->sponser,
                'events'        => $events,
                'recent_event'  => $recent_event,
        		'events_count'  => $events->total(),
        	]);
    }
}
