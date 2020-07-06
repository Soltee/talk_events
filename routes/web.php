<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'WelcomeController@index')->name('welcome');

/** Login & Register */
Route::get('/login', 'WelcomeController@login')->name('login');

/** User */
// Auth::routes();
Route::post('/events/{event_id}/book', "User\BookingController@store")->name('event.book');
Route::get('/home', 'User\HomeController@index')->name('home');

/** Company */
Route::prefix('company')->group(function () {
	Route::get('/dashboard', 'Company\HomeController@index')->name('company.home');
});