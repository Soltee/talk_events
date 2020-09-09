<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index')
				                        ->name('welcome');
Route::get('/events/{event}-{slug}', 'WelcomeController@event')
										->name('event');
Route::get('/event', 'WelcomeController@events')
										->name('events.all');

/*About Site*/
Route::get('/help/cookie-policy', 'AboutController@cookiePolicy')
									->name('cookie-policy');
Route::get('/help/privacy-policy', 'AboutController@privacyPolicy')
									->name('privacy-policy');
Route::get('/help/faqs', 'AboutController@faqs')
									->name('faqs');		
Route::get('/help/contact-us', 'AboutController@contactUs')
									->name('contact-us');
									
Route::get('/help/terms-conditions', 'AboutController@termsConditions')
									->name('terms-conditions');																

/*Livewire*/
Route::livewire('/events/schedules', 'user.schedule')
									->name('calender');

Route::livewire('/events/search', 'user.search')
									->name('search.events');

/*Speakers*/
Route::livewire('/speaker', 'user.speakers.index')
						->name('user.speakers');

Route::livewire('/speakers/{speaker}-{slug}-{last}', 'user.speakers.show')
						->name('user.speakers.show');


/*Sponsers*/
Route::livewire('/sponser', 'user.sponsers.index')
						->name('user.sponsers');

Route::livewire('/sponsers/{sponser}-{slug}', 'user.sponsers.show')
						->name('user.sponsers.show');
										
/** Login & Register */
Route::livewire('/login', 'user.login')
					->name('login');
Route::livewire('/register', 'user.register')
					->name('register');

/** User */
// Auth::routes();
Route::group(['middleware' => ['role:user']], function () {
    Route::livewire('/home', 'user.auth.dashboard')
    					->name('home');

	//Profile
	Route::livewire('/profile', 'user.auth.profile')
								->name('profile');

	//Booking
	Route::livewire('/bookings/{book}', 'user.bookings.booking');

});


/** Admin Dashboard */
Route::group(['prefix' => 'admin', 'layout' => 'layouts.admin'] , function () {
	/* Before Authenctication*/
	Route::livewire('login', 'admin.login')
						->section('login-content')
						->name('admin.login');

	
	//Dashboard
	Route::livewire('dashboard', 'admin.dashboard')
							->middleware('auth')
							->name('admin.dashboard');


	//Category
	Route::group(['middleware' => ['permission:add categories']], function () {
		Route::livewire('categories', 'admin.categories.index')
												->name('categories');
	});

	

	//Speakers
	Route::group(['middleware' => ['permission:add speakers']], function () {
		Route::livewire('speakers', 'admin.speakers.index')
											->name('speakers');
		Route::livewire('speakers/{speaker}', 'admin.speakers.show')
											->name('speaker.show');

		Route::get('speaker/create', 'Admin\SpeakerController@create')
											->name('speaker.create');
		Route::get('speakers/{speaker}/edit', 'Admin\SpeakerController@edit')
											->name('speaker.edit');
		Route::post('speaker', 'Admin\SpeakerController@store')
											->name('speaker.store');
		Route::patch('speakers/{speaker}', 'Admin\SpeakerController@update')
											->name('speaker.update');
	});

	//Sponsers
	Route::group(['middleware' => ['permission:add sponsers']], function () {

		Route::livewire('sponsers', 'admin.sponsers.index')
								->name('sponsers');
		Route::livewire('sponsers/{sponser}', 'admin.sponsers.show')
								->name('sponser.show');
		Route::get('sponsers/new', 'Admin\SponserController@create')	
								->name('sponser.create');
		Route::get('sponsers/{sponser}/edit', 'Admin\SponserController@edit')
								->name('sponser.edit');
		Route::post('sponsers', 'Admin\SponserController@store')
								->name('sponser.store');
		Route::patch('sponsers/{sponser}', 'Admin\SponserController@update')
								->name('sponser.update');
		
	});


	//Events (Event    manager)
	Route::group(['middleware' => ['permission:add events']], function () {

		Route::livewire('events', 'admin.events.index')
									->name('events');
		Route::livewire('events/{event}', 'admin.events.show')
									->name('event.show');
		Route::get('event/create', 'Admin\EventController@create')
										->name('event.create');
		Route::post('events', 'Admin\EventController@store')
										->name('event.store');
		Route::get('events/{event}/edit', 'Admin\EventController@edit')
										->name('event.edit');
		Route::patch('events/{event}', 'Admin\EventController@update')
										->name('event.update');

		//Api
		Route::get('api/events', 'Admin\Api\EventController@index');
	});



	//Super Admin
	Route::group(['middleware' => ['role:super-admin']], function () {
		Route::livewire('/profile', 'admin.auth.profile')
							->name('admin.profile');
		//Cache
		Route::get('/clear', function() {
						    Artisan::call('cache:clear');
						    return "Cache is cleared";
						});

		//Booking
		Route::livewire('/bookings', 'admin.bookings.index')
									->name('bookings');
		Route::livewire('/bookings/{booking}', 'admin.bookings.show')
									->name('booking.show');
		
																
		//Role
		Route::post('roles', 'Admin\RoleController@store');
		Route::delete('roles/{role}', 'Admin\RoleController@destroy');

		//Permissions
		Route::post('permissions', 'Admin\PermissionController@store');
		Route::delete('permissions/{permission}', 'Admin\PermissionController@destroy');



		//User
		Route::livewire('users', 'admin.users.index')
							            ->name('users');
		Route::get('users/create', 'Admin\UserController@create')
							            ->name('user.create');
		Route::post('users', 'Admin\UserController@store')
							            ->name('user.store');
		Route::livewire('users/{user}', 'admin.users.show')
							            ->name('user.show');
		Route::get('users/{user}/edit', 'Admin\UserController@edit')
										->name('user.edit');
		Route::patch('users/{user}', 'Admin\UserController@update')
										->name('user.update');

	});

});