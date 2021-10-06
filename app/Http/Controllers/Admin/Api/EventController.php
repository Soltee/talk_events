<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
    	abort_if(!auth()->user()->can('add speakers'), 403);
        $query = Event::latest()
                    ->paginate(10)
                    ->transform(function ($event) {
                        return [
                            'id'      => $event->id,
                            'name'    => $event->title
                        ];
                    });
    	return response()->json([
    		'events' => $query
    	], 200);
    }
}
