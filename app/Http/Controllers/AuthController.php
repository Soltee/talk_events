<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
		* Login Page
    */
	public function login()
	{
		return view('auth.login');
	}

	/*
		* Register Page
    */
	public function register()
	{
		return view('auth.register');
	}
}
