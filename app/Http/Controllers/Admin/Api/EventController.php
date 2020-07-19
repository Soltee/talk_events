<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
    	abort_if(!auth()->user()->can('add speakers'), 403);
        $query = Event::latest()
                    // ->filter(Request::only('search', 'role', 'trashed'))
                    ->paginate(10)
                    // ->only(['id', 'title']);
                    ->transform(function ($event) {
                        return [
                            'id'      => $event->id,
                            'name'    => $event->title
                        ];
                    });
    	return response()->json([
    		'events' => $query
    		// 'next'   => $query->nextPageUrl(),
    		// 'prev'   => $query->previousPageUrl()
    	], 200);
    }
}
