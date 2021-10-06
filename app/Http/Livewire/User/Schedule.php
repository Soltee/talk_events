<?php

namespace App\Http\Livewire\User;

use App\Models\Event;
use Livewire\Component;

class Schedule extends Component
{
    public function mount()
    {

    }

    public function render()
    {
    	// dd('jjj');
        return view('livewire.user.schedule', [
        	'events' => Event::select('id', 'title', 'start')->get(),
        ])
            ->extends('layouts.user')
            ->section('content');
    }
}
