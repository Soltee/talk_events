<div class="">
	<a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
        {{ config('app.name', 'Laravel') }}
    </a>

    <ul class="m-0 flex flex-col">
    	<li class="list-none mb-4">
    		<a 
    			class="flex items-center-"
    			href="{{ route('admin.dashboard') }}">

    			<span class="text-lg">Dashboard</span>
    		</a>
    	</li>
    	@can('add events')
    	<li class="list-none mb-4">
    		<a 
    			class="flex items-center-"
    			href="{{ route('events') }}">

    			<span class="text-lg">Events</span>
    		</a>
    	</li>
    	@endcan
    	@can('add speakers')
    	<li class="list-none mb-4">
    		<a 
    			class="flex items-center-"
    			href="{{ route('speakers') }}">

    			<span class="text-lg">Speakers</span>
    		</a>
    	</li>
    	@endcan
    	@can('add sponsers')
    	<li class="list-none mb-4">
    		<a 
    			class="flex items-center-"
    			href="{{ route('sponsers') }}">

    			<span class="text-lg">Sponsers</span>
    		</a>
    	</li>
    	@endcan
    </ul>
</div>