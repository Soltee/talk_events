<div class="">
	<a href="{{ url('/') }}" class="text-lg font-semisemibold text-gray-100 no-underline">
        {{ config('app.name', 'Laravel') }}
    </a>

    <ul class="m-0 flex flex-col">
    	<li class="list-none rounded-lg "
                >
    		<a href="{{ route('admin.dashboard') }}"
    			class="flex items-center  px-3 py-3  border-r-2 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'admin.dashboard') ? 'border-r-2 border-gray-900 font-semibold' : '' }}">

    			<span class="text-lg">Dashboard</span>
    		</a>
    	</li>
    	@can('add events')
    	<li class="list-none rounded-lg ">
    		<a 
    			class="flex items-center px-3 py-3 border-r-2 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'events') ? 'border-r-2 border-gray-900 font-semibold' : '' }}"
    			href="{{ route('events') }}">

    			<span class="text-lg">Events</span>
    		</a>
    	</li>
    	@endcan

        <li class="list-none rounded-lg ">
            <a 
                class="flex items-center px-3 py-3 border-r-2 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'bookings') ? 'border-r-2 border-gray-900 font-semibold' : '' }}"
                href="{{ route('bookings') }}">

                <span class="text-lg">Bookings</span>
            </a>
        </li>

    	@can('add speakers')
    	<li class="list-none rounded-lg">
    		<a 
    			class="flex items-center px-3 py-3 border-r-2 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'speakers') ? 'border-r-2 border-gray-900 font-semibold' : '' }}"
    			href="{{ route('speakers') }}">

    			<span class="text-lg">Speakers</span>
    		</a>
    	</li>
    	@endcan
    	@can('add sponsers')
    	<li class="list-none rounded-lg ">
    		<a 
    			class="flex items-center px-3 py-3 border-r-2 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'sponsers') ? 'border-r-2 border-gray-900 font-semibold' : '' }}"
    			href="{{ route('sponsers') }}">

    			<span class="text-lg">Sponsers</span>
    		</a>
    	</li>
    	@endcan
        @can('add users')
        <li class="list-none rounded-lg">
            <a 
                class="flex items-center  px-3 py-3 border-r-2 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'users' || Route::currentRouteName() == 'user.show') ? 'border-r-2 border-gray-900 font-semibold' : '' }}"
                href="{{ route('users') }}">

                <span class="text-lg">Users</span>
            </a>
        </li>
        @endcan
    </ul>
</div>