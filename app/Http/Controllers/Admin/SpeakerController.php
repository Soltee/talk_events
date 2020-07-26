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
use Spatie\QueryBuilder\allowedIncludes;
use Spatie\QueryBuilder\AllowedInclude;

class SpeakerController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
        abort_if(auth()->user()->hasRole('user'), 403);
    }

    /**
		* Speakers Lists
    */
    public function index()
    {
        $query = Speaker::withCount('events');

        $query = QueryBuilder::for($query)
                ->latest()
                ->allowedFilters(
                    [
                        'first_name',
                        'last_name', 
                        'email'
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
            'user_id'           => auth()->user()->id,
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
        // $new  = Speaker::findOrfail($speaker->id);
        // dd($speaker->events);
         (new SpeakerAdded($speaker->events))
                ->toMail($speaker->email);
        // Notification::send($speaker, new SpeakerAdded($speaker->events));

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
        $new_events    = Event::latest()->get();
        return view('admin.speakers.edit', compact('speaker', 'events', 'new_events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speaker $speaker)
    {
        // dd($request->all());
        abort_if(!auth()->user()->can('update speakers'), 403);

        $data = $request->validate([
            'events'              => 'nullable|array',
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'email'               =>  'required|email', 
            'avatar'              => 'nullable|image', 
            'about'               => 'nullable', 
            'twitter_link'        => 'nullable|string', 
            'linkedin_link'       => 'nullable|string',  
        ]);


        // dd(request()->all());
        if($request->hasFile('avatar')){

            // dd($file);
            //Real Image;
            if($speaker->avatar){
                File::delete([
                    public_path($speaker->avatar)
                ]); 
            }
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

            $avatarArr = ['avatar' => $path];

            
        }

        if($data['linkedin_link']){
            $linkedin_link = ['linkedin_link' => $data['linkedin_link']];
        }

        // dd($avatarArr);
        $speaker->update(array_merge([
            'user_id'           => auth()->user()->id,
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'], 
            'about'             => $data['about'], 
            'twitter_link'      => $data['twitter_link'],      
        ], 
            $avatarArr ?? [],
            $linkedin_link ?? []
        ));
        
        if($data['events']){
            $speaker->events()->sync($data['events']);
        }

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
        // $speaker->events()->detach();

        $speaker->delete();
        return redirect()->back()->with('success', 'Speaker deleted.');
    }
}
