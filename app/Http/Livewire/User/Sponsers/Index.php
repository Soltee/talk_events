<?php

namespace App\Http\Livewire\User\Sponsers;

use Livewire\Component;
use App\Sponser;
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
    	$query = Sponser::latest();

        if($this->keyword){
    		$query = $query
                    ->where('full_name', 'LIKE', '%'. $this->keyword . '%');
            $this->goToPage(1);

        }

    	$sponsers		= $query
                            ->with([
                                'events' => function($query)
                                    {
                                        $query->select('title', 'price');
                                     }
                              	])
    						->paginate(8);

        $first    = $sponsers->firstItem();
        $last     = $sponsers->lastItem();
        $total    = $sponsers->total();

        return view('livewire.user.sponsers.index', [
        		'sponsers'     => $sponsers,
        		'first'        => $first,
        		'last'         => $last,
        		'total'        => $total
        	]);
    }
}
