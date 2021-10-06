<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class Search extends Component
{
	use WithPagination;

	public $keyword          = '';
	public $category         = '';
	public $categories       = [];

	public function mount(){
		$this->keyword       = request()->keyword;
		$this->category   = request()->category;
		$this->categories    = Category::latest()->take(10)->get();
	}


    public function render()
    {
        $query               = Event::latest();
        if($this->category){
        	$query  = $query
	            		->where('category_id' , $this->category);
            $this->goToPage(1);
        }

        if($this->keyword){
        	$query  = $query
        				->where('title' ,   'LIKE', '%'. $this->keyword .'%');
            $this->goToPage(1);
        }
    	$paginate   = $query	            		
	            		->with('category')
	            		->get();
		                // ->paginate(4)
		                // ->appends(request()->query());

        return view('livewire.user.search', [
        	'events'         => $paginate,
        	'total'          => $paginate->count(),
        	// 'total'          => $paginate->total(),
        	// 'first'          => $paginate->firstItem(),
        	// 'last'           => $paginate->lastItem(),
        	'categories'     => $this->categories,
        	'category'       => $this->category,
        ])
            ->extends('layouts.user')
            ->section('content');
    }

    


}

