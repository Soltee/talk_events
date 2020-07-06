<?php

namespace App\Http\Controllers\Company;

use App\Event;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:company');
    // }

    /**
     * Show the company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = Event::latest()->paginate(10);

        return Inertia::render('Company/Dashboard', [
            'events' => $paginate->items(),
            'prev'   => $paginate->previousPageUrl(),
            'next'   => $paginate->nextPageUrl(),
        ]);
    }
}
