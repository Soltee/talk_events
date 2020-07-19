<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Sponser;
use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\allowedIncludes;
use Spatie\QueryBuilder\AllowedInclude;
use Illuminate\Support\Facades\Notification;


class SponserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
        * sponsers Lists
    */
    public function index()
    {

        $query = Sponser::withCount('events');
        $query = QueryBuilder::for($query)
                ->latest()
                ->allowedFilters(
                    [
                        'full_name',
                        'email',
                        'company_name'
                    ])
                ->allowedIncludes([
                    'events', 
                    AllowedInclude::count('eventsCount'), // only allows include the number of `friends()` related models
                ])
                ->allowedSorts(['full_name', 'email', 'company_name', 'created_at'])
                ->paginate(8)
                ->appends(request()->query());

        
        \Debugbar::info($query);
        $sponsers   = $query->items();
        $total      = $query->total();
        $first      = $query->firstItem();
        $last       = $query->lastItem();
        $previous     = $query->previousPageUrl();
        $next       = $query->nextPageUrl();
        return view('admin.sponsers.index', compact('sponsers', 'total', 'first', 'last', 'previous', 'next'));
    }

    /*
        * Create Sponsers view
    */
    public function create()
    {
        $events = Event::latest()->get();
        return view('admin.sponsers.create', compact('events'));
    }

     /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add sponsers'), 403);

        $data = $request->validate([
            'events'              => 'required|array', 
            'avatar'              => 'required|image', 
            'full_name'           => 'required|string|min:2',
            'email'               =>  'required|email', 
            'about'               => 'nullable|string', 
            'company_name'        => 'nullable|string', 
            'company_link'        => 'nullable|string', 
        ]);


        // dd($request->file('avatar'));
        if($request->hasFile('avatar')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $file      = $request->file('avatar'); 
            // // foreach($files as $file){
            $filename  = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $check     = in_array($extension, $allowedfileExtension);
            abort_if(!$check, 422);

            if(!is_dir(public_path('/sponsers'))){
                mkdir(public_path('/sponsers'), 0777);
            }

            // dd($file);
            //Real Image;
            $basename  = Str::random();
            $original  = 'sponser-' . $basename . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/sponsers'), $original);
            $path = '/sponsers/' . $original;  

        }

        $sponser = Sponser::create([
            'user_id'           => auth()->user()->id,
            'full_name'         => $data['full_name'],
            'email'             => $data['email'], 
            'avatar'            => $path, 
            'about'             => $data['about'], 
            'company_name'      => $data['company_name'], 
            'company_link'      => $data['company_link'], 
        ]);

        $sponser->events()->attach($data['events']);

        return back()->with('success', 'Sponser created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sponser $sponser)
    {
        abort_if(!auth()->user()->can('view sponsers'), 403);
        $events        = $sponser->events;
        $count_events  = count($events);
        return view('admin.sponsers.show', compact('sponser', 'events', 'count_events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponser $sponser)
    {
        abort_if(!auth()->user()->can('update sponsers'), 403);

        $events  =  $sponser->events;
        $more_events = Event::latest()->get();
        return view('admin.sponsers.edit', compact('sponser', 'events', 'more_events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponser $sponser)
    {
        // dd($request->all());
        abort_if(!auth()->user()->can('update sponsers'), 403);

        $data = $request->validate([
            'events'              => 'nullable|array', 
            'avatar'              => 'nullable|image', 
            'full_name'           => 'required|string|min:2',
            'email'               =>  'required|email', 
            'about'               => 'nullable|string', 
            'company_name'        => 'nullable|string', 
            'company_link'        => 'nullable|string', 
        ]);

        // dd($request->file('avatar'));
        if($request->hasFile('avatar')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $file      = $request->file('avatar'); 
            // // foreach($files as $file){
            $filename  = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $check     = in_array($extension, $allowedfileExtension);
            abort_if(!$check, 422);

            if(!is_dir(public_path('/sponsers'))){
                mkdir(public_path('/sponsers'), 0777);
            }   


            if($sponser->avatar){
                File::delete([
                    public_path($sponser->avatar)
                ]);
            }

            // dd($file);
            //Real Image;
            $basename  = Str::random();
            $original  = 'sponser-' . $basename . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/sponsers'), $original);
            $path = '/sponsers/' . $original;  

            $avatarArr = ['avatar' => $path];
        }



        // dd($avatarArr);
        $sponser->update(array_merge([
            'user_id'           => auth()->user()->id,
            'full_name'         => $data['full_name'],
            'email'             => $data['email'], 
            'about'             => $data['about'], 
            'company_name'      => $data['company_name'],      
            'company_link'      => $data['company_link'],      
        ], 
            $avatarArr ?? [],
            $linkedin_link ?? []
        ));
        
        if($data['events']){
            $sponser->events()->sync($data['events']);
        }

        return redirect()->back()->with('success', 'Sponser updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponser $sponser)
    {
        abort_if(!auth()->user()->can('delete sponsers'), 403);

        if($sponser->avatar){
            File::delete([
                public_path($sponser->avatar)
            ]);
        }

        // $sponser->events()->detach();

        $sponser->delete();
        return redirect()->back()->with('success', 'Sponser deleted.');
    }
}
