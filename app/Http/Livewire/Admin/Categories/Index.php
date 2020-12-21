<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use App\Category;
use Auth;
use Cache;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Index extends Component
{
	use WithPagination, WithFileUploads;
	protected $queryString = ['user_id', 'name', 'created_at'];
    public $cover             = '';
    public $category_name     = '';
    public $user_id           = '';
    public $name              = '';
    public $created_at        = '';

    public $message           = '';
    public $status            = false;


    public function render()
    {
    	if($this->name){
            $paginate   = Category::latest()
                        ->where('name' ,   'LIKE', '%'. $this->name .'%')
                        ->with(['user'])
                        ->withCount('events')
                        ->paginate(3)
                        ->appends(request()->query());

        } elseif ($this->created_at) {

            $paginate   = Category::latest()
                        ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                        ->with(['user'])
                        ->withCount('events')
                        ->paginate(3)
                        ->appends(request()->query());
        } else {

        	$paginate   = Category::latest()
                            ->with(['user'])
                            ->withCount('events')
                            ->paginate(3)
                            ->appends(request()->query());
        }

        return view('livewire.admin.categories.index', [
        		'categories'   => $paginate,
	            'first'        => $paginate->firstItem(),
	            'last'         => $paginate->lastItem(),
	            'total'        => $paginate->total()
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

    /*Store*/
    public function store(){
    	$data = $this->validate([
    		'category_name' => 'required|string',
    		'cover'         => 'required|image|max:2048'
    	]);

        $cover = $this->cover->store('categories', 'public');
        $cover = '/storage/' . $cover;
    	auth()->user()->category()->create([
    		'name'           => $data['category_name'],
    		'slug'           => Str::slug($data['category_name']),
    		'image_url'      => $cover,
    		'thumbnail'      => $cover
    	]);

    	$this->status = true;
        $this->message = 'Category added.';

        $this->cover = '';
        $this->category_name = '';

    }


    /* Remove the Category */
    public function drop($category){
    	// dd($category);
    	$category = Category::findOrfail($category);
    	$category->events->each(function($event){
    		return $event->delete();
    	});

    	if($category->image_url){
    		Storage::delete($category->image_url);
    	}

    	$category->delete();
        $this->status = true;
        $this->message = $category->name .' deleted.';
    }
}
