<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Sponser;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\allowedIncludes;
use Spatie\QueryBuilder\AllowedInclude;

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

        $query = QueryBuilder::for(Sponser::class)
                ->allowedFilters(
                    [
                        'full_name',
                        'email',
                        'company_name'
                    ])
                ->allowedIncludes([
                    'event', 
                    AllowedInclude::count('eventCount'), // only allows include the number of `friends()` related models
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

     /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add sponsers'), 403);

        $data = $request->validate([
            'avatar'              => 'required|image', 
            'full_name'          => 'required|string|min:2',
            'event_id'            =>  'required|int', 
            'email'               =>  'required|email', 
            'about'               => 'nullable|string', 
            'company_name'        => 'nullable|string', 
            'company_link'        => 'nullable|string', 
        ]);


        // dd($request->file('avatar'));
        if($request->hasFile('avatar')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $images      = $request->file('avatar'); 
            foreach($images as $file){
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);
                abort_if(!$check, 422);
            }

            if(! is_dir(public_path('/sponsers'))){
                mkdir(public_path('/sponsers'), 0777);
            }


            // echo "Run";
            $basename  = Str::random();
            $original  = 'sp-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/sponsers'), $original);
            $path = 'sponsers/' . $original;            
        }

        $sponser = auth()->user()->sponser->create([
            'event_id'          => $data['event_id'],
            'full_name'        => $data['full_name'],
            'email'             => $data['email'], 
            'avatar'             => $data['avatar'], 
            'about'             => $data['about'], 
            'company_name'      => $data['company_name'], 
            'company_link'      => $data['company_link'], 
        ]);

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
        $events        = $sponser->event;
        return view('admin.events.view', compact('sponser', 'events'));
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

        $events        = $sponser->event;
        return view('admin.events.edit', compact('sponser', 'events'));
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
        abort_if(!auth()->user()->can('update sponsers'), 403);

        $data = $request->validate([
            'avatar'              => 'required|image', 
            'full_name'          => 'required|string|min:2',
            'event_id'            =>  'required|int', 
            'email'               =>  'required|email', 
            'about'               => 'nullable|string', 
            'company_name'        => 'nullable|string', 
            'company_link'        => 'nullable|string', 
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

            if(! is_dir(public_path('/sponsers'))){
                mkdir(public_path('/sponsers'), 0777);
            }



            // echo "Run";
            $basename  = Str::random();
            $original  = 'sp-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/sponsers'), $original);
            $path = 'sponsers/' . $original;  

            //Delete Prev File
            if($sponser->avatar){
                File::delete([
                    public_path($sponser->avatar)
                ]);  
            }        
        }

        // dd($request->all());
        $sponser = $sponser->update([
            'event_id'          => $data['event_id'],
            'full_name'        => $data['full_name'],
            'email'             => $data['email'], 
            'avatar'             => $data['avatar'], 
            'about'             => $data['about'], 
            'company_name'      => $data['company_name'], 
            'company_link'      => $data['company_link'],      
        ]);

        return redirect()->back()->with('success', 'Sponser updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sponser $sponser)
    {
        abort_if(!auth()->user()->can('delete sponsers'), 403);

        if($sponser->avatar){
            File::delete([
                public_path($sponser->avatar)
            ]);
        }

        $sponser->delete();
        return redirect()->back()->with('success', 'Sponser deleted.');
    }
}
