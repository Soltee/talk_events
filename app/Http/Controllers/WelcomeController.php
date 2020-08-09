<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Category;

class WelcomeController extends Controller
{

    /**
     * Show the site landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query_category   = Category::latest()->take(10)->get();
        $query_events     = Event::latest();
        $trending         = $query_events
                                // ->with(['bookings' => function($query){
                                //     $query->count('')
                                // }])
                                ->take(6)->get();
        $featured         = Event::inRandomOrder()->where('is_featured', true)->first();
        $today_events     = $query_events->where('start', '>', now())->take(30)->get();
        $this_weekend     = $query_events->where('start', '>', now()->addDays(70))->take(8)->get();
        //popular, online, free, paid, today, tomorrow, this_weekend, online_classes, more categoies, trending
        return view('welcome', compact('trending', 'today_events', 'featured', 'this_weekend', 'query_category'));
    }

    /**
     * Show the Events Page
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        $search   = request()->search;
        $category = request()->category;
        $type = request()->type;

        // dd(request()->all());
        $query    = Event::latest();
                    // ->where('is_paid', '0');

        if($search){
            $query    = $query->where('title', 'LIKE', '%'. $search .'%'); 
        }

        if($category){
            $category = Category::findOrfail($category);
            $query    = $query->where('category_id', $category->id);
        }
        if($type){
            if($type == 'free'){
                $query    = $query->where('is_paid', 0); 
            } else {

                $query    = $query->where('is_paid', $type); 
            }
        }

        $categories   =   Category::latest()->get();
        $events       =   $query->paginate(10);
        $count        =   $events->total();
        // abort_if($events->isEmpty(), 204);

        
        return view('events', compact('categories', 'events', 'count', 'category'));
    }

    /**
     * Show the single Event page
     *
     * @return \Illuminate\Http\Response
     */
    public function event(Event $event, $slug)
    {
        $venue    = $event->location;
        $cat      = $event->category;

        $speakers = $event->speakers;
        $sponsers = $event->sponsers;

        $similar  = $event->category->events()->inRandomOrder()->where('id', '!=' , $event->id)->take(6)->get();
        // dd(count($sponsers));
        return view('event', compact('venue', 'cat', 'event', 'speakers', 'sponsers', 'similar'));
    }
}
