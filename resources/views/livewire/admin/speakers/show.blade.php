@section('title')
	{{ $speaker->first_name . ' ' . $speaker->last_name }}
@endsection

<div class="px-3 md:px-6 pb-6">
	
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
            @include('partials.admin-breadcrumb', ['url' => '/admin/speakers', 'link' => false, 'pageName' => 'Speakers', 'routeName' => Route::currentRouteName()])
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>

		    <h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">{{ $speaker->email }}</h4>

		    
        </div>

        <div >
			<div 
				wire:click="setVisibility"
			 	class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
			</div>

			@if($modal)
				<div 
					{{-- x-on:close-modal.window="on = false" --}}

					>
		        	@include('partials.modal', [
		        		'key'    => $speaker->id, 
		        		'modal'  => $modal,
						'status' => $status 
		        	])
		        </div>
	        @endif
		   
		</div>
			

	
	</div>


	<div class="flex flex-col md:flex-row mb-5">
		<div class="w-full md:w-64">
			
    		<img class="h-48 rounded w-full md:w-64 object-cover mt-3  mb-6"  src="{{ asset($speaker->avatar) }}" onerror="this.src='/images/placeholder.png'">
    	</div>
    	<div class="flex-1 md:ml-6">
    		<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">General Info</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Full Name</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $speaker->first_name . ' - ' . $speaker->last_name }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Email</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $speaker->email }}</h4>
	    	</div>

	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Created At</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ \Carbon\Carbon::parse($speaker->created_at)->translatedFormat('l jS F Y g:i a') }}</h4>
	    	</div>

	    	
    		
        </div>
   
    </div>

    <!--- Speakers Events -->
	<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">Events</h5>
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
		@forelse($events as $event)
			<div class="flex flex-col  items-start mb-6 plain-item 
        		">
    			<div class="img-hover-zoom w-full">
    				<div class="relative py-3">
        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
	        				
	        				<img  class="w-full mb-5 rounded-lg hover:opacity-75" src="{{ asset($event->cover) }}" alt="">
	        			</a>
	        		
	        		</div>
        		</div>
    			<div class="w-full flex flex-col items-start justify-between">
    				<div class="flex flex-row w-full items-center justify-between ">
    					<a class="" href="/admin/events/{{ $event->id }}">
    						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $event->title }}</h5>
    					</a>
    				</div>
    			</div>
    			
    		</div>
    	@empty
        	<div class=" flex flex-col justify-center w-full">
	      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
	      		<p class="mt-3">No event yet.</p>
     		</div>
    	@endforelse

	</div>

	<div class="my-6">
        {{ $events->links('vendor.pagination.tailwind') }}
    </div>

</div>