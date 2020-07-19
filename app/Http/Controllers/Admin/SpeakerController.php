<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Speaker;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SpeakerAdded;

class SpeakerController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
		* Speakers Lists
    */
    public function index()
    {

        $query = QueryBuilder::for(Speaker::class)
                ->latest()
                ->allowedFilters(
                    [
                        'first_name',
                        'last_name', 
                        'email', 
                        // AllowedFilter::exact('title'),  
                        // AllowedFilter::scope('starts_at')
                    ])
                ->allowedSorts(['first_name', 'email', 'created_at'])
                ->paginate(10)
                ->appends(request()->query());

        $speakers     = $query->items();
        $total        = $query->total();
        $first        = $query->firstItem();
        $last         = $query->lastItem();
        $previous     = $query->previousPageUrl();
        $next         = $query->nextPageUrl();
        return view('admin.speakers.index', compact('speakers', 'total', 'first', 'last', 'previous', 'next'));
    }


    /*
        * Create Speaker view
    */
    public function create()
    {
        $events = Event::latest()->get();
        return view('admin.speakers.create', compact('events'));
    }

     /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add speakers'), 403);
        // dd(request()->all());

        $data = $request->validate([
            'events'              => 'required|array',
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'email'               =>  'required|email|unique:speakers', 
            'avatar'              => 'nullable|image', 
            'about'               => 'nullable', 
            'twitter_link'        => 'nullable|string', 
            'linkedin_link'       => 'nullable|string',  
        ]);


        // dd(request()->all());
        if($request->hasFile('avatar')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $file      = $request->file('avatar'); 
            // // foreach($files as $file){
            $filename  = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $check     = in_array($extension, $allowedfileExtension);
            abort_if(!$check, 422);

            if(!is_dir(public_path('/speakers'))){
                mkdir(public_path('/speakers'), 0777);
            }

            // dd($file);
            //Real Image;
            $basename  = Str::random();
            $original  = 'speaker-' . $basename . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/speakers'), $original);
            $path = '/speakers/' . $original;  

        }

        if($data['linkedin_link']){
            $linkedin_link = ['linkedin_link' => $data['linkedin_link']];
        }

        $speaker = Speaker::create(array_merge([
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'], 
            'avatar'             => $path, 
            'about'             => $data['about'], 
            'twitter_link'      => $data['twitter_link'], 
        ]),
            $linkedin_link ?? []
        );

        $events = $speaker->events()->attach($data['events']);

        // dd($events);
        // Notification::send($speaker, new SpeakerAdded($events));

        return back()->with('success', 'Speaker created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Speaker $speaker)
    {
        abort_if(!auth()->user()->can('view speakers'), 403);
        $events        = $speaker->events;
        $count_events  = $events->count();
        // dd($events);
        return view('admin.speakers.show', compact('speaker', 'events', 'count_events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Speaker $speaker)
    {
        abort_if(!auth()->user()->can('update speakers'), 403);

        $events        = $speaker->events;
        return view('admin.events.edit', compact('speaker', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // dd($request->all());
        abort_if(!auth()->user()->can('update speakers'), 403);

        $data = $request->validate([
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'event_id'            =>  'required|int', 
            'email'               =>  'required|email', 
            'avatar'              => 'required|image', 
            'about'               => 'nullable|string', 
            'twitter_link'        => 'nullable|string', 
            'about'               => 'nullable|string',  
        ]);
    
        
        if($request->hasFile('avatar')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $images      = $request->file('avatar'); 
            foreach($images as $file){
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);
                abort_if(!$check, 422);
            }

            if(! is_dir(public_path('/speakers'))){
                mkdir(public_path('/speakers'), 0777);
            }



            // echo "Run";
            $basename  = Str::random();
            $original  = 'sp-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/speakers'), $original);
            $path = 'speakers/' . $original;  

            //Delete Prev File
            File::delete([
                public_path($speaker->avatar)
            ]);          
        }

        // dd($request->all());
        $speaker = $speaker->update([
            'event_id'          => $data['event_id'],
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'], 
            'avatar'             => $data['avatar'], 
            'about'             => $data['about'], 
            'twitter_link'      => $data['twitter_link'],      
        ]);

        return redirect()->back()->with('success', 'Speaker updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speaker $speaker)
    {
        abort_if(!auth()->user()->can('delete speakers'), 403);

        if($speaker->avatar){
            File::delete([
                public_path($speaker->avatar)
            ]);
        }
        $speaker->events()->detach();

        $speaker->delete();
        return redirect()->back()->with('success', 'Speaker deleted.');
    }
}
