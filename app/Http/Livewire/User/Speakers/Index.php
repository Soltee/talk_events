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
        if($this->keyword){
            $this->goToPage(1);
        }
        
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

        $first    = $speakers->firstItem();
        $last     = $speakers->lastItem();
        $total    = $speakers->total();

        return view('livewire.user.speakers.index', [
        		'speakers'     => $speakers,
        		'first'        => $first,
        		'last'         => $last,
        		'total'        => $total
        	]);
    }
}
