<?php

namespace App\Http\Livewire\User;

use App\Event;
use Livewire\Component;

class Schedule extends Component
{
    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.user.schedule', [
        	'events' => Event::select('id', 'title', 'start')->get(),
        ]);
    }
}
