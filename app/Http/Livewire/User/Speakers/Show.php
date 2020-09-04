<?php

namespace App\Http\Livewire\User\Speakers;

use Livewire\Component;
use App\Speaker;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public $speaker;

    public function mount(Speaker $speaker, $slug, $last){
    	$this->speaker = $speaker;
    }

    public function render()
    {
        $events       = $this->speaker->events()->paginate(2);
        $recent_event = $this->speaker->events()
                                        ->latest()
                                        ->first();
        return view('livewire.user.speakers.show', [
        		'speaker'       => $this->speaker,
                'events'        => $events,
                'recent_event'  => $recent_event,
        		'events_count'  => $events->total(),
        	]);
    }
}
