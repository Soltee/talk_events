<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sponser;
use App\Models\Event;
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

    /*
        * Create Sponsers view
    */
    public function create()
    {
        abort_if(!auth()->user()->can('add sponsers'), 403);
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

            
            $basename  = Str::random();
            $original  = 'sponser-' . $basename . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/sponsers'), $original);
            $path = '/sponsers/' . $original;  

            $avatarArr = ['avatar' => $path];
        }



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

}
