<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/events/{event}-{slug}', 'WelcomeController@event')->name('event');
Route::get('/events', 'WelcomeController@events')->name('events.all');

/** Booking */
Route::get('/events/{event}-{slug}/checkout', 'User\BookingController@index')->name('booking.checkout');
Route::post('/events/{event_id}/book', "User\BookingController@store")->name('event.book');

/** Login & Register */
Route::get('/login', 'WelcomeController@login')->name('login');

/** User */
// Auth::routes();
Route::get('/home', 'User\HomeController@index')->name('home');

/** Company */
Route::prefix('company')->group(function () {
	Route::get('/dashboard', 'Company\HomeController@index')->name('company.home');
});