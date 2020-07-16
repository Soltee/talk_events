<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Speaker;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $search = request()->keyw;

        $query = Speaker::latest();

        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%');
        }

        $paginate = $query->paginate(9);
        $speakers   = $paginate->items();
        $total    = $paginate->total();
        $first    = $paginate->firstItem();
        $last     = $paginate->lastItem();
        $previous     = $paginate->appends(request()->input())->previousPageUrl();
        $next     = $paginate->appends(request()->input())->nextPageUrl();
        return view('admin.speakers.index', compact('speakers', 'total', 'first', 'last', 'previous', 'next'));
    }

     /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

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

            if(! is_dir(public_path('/speakers'))){
                mkdir(public_path('/speakers'), 0777);
            }


            // echo "Run";
            $basename  = Str::random();
            $original  = 'sp-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/speakers'), $original);
            $path = 'speakers/' . $original;            
        }

        $speaker = auth()->user()->speaker->create([
            'event_id'          => $data['event_id'],
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'], 
            'avatar'             => $data['avatar'], 
            'about'             => $data['about'], 
            'twitter_link'      => $data['twitter_link'], 
        ]);

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
        abort_if(!auth()->user()->hasRole('manager'), 403);
        $events        = $speaker->event;
        return view('admin.events.view', compact('speaker', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Speaker $speaker)
    {
        abort_if(!auth()->user()->hasRole('manager'), 403);

        $events        = $speaker->event;
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
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

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
        abort_if(!auth()->user()->hasRole('manager'), 403);

        File::delete([
            public_path($speaker->avatar)
        ]);

        $speaker->delete();
        return redirect()->back()->with('success', 'Speaker deleted.');
    }
}
