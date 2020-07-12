<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $search = request()->keyw;

        $query = Event::latest();

        if($search){
            $query = $query->where('title', 'LIKE', '%'.$search.'%')
                            ->orWhere('price', 'LIKE', '%'.$search.'%')
                            ->orWhere('venue_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('ticket', 'LIKE', '%'.$search.'%');
                            ->whereDate('end_time', '=', Carbon::today()->toDateString()); 
        }

        $paginate = $query->paginate(9);
        $events   = $paginate->items();
        $total    = $paginate->total();
        $first    = $paginate->firstItem();
        $last     = $paginate->lastItem();
        $previous     = $paginate->appends(request()->input())->previousPageUrl();
        $next     = $paginate->appends(request()->input())->nextPageUrl();
        return view('admin.events.index', compact('events', 'total', 'first', 'last', 'previous', 'next'));
    }


    /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

        $data = $request->validate([
            'title'               => 'required|string|min:2',
            'category_id'         => 'required|int', 
            'cover'               => 'required|image', 
            'sub_title'           => 'required|string', 
            'price'               => 'required|int', 
            'start_time'          => 'required|', 
            'end_time'            => 'required|', 
            'book_before'         => 'required|', 
            'ticket'              => 'required|int', 
            'description'         => 'required', 
            'venue_name'          => 'required|string', 
            'venue_full_address'  => 'required|string', 
            'venue_latitude'      => 'required', 
            'venue_longitude'     => 'required',   
        ]);

        // dd($request->file('cover'));
        if($request->hasFile('cover')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $images      = $request->file('cover'); 
            foreach($images as $file){
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);
                abort_if(!$check, 422);
            }

            if(! is_dir(public_path('/events'))){
                mkdir(public_path('/events'), 0777);
            }


            // echo "Run";
            $basename  = Str::random();
            $original  = 'ev-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/events'), $original);
            $path = 'events/' . $original;            
        }

        $event = auth()->user()->events->create([
            'title'               => $data['title'],
            'category_id'         => $data['category_id'],
            'cover'               => $path, 
            'sub_title'           => $data['sub_title'], 
            'price'               => $data['price'],
            'start_time'          => $data['start_time'],
            'end_time'            => $data['end_time'],
            'book_before'         => $data['book_before'],
            'ticket'              => $data['ticket'], 
            'description'         => $data['description'],
            'venue_name'          => $data['venue_name'],
            'venue_full_address'  => $data['venue_full_address'], 
            'venue_latitude'      => $data['venue_latitude'],
            'venue_longitude'     => $data['venue_longitude']        
        ]);

        return back()->with('success', 'Event created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);
        $cat    = $event->category;
        return view('admin.events.view', compact('event', 'cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);
        $categories = Category::latest()->get();
        $cat        = $event->category;
        return view('admin.events.edit', compact('event', 'categories', 'cat'));
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
            'title'               => 'required|string|min:2',
            'category_id'         => 'required|int', 
            'cover'               => 'required|image', 
            'sub_title'           => 'required|string', 
            'price'               => 'required|int', 
            'start_time'          => 'required|', 
            'end_time'            => 'required|', 
            'book_before'         => 'required|', 
            'ticket'              => 'required|int', 
            'description'         => 'required', 
            'venue_name'          => 'required|string', 
            'venue_full_address'  => 'required|string', 
            'venue_latitude'      => 'required', 
            'venue_longitude'     => 'required',   
        ]);
    
        
        if($request->hasFile('cover')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $images      = $request->file('cover'); 
            foreach($images as $file){
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);
                abort_if(!$check, 422);
            }

            if(! is_dir(public_path('/events'))){
                mkdir(public_path('/events'), 0777);
            }



            // echo "Run";
            $basename  = Str::random();
            $original  = 'ev-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/events'), $original);
            $path = 'events/' . $original;  

            //Delete Prev File
            File::delete([
                public_path($event->cover)
            ]);          
        }

        // dd($request->all());
        $event = $event->update([
            'title'               => $data['title'],
            'slug'                => Str::slug($data['title'],
            'category_id'         => $data['category_id'],
            'cover'               => $path, 
            'sub_title'           => $data['sub_title'], 
            'price'               => $data['price'],
            'start_time'          => $data['start_time'],
            'end_time'            => $data['end_time'],
            'book_before'         => $data['book_before'],
            'ticket'              => $data['ticket'], 
            'description'         => $data['description'],
            'venue_name'          => $data['venue_name'],
            'venue_full_address'  => $data['venue_full_address'], 
            'venue_latitude'      => $data['venue_latitude'],
            'venue_longitude'     => $data['venue_longitude']        
        ]);

        return redirect()->back()->with('success', 'Event updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

        File::delete([
            public_path($event->cover)
        ]);

        $event->delete();
        return redirect()->back()->with('success', 'Event deleted.');
    }
}
