<div class="flex items-center">
	<a href="/home" class=" text-md  {{ (Route::currentRouteName() === 'home') ? 'font-semibold' : 'text-blue-500 hover:font-semibold' }}">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6  {{ Route::currentRouteName() === 'profile' ? 'font-semibold text-blue-500' : 'text-blue-500 hover:font-semibold ' }}  mx-2"><polyline points="9 18 15 12 9 6"></polyline></svg>

	<a href="/profile" class="text-gray-900 text-lg capitalize text-md md:text-lg md:text-lg   {{ Route::currentRouteName() === 'profile' ? 'font-semibold' : 'text-blue-500 hover:font-semibold ' }}">{{ auth()->user()->first_name }}</a>

	{{-- @if($event)
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-500 mx-2"><polyline points="9 18 15 12 9 6"></polyline></svg>

		<h3 class="text-gray-900 text-lg capitalize text-md md:text-lg md:text-lg  font-semibold text-blue-500 hover:font-semibold">{{ $event }}</h3>
	@endif --}}
</div>