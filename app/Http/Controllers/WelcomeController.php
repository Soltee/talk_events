<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
        return Inertia::render('Login', [
				            
        ]);
    }


    /**
     * Show the Events Page
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        return view('events');
    }

    /**
     * Show the single Event page
     *
     * @return \Illuminate\Http\Response
     */
    public function event()
    {
        return view('event');
    }
}
