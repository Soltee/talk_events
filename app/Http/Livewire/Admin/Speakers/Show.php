<?php

namespace App\Http\Livewire\Admin\Speakers;

use Livewire\Component;
use App\Models\Speaker;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Show extends Component
{	
	use WithPagination;
    public $speaker;
    public $modal          = false;
    public $status         = false;

    public function mount(Speaker $speaker){
    	$this->speaker = $speaker;
    }

    public function render()
    {
    	$events = $this->speaker->events()->paginate(4);
        return view('livewire.admin.speakers.show', [
        		'speaker'       => $this->speaker,
        		'events'        => $events,
        		'events_count'  => $events->total(),
        ])->extends('layouts.admin');
    }

    /* Set Model Visiibility*/
    public function setVisibility(){
    	$this->modal  = !$this->modal;
        $this->status = '';
    }

    /* Remove the User */
    public function drop($speaker){
    	// dd($speaker);
    	// $speaker = Speaker::findOrfail($speaker);
    	// $speaker->delete();
        $this->status = 'Success';
        session()->flash('success', 'User dropped');
    	return redirect()->to('/admin/speakers');
    }

}
