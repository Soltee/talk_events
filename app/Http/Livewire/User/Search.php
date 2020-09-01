<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Category;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class Search extends Component
{
	use WithPagination;
    protected $updatesQueryString = ['category_id'];

	public $keyword          = '';
	public $category_id      = '';
	public $category         = '';
	public $categories       = [];
    public $onpage           = false;

	public function mount(){
		if(!request()->keyword){
			return redirect()->to('/event');
		}

		$this->keyword       = request()->keyword;
		$this->category_id   = request()->category;
		if($this->category_id){
    		$this->category      = Category::findOrfail($this->category_id);
    	}

		$this->categories    = Category::latest()->take(10)->get();
	}


    public function render()
    {
    	// dd($this->categories);
    	// if($thi)
    	$paginate       	 = Event::latest()
		                		->where('category_id' , $this->category_id)
		                		->where('title' ,   'LIKE', '%'. $this->keyword .'%')
		                		->with('category')
				                ->paginate(2)
				                ->appends(request()->query());

        return view('livewire.user.search', [
        	'events'         => $paginate,
        	'total'          => $paginate->total(),
        	'first'          => $paginate->firstItem(),
        	'last'           => $paginate->lastItem(),
        	'categories'     => $this->categories,
        	'category'       => $this->category,
        ]);
    }




}

