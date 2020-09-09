<div class="">

    <ul class="m-0 flex flex-col">
    	<li class="list-none rounded-lg mb-4 px-3 py-3 flex items-center"
                >
            <svg id="hamburger2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="hamburger w-8 h-8 hover:opacity-75 text-white mr-3 cursor-pointer hover:opacity-75">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
    		<a href="/"
    			class="flex items-center    border-r-2 border-transparent text-white hover:border-white ">
    			<span class="text-lg">Home</span>
    		</a>
    	</li>
        <li class="list-none rounded-lg "
                >
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center  px-3 py-3  border-r-2 border-transparent text-white hover:border-white {{ (Route::currentRouteName() == 'admin.dashboard') ? '  font-bold border-white' : 'border-transparent' }}">

                <span class="text-lg">Dashboard</span>
            </a>
        </li>
    	@can('add categories')
    	<li class="list-none rounded-lg ">
    		<a 
    			class="flex items-center px-3 py-3 border-r-2 border-transparent text-white hover:border-white border-r-2{{ (Route::currentRouteName() == 'categories' ) ? '  font-bold border-white' : 'border-transparent' }}"
    			href="{{ route('categories') }}">

    			<span class="text-lg">Categories</span>
    		</a>
    	</li>
    	@endcan
        @can('add events')
        <li class="list-none rounded-lg ">
            <a 
                class="flex items-center px-3 py-3 border-r-2 border-transparent text-white hover:border-white border-r-2{{ (Route::currentRouteName() == 'events' || Route::currentRouteName() == 'event.create' || Route::currentRouteName() == 'event.show' || Route::currentRouteName() == 'event.edit') ? '  font-bold border-white' : 'border-transparent' }}"
                href="{{ route('events') }}">

                <span class="text-lg">Events</span>
            </a>
        </li>
        @endcan

        <li class="list-none rounded-lg ">
            <a 
                class="flex items-center px-3 py-3 border-r-2 border-transparent text-white hover:border-white border-r-2{{ (Route::currentRouteName() == 'bookings' || Route::currentRouteName() == 'booking.show') ? '  font-bold border-white' : 'border-transparent' }}"
                href="{{ route('bookings') }}">

                <span class="text-lg">Bookings</span>
            </a>
        </li>

    	@can('add speakers')
    	<li class="list-none rounded-lg">
    		<a 
    			class="flex items-center px-3 py-3 border-r-2 border-transparent text-white hover:border-white border-r-2{{ (Route::currentRouteName() == 'speakers' || Route::currentRouteName() == 'speaker.create' || Route::currentRouteName() == 'speaker.edit' || Route::currentRouteName() == 'speaker.show') ? '  font-bold border-white' : 'border-transparent' }}"
    			href="{{ route('speakers') }}">

    			<span class="text-lg">Speakers</span>
    		</a>
    	</li>
    	@endcan
    	@can('add sponsers')
    	<li class="list-none rounded-lg ">
    		<a 
    			class="flex items-center px-3 py-3 border-r-2 border-transparent text-white hover:border-white border-r-2{{ (Route::currentRouteName() == 'sponsers' || Route::currentRouteName() == 'sponser.create' || Route::currentRouteName() == 'sponser.edit' || Route::currentRouteName() == 'sponser.show') ? '  font-bold border-white' : 'border-transparent' }}"
    			href="{{ route('sponsers') }}">

    			<span class="text-lg">Sponsers</span>
    		</a>
    	</li>
    	@endcan
        @can('add users')
        <li class="list-none rounded-lg">
            <a 
                class="flex items-center  px-3 py-3 border-r-2 border-transparent text-white hover:border-white {{ (Route::currentRouteName() == 'users' || Route::currentRouteName() == 'user.show' || Route::currentRouteName() == 'user.create' || Route::currentRouteName() == 'user.edit') ? '  font-bold border-white' : 'border-transparent' }}"
                href="{{ route('users') }}">

                <span class="text-lg">Users</span>
            </a>
        </li>
        @endcan
    </ul>
</div>