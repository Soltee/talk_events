<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Category;
use App\Venue;

class WelcomeController extends Controller
{

    /**
     * Show the site landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the user and compnay login page
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
    	// Inertia::setRootView(');
        // return Inertia::render('Login', [
				            
        // ]);
    }


    /**
     * Show the Events Page
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        $search   = request()->search;
        $current = request()->category;

        if($current)
        {
            $current =   Category::findOrfail($current);
            $events =   Event::where('category_id', $current->id)->paginate(9);
            // dd($events);
            $count   = $events->total();
        } else {
            $query      = Event::latest();

            if($search){
                $query = $query->where('name', 'LIKE' , "%".$search."%");
            }

            $events   = $query->paginate(9);
            $count      = $events->total();
        }
            $categories = Category::latest()->paginate(10);
            $venues = Venue::latest()->paginate(10);

        
        return view('events', compact('categories', 'events', 'venues', 'count', 'current'));
    }

    /**
     * Show the single Event page
     *
     * @return \Illuminate\Http\Response
     */
    public function event(Event $event, $slug)
    {
        $venue = $event->location;
        $cat = $event->category;

        $speakers = $event->speakers;

        $similar = $event->category->events()->inRandomOrder()->where('id', '!=' , $event->id)->take(4)->get();
        // dd($product->images);
        return view('event', compact('venue', 'cat', 'event', 'speakers', 'similar'));
    }
}
