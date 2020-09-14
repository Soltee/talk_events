<?php

namespace App\Http\Livewire\User\Speakers;

use Livewire\Component;
use App\Speaker;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;


class Index extends Component
{
	use WithPagination;
	protected $updatesQueryString = ['keyword'];
    public $keyword = '';

    public function render()
    {
        // $this->renderSpeakerList();
        if($this->keyword){
            $speakers = Speaker::latest()
                        ->where('first_name', 'LIKE', '%'. $this->keyword . '%')
                        ->orWhere('last_name', 'LIKE', '%'. $this->keyword . '%')
                        ->with([
                                'events' => function($query)
                                    {
                                        $query->select('title', 'price');
                                     }
                                ])
                            ->paginate(8);
        } else {
        
            $speakers   = Speaker::latest()->with([
                                'events' => function($query)
                                    {
                                        $query->select('title', 'price');
                                     }
                                ])
                            ->paginate(8);

        }

        $this->totalPages = $speakers->lastPage();

        return view('livewire.user.speakers.index', [
                'speakers'     => $speakers
            ]);
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
