<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        abort_if(auth()->user()->hasRole('user'), 403);
    }

    /**
     * Show the company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paginate = Event::latest()->paginate(10);
        $permissions = Permission::latest()->get();
        // auth()->user()->
        return view('admin.dashboard', compact('permissions'));
        // return Inertia::render('Company/Dashboard', [
        //     'events' => $paginate->items(),
        //     'prev'   => $paginate->previousPageUrl(),
        //     'next'   => $paginate->nextPageUrl(),
        // ]);
    }
}
