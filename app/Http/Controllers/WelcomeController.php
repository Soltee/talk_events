<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Category;
use App\Speaker;
use Cache;

class WelcomeController extends Controller
{

    /**
     * Show the site landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $query_category   = Cache::remember('query_category', now()->addMinutes(3), function() {
            return Category::latest()->take(10)->get();
        });

        $query_events     =  Event::latest();
       

        $trending         = Cache::remember('trending', now()->addMinutes(3), function() use ($query_events) {
            return $query_events
                                ->with('bookings')
                                ->take(6)->get();
        });

        $trending_total   = Cache::remember('trending_total', now()->addMinutes(3), function() use ($trending) {
            return $trending->count();
        });

        $today_events   = Cache::remember('today_events', now()->addMinutes(3), function() use ($query_events) {
            return $query_events->where('start', '>', now())->take(30)->get();
        });

        $free   = Cache::remember('free', now()->addMinutes(3), function() use ($query_events) {
            return $query_events->where('is_paid', false)->take(30)->get();
        });

        $free_total   = Cache::remember('free_total', now()->addMinutes(3), function() use ($free) {
            return $free->count();
        });

        $this_weekend  = Cache::remember('this_weekend', now()->addMinutes(3), function() use ($query_events) {
            return $query_events->where('start', '>', now()->addDays(70))->take(8)->get();
        });

        $this_weekend_total   = Cache::remember('free_total', now()->addMinutes(3), function() use ($this_weekend) {
            return $this_weekend->count();
        });

        // $featured  = Cache::remember('this_weekend', now()->addMinutes(3), function() {
        //     return Event::inRandomOrder()->where('is_featured', true)->first();
        // });

        $speakers      = Cache::remember('speakers', now()->addMinutes(3), function() {
            return Speaker::latest()->take(10)->get();
        });

        $speakers_total   = Cache::remember('speakers_total', now()->addMinutes(3), function() use ($speakers) {
            return $speakers->count();
        });

        //popular, online, free, paid, today, tomorrow, this_weekend, online_classes, more categoies, trending
        return view('welcome', compact(
                                'trending', 
                                'trending_total', 
                                'today_events', 
                                'this_weekend', 
                                'this_weekend_total', 
                                'free', 
                                'free_total', 
                                'query_category',
                                'speakers',
                                'speakers_total'
                            ));
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

        
        if($category){
            $category = Category::findOrfail($category);
            $query    = $query->where('category_id', $category->id);
        }

        if($search){
            $query    = $query->where('title', 'LIKE', '%'. $search .'%')
                            ->orWhere('venue_name', 'LIKE', '%'. $search .'%')
                            ->orWhere('price', 'LIKE', '%'. $search .'%'); 
        }

        if($type){
            if($type == 'both'){

            } elseif($type == 'free'){
                $query    = $query->where('price', 0); 
            } else {
                $query    = $query->where('price', '>', $type); 
            }
        }

        // $categories = Cache::remember('categories', now()->addMinutes(3), function() {
        //     return Category::latest()->get();
        // });

        // $events     = Cache::remember('events', now()->addMinutes(3), function() use ($query) {
        //     return $query->paginate(10);
        // });

        // $count      = Cache::remember('count', now()->addMinutes(3), function() use ($events) {
        //     return $events->total();
        // });

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

        $similar = Cache::remember('similar', now()->addMinutes(3), function() use ($event){
            return $event->category->events()->inRandomOrder()->where('id', '!=' , $event->id)->take(6)->get();
        });

        $similar_count   = Cache::remember('similar_count', now()->addMinutes(3), function() use ($similar) {
            return $similar->count();
        });


        // dd(count($sponsers));
        return view('event', compact('venue', 'cat', 'event', 'speakers', 'sponsers', 'similar', 'similar_count'));
    }
}
