<div class="">
	<a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
        {{ config('app.name', 'Laravel') }}
    </a>

    <ul class="m-0 flex flex-col">
    	<li class="list-none rounded-lg "
                >
    		<a href="{{ route('admin.dashboard') }}"
    			class="flex items-center  px-3 py-3 rounded-lg  border border-gray-200 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'admin.dashboard') ? 'bg-gray-900 text-white' : '' }}">

    			<span class="text-lg">Dashboard</span>
    		</a>
    	</li>
    	@can('add events')
    	<li class="list-none rounded-lg ">
    		<a 
    			class="flex items-center px-3 py-3 rounded-lg border border-gray-200 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'events') ? 'bg-gray-900 text-white' : '' }}"
    			href="{{ route('events') }}">

    			<span class="text-lg">Events</span>
    		</a>
    	</li>
    	@endcan
    	@can('add speakers')
    	<li class="list-none rounded-lg">
    		<a 
    			class="flex items-center px-3 py-3 rounded-lg border border-gray-200 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'speakers') ? 'bg-gray-900 text-white' : '' }}"
    			href="{{ route('speakers') }}">

    			<span class="text-lg">Speakers</span>
    		</a>
    	</li>
    	@endcan
    	@can('add sponsers')
    	<li class="list-none rounded-lg ">
    		<a 
    			class="flex items-center px-3 py-3 rounded-lg border border-gray-200 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'sponsers') ? 'bg-gray-900 text-white' : '' }}"
    			href="{{ route('sponsers') }}">

    			<span class="text-lg">Sponsers</span>
    		</a>
    	</li>
    	@endcan
        @can('add users')
        <li class="list-none rounded-lg">
            <a 
                class="flex items-center  px-3 py-3 rounded-lg border border-gray-200 hover:bg-gray-900 hover:text-white {{ (Route::currentRouteName() == 'users') ? 'bg-gray-900 text-white' : '' }}"
                href="{{ route('users') }}">

                <span class="text-lg">Users</span>
            </a>
        </li>
        @endcan
    </ul>
</div>