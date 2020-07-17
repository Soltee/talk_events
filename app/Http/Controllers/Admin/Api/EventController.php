<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
    	abort_if(!auth()->user()->can('add events'), 403);
    	$query = Event::latest()->paginate(10);

    	return response()->json([
    		'events' => $query->items(),
    		'next'   => $query->nextPageUrl(),
    		'prev'   => $query->previousPageUrl()
    	], 200);
    }
}
