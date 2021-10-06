<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\SponserController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])
				                        ->name('welcome');
Route::get('/events/{event}-{slug}', [WelcomeController::class, 'event'])
										->name('event');
Route::get('/event', [WelcomeController::class, 'events'])
										->name('events.all');				

/*Livewire*/
Route::get('/events/schedules',  \App\Http\Livewire\User\Schedule::class)
									->name('calender');

Route::get('/events/search', \App\Http\Livewire\User\Search::class)
									->name('search.events');


/*About Site*/
Route::get('/help/cookie-policy', [AboutController::class, 'cookiePolicy'])
									->name('cookie-policy');
Route::get('/help/privacy-policy', [AboutController::class, 'privacyPolicy'])
									->name('privacy-policy');
Route::get('/help/faqs', [AboutController::class, 'faqs'])
									->name('faqs');		
Route::get('/help/contact-us', [AboutController::class, 'contactUs'])
									->name('contact-us');
Route::get('/help/terms-conditions', [AboutController::class, 'termsConditions'])
									->name('terms-conditions');	

/*Speakers*/
Route::get('/speaker', \App\Http\Livewire\User\Speakers\Index::class)
						->name('user.speakers');

Route::get('/speakers/{speaker}-{slug}-{last}', \App\Http\Livewire\User\Speakers\Show::class)
						->name('user.speakers.show');


/*Sponsers*/
Route::get('/sponser', \App\Http\Livewire\User\Sponsers\Index::class)
						->name('user.sponsers');

Route::get('/sponsers/{sponser}-{slug}', \App\Http\Livewire\User\Sponsers\Show::class)
						->name('user.sponsers.show');
										
/** Login & Register */
Route::get('/login', \App\Http\Livewire\User\Login::class)
					->name('login');
Route::get('/register', \App\Http\Livewire\User\Register::class)
					->name('register');

/** User */
// Auth::routes();
Route::group(['middleware' => ['role:user']], function () {
    Route::get('/home', \App\Http\Livewire\User\Auth\Dashboard::class)
    					->name('home');

	//Profile
	Route::get('/profile', \App\Http\Livewire\User\Auth\Profile::class)
								->name('profile');

	//Booking
	Route::get('/bookings/{book}', \App\Http\Livewire\User\Bookings\Booking::class);

});


/** Admin Dashboard */
Route::group(['prefix' => 'admin'] , function () {
	/* Before Authenctication*/
	Route::get('login', \App\Http\Livewire\Admin\Login::class)
						->name('admin.login');

	
	//Dashboard
	Route::get('dashboard', \App\Http\Livewire\Admin\Dashboard::class)
							->middleware('auth')
							->name('admin.dashboard');

	//Super Admin
	Route::group(['middleware' => ['role:super admin']], function () {
		Route::get('/profile', \App\Http\Livewire\Admin\Auth\Profile::class)
							->name('admin.profile');
		//Booking
		Route::get('/bookings', \App\Http\Livewire\Admin\Bookings\Index::class)
									->name('bookings');
		Route::get('/bookings/{booking}', \App\Http\Livewire\Admin\Bookings\Show::class)
									->name('booking.show');
		
																
		//Role
		Route::post('roles', [Admin\RoleController::class, 'store']);
		Route::delete('roles/{role}', [Admin\RoleController::class, 'destroy']);

		//Permissions
		Route::post('permissions', [Admin\PermissionController::class, 'store']);
		Route::delete('permissions/{permission}', [Admin\PermissionController::class, 'destroy']);



		//User
		Route::get('users', \App\Http\Livewire\Admin\Users\Index::class)
							            ->name('users');
		Route::get('users/create', [UserController::class, 'create'])
							            ->name('user.create');
		Route::post('users', [UserController::class, 'store'])
							            ->name('user.store');
		Route::get('users/{user}', \App\Http\Livewire\Admin\Users\Show::class)
							            ->name('user.show');
		Route::get('users/{user}/edit', [UserController::class, 'edit'])
										->name('user.edit');
		Route::patch('users/{user}', [UserController::class, 'update'])
										->name('user.update');

	});
	
	//Category
	Route::group(['middleware' => ['permission:add categories']], function () {
		Route::get('categories', \App\Http\Livewire\Admin\Categories\Index::class)
												->name('categories');
	});

	

	//Speakers
	Route::group(['middleware' => ['permission:add speakers']], function () {
		Route::get('speakers', \App\Http\Livewire\Admin\Speakers\Index::class)
											->name('speakers');
		Route::get('speakers/{speaker}', \App\Http\Livewire\Admin\Speakers\Show::class)
											->name('speaker.show');

		Route::get('speaker/create', [SpeakerController::class, 'create'])
											->name('speaker.create');
		Route::get('speakers/{speaker}/edit', [SpeakerController::class, 'edit'])
											->name('speaker.edit');
		Route::post('speaker', [SpeakerController::class, 'store'])
											->name('speaker.store');
		Route::patch('speakers/{speaker}', [SpeakerController::class, 'update'])
											->name('speaker.update');
	});

	//Sponsers
	Route::group(['middleware' => ['permission:add sponsers']], function () {

		Route::get('sponsers', \App\Http\Livewire\Admin\Sponsers\Index::class)
								->name('sponsers');
		Route::get('sponsers/{sponser}', \App\Http\Livewire\Admin\Sponsers\Show::class)
								->name('sponser.show');
		Route::get('sponser/create',  [SponserController::class, 
			'create'])
										->name('sponser.new');
		Route::post('sponsers', [SponserController::class, 
		'store'])
								->name('sponser.store');
		Route::get('sponsers/{sponser}/edit',  [SponserController::class, 
			'edit'])
								->name('sponser.edit');
		Route::patch('sponsers/{sponser}', [SponserController::class, 
		'update'])
								->name('sponser.update');
		
	});


	//Events (Event    manager)
	Route::group(['middleware' => ['permission:add events']], function () {

		Route::get('events', \App\Http\Livewire\Admin\Events\Index::class)
									->name('events');
		Route::get('events/{event}', \App\Http\Livewire\Admin\Events\Show::class)
									->name('event.show');
		Route::get('event/create', [EventController::class, 'create'])
										->name('event.create');
		Route::post('events', [EventController::class, 'store'])
										->name('event.store');
		Route::get('events/{event}/edit', [EventController::class, 'edit'])
										->name('event.edit');
		Route::patch('events/{event}', [EventController::class, 'update'])
										->name('event.update');

		//Api
		Route::get('api/events', [\App\Http\Controllers\Admin\Api\EventController::class, 'index']);
	});

});