<?php

namespace App\Http\Livewire\User\Sponsers;

use Livewire\Component;
use App\Models\Sponser;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
	protected $queryString = ['keyword'];
    public $keyword = '';

    public function render()
    {
        if($this->keyword){
            $sponsers = Sponser::latest()
                        ->where('full_name', 'LIKE', '%'. $this->keyword . '%')
                        ->with([
                                'events' => function($query)
                                    {
                                        $query->select('title', 'price');
                                     }
                                ])
                            ->paginate(8);
        } else {

        	$sponsers   = Sponser::latest()
                            ->with([
                                'events' => function($query)
                                    {
                                        $query->select('title', 'price');
                                     }
                              	])
    						->paginate(8);

        }

        return view('livewire.user.sponsers.index', [
        		'sponsers'     => $sponsers
        	])
            ->extends('layouts.user')
            ->section('content');
    }

    public function updatedKeyword()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->keyword) {
            $this->keyword = null;
        }

        $this->gotoPage(1);
    }

    /* Fix nextPage/previousPage to disallow overflows */
    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page = $this->page + 1;
        }
    }
}
