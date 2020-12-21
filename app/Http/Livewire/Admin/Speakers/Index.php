<?php

namespace App\Http\Livewire\Admin\Speakers;

use Livewire\Component;
use App\Speaker;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $updatesQueryString = ['name', 'email', 'created_at'];
    public $name     = '';
    public $email          = '';
    public $created_at     = '';
    public $message      = '';
    public $status       = false;

    public function render()
    {

        if($this->name) {
        	$paginate = Speaker::latest()
        				->where('first_name' ,   'LIKE', '%'. $this->name .'%')
                        ->orWhere('last_name' ,   'LIKE', '%'. $this->name .'%')
                        ->paginate(10)
                        ->appends(request()->query());
        } elseif ($this->email) {
            
            $paginate  =  Speaker::latest()
                            ->where('email' ,   'LIKE', '%'. $this->email .'%')
                            
                            ->paginate(10)
                            ->appends(request()->query());
        } elseif ($this->created_at) {
            
            $paginate  =  Speaker::latest()
                            ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                            ->paginate(10)
                            ->appends(request()->query());
        } else {
        
            $paginate  =  Speaker::latest()                            
                            ->paginate(10)
                            ->appends(request()->query());
        }

        return view('livewire.admin.speakers.index', [
            'speakers'     => $paginate
        ])->extends('layouts.admin');

    }

    public function updatedName()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->name) {
            $this->name = null;
        }

        $this->gotoPage(1);
    }

    public function updatedEmail()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->email) {
            $this->email = null;
        }

        $this->gotoPage(1);
    }

    public function updatedCreated_at()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->created_at) {
            $this->created_at = null;
        }

        $this->gotoPage(1);
    }

    /**Close*/
    public function close(){
        $this->status  = false;
        $this->message = '';
    }

    /* Remove the Speaker */
    public function drop($speaker){
    	// dd($speaker);
    	$speaker = Speaker::findOrfail($speaker);
        // dd($speaker->first_name);
    	$speaker->delete();
        $this->status = true;
        $this->message = $speaker->first_name .' deleted.';
    }
}
