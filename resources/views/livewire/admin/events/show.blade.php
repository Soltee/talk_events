
@section('title')
	{{ $event->title }}
@endsection

<div class="px-3 md:px-6 pb-6">
	
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
			@include('partials.admin-breadcrumb', ['url' => 'admin/events/', 'link' => true, 'pageName' => 'Events', 'routeName' => Route::currentRouteName()])
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>

		    <h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">{{ $event->title }}</h4>

		    <!----Status -->
		    <div class="ml-3 flex items-center">
	   			@if($event_status === 'Incoming')
					
	   				<span class="px-3 py-2 text-md font-bold text-white rounded bg-green-600">
	   					{{ $event_status }}
					</span>
	   			@elseif($event_status === 'Ended')
	   				<span class="px-3 py-2 text-md font-bold text-white rounded bg-red-500">
	   					{{ $event_status }}
					</span>
					<span class="ml-3">{{ $event->format_date($event->end) }}</span>
	   			@else
					<span class="px-3 py-2 text-md font-bold text-white rounded bg-yellow-500">{{ $event_status }}
					</span>
				@endif
			</div>
        </div>

        <div>
			<div wire:click="setVisibility"
			 	class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
			</div>

			@if($modal)
			<div>
	        	@include('partials.modal', [
	        		'key'    => $event->id, 
	        		'modal'  => $modal,
					'status' => $status 
	        	])
	        </div>
	        @endif
		   
		</div>
			

	
	</div>


	<div class="flex flex-col md:flex-row">
		<div class="w-full md:w-64">
			
    		<img class="h-48 rounded w-full md:w-64 object-cover mt-3  mb-6"  src="{{ asset($event->cover) }}" onerror="this.src='https://via.placeholder.com/300'">

    		<h5 class="mb-4 text-md text-gray-800 px-2">General Info</h5>
	    	<div class="flex items-center mb-6 w-full">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Price</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">$ {{ $event->price }}</h4>
	    	</div>

	    	<div class="flex items-center mb-6 w-full">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Sub Title</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800"> {{ $event->subtitle }}</h4>
	    	</div>
    	</div>
    	<div class="flex-1 md:ml-6">
    		


    		<h5 class="mb-4 text-md text-gray-800 px-2">DateTime</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Start</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event->format_date($event->start) }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Time</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event->format_time($event->time) }}</h4>
	    	</div>
	    	<div class="flex items-center mb-8">
	    		<label for="" class=" border rounded px-4 py-3 w-40">End</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event->format_date($event->end) }}</h4>
	    	</div>

	    	<h5 class="mb-4 text-md text-gray-800 px-2">Venue</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Venue Name</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event->venue_name }}</h4>
	    	</div>
	    	<div class="flex items-center mb-10">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Venue Name</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event->venue_full_address }}</h4>
	    	</div>



	    	<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">Bookings {{ $bookings_count }}</h5>
    		<div class="flex flex-col mb-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5">
    			@forelse($bookings as $booking)
    				<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $booking->first_name }}</h4>

    			@empty
    				<p class="text-red-600 font-semibold">No Bookings Made yet.</p>
    			@endforelse
    		</div>

    		<div class="my-6">
                {{ $bookings->links('vendor.pagination.tailwind') }}
            </div>

   		</div>
    </div>

</div>