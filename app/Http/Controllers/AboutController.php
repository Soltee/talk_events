<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //*Cookie Policy*/
    public function cookiePolicy(){
    	return view('about.cookie-policy');
    }

    //*Privacy Policy*/
    public function privacyPolicy(){
    	return view('about.privacy-policy');
    }

    //*Faqs*/
    public function faqs(){
    	return view('about.faqs');
    }

    //*About*/
    public function contactUs(){
    	return view('about.contact-us');
    }

    //*Terms & Conditions*/
    public function termsConditions(){
    	return view('about.terms-conditions');
    }
}
