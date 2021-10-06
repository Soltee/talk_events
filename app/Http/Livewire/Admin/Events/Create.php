<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use App\Models\Category;
use App\Models\Speaker;
use App\Models\Sponser;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

	public $sponsers = [];
	public $speakers = [];
	public $category;
	public $title;
	public $sub_title;
	public $cover;
	public $price;
	public $start;
	public $time;
	public $end;
	public $book_before;
	public $ticket;
	public $description;
	public $venue_name;
    public $venue_full_address;

    public $modal = false;
    public $status;

	public function mount(){
		abort_if(!auth()->user()->can('add events'), 403);

	}

    public function render()
    {
    	$categories         = Category::latest()->get();
        $new_speakers       = Speaker::latest()->get();
        $new_sponsers       = Sponser::latest()->get();
        return view('livewire.admin.events.create', [
        		'categories'        => $categories,
        		'new_speakers'      => $new_speakers,
        		'new_sponsers'      => $new_sponsers       		
        ])->extends('layouts.admin');
    }

    /** Modal Viibiltyt*/
    public function setVisibility(){
        $this->modal  = !$this->modal;
        $this->status = '';
    }

    /*Create*/
    public function store(){
        // dd($this->description);
    	$data = $this->validate([
            'speakers'            => 'required|array',
            'sponsers'            => 'required|array',
            'title'               => 'required|string|min:2',
            'category'            => 'required|numeric', 
            'cover'               => 'required|file', 
            'sub_title'           => 'required|string', 
            'price'               => 'required|numeric', 
            'start'               => 'required|date', 
            'time'                => 'required', 
            'end'                 => 'required|date', 
            'book_before'         => 'required|date', 
            'ticket'              => 'required|numeric', 
            'description'         => 'required', 
            'venue_name'          => 'required|string', 
            'venue_full_address'  => 'required|string', 
        ]);

        // dd($data);
        $allowedfileExtension = ['jpeg','jpg','png','gif'];
        $file      = $this->cover; 
        // // foreach($files as $file){
        $filename  = $file->getClientOriginalName();

        $extension = $file->getClientOriginalExtension();

        $check     = in_array($extension, $allowedfileExtension);
        abort_if(!$check, 422);
        if(!$check){
            session()->flash('error', 'Image Must be jpg png jpeg.');
        }

        // if(!is_dir(public_path('/events'))){
            // mkdir(public_path('/events'), 0777);
        // }

        // dd($file);
        //Real Image;
        // $basename  = Str::random();
        // $original  = 'ev-' . $basename . '.' . $file->getClientOriginalExtension();
        $original = $file->store('/events', 'public');
        $path = '/storage/events/' . $original;     

        // echo $original . ' ' . $thumbnail;

        $event = Event::create([
            'user_id'             => auth()->user()->id,
            'category_id'         => $this->category,
            'title'               => $this->title,
            'slug'                => Str::slug($this->title),
            'cover'               => $path, 
            'thumbnail'           => $path, 
            'sub_title'           => $this->sub_title, 
            'price'               => $this->price,
            'start'               => $this->start,
            'time'                => $this->time,
            'end'                 => $this->end,
            'book_before'         => $this->book_before,
            'ticket'              => $this->ticket, 
            'description'         => $this->description,
            'venue_name'          => $this->venue_name,
            'venue_full_address'  => $this->venue_full_address       
        ]);

        if($this->speakers){
            $event->speakers()->attach($this->speakers);
        }

        if($this->sponsers){
            $event->sponsers()->attach($this->sponsers);
        }

        $this->modal            = true;
        $this->status           = 'Success';
        // $this->message            = $event->id . 'has been published';
        $this->sponsers         = [];
        $this->speakers         = [];
        $this->category            = '';
        $this->title               = '';
        $this->sub_title           = '';
        $this->cover               = '';
        $this->price               = '';
        $this->start               = '';
        $this->time                = '';
        $this->end                 = '';
        $this->book_before         = '';
        $this->ticket              = '';
        $this->description         = '';
        $this->venue_name          = '';
        $this->venue_full_address  = '';

        // session()->flash('success', $event->id . 'has been added.');

    }
}
