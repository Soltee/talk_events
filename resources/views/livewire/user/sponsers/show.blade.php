@section('title')
	{{ $sponser->full_name  }}
@endsection
@section('head')

@endsection

<div>
	<div class="flex items-center mb-4">
	    <a href="/"><h4 class="text-sm md:text-md hover:font-semibold mr-2">Home</h4></a>

	    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    <a href="/sponser" class="text-sm md:text-md font-thin hover:font-semibold text-c-pink opacity-75">Sponsers</a>

	    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    <h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">{{ $sponser->full_name  }}</h4>
	</div>


    <div class="mt-3 flex flex-col ">
    	<div class="mb-4 flex flex-col sm:flex-row">
    		<img  class="w-full sm:w-64 bg-cover bg-center mb-5 rounded-lg " src="{{ asset($sponser->avatar) }}" alt="" onerror="this.src='https://via.placeholder.com/300'">

    		<div class="flex flex-col sm:ml-4">
    			{{-- {{ $sponser }} --}}
    			<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">General Info</h5>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32 font-semibold">Full Name</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $sponser->full_name }}</h4>
		    	</div>

		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32 font-semibold">Email</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $sponser->email }}</h4>
		    	</div>

		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32 font-semibold">Created At</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ \Carbon\Carbon::parse($sponser->created_at)->translatedFormat('l jS F Y g:i a') }}</h4>
	    		</div>

	    		<div class="flex  mt-3 mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32 font-semibold">Recent Event</label>
		    		<div class="flex flex-col border p-2">
			    		<a  href="{{ url('events', $recent_event->id . '-' . $recent_event->slug)}}" class="text-blue-600 font-semibold hover:opacity-75 hover:underline">
			    			<h4 class=" rounded px-4 py-3 font-bold text-gray-800">{{ $recent_event->title }}</h4>
			    		</a>
			    		<span class="mt-3  rounded px-4 py-3 font-bold text-gray-800">{{ \Carbon\Carbon::parse($sponser->created_at)->translatedFormat('l jS F Y g:i a') }}</span>
			    	</div>

		    	</div>

    		</div>
    	</div>

    	<!--- Speakers Events -->
    	<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">Events {{ $events_count }}</h5>
		<div class="flex flex-col">
			@forelse($events as $event)
				<div class="flex flex-col sm:flex-row items-start mb-6 plain-item 
	        		">
        			<div class="img-hover-zoom w-full sm:w-1/3">
        				<div class="relative py-3">
	        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
		        				
		        				<img  class="w-full mb-5 rounded-lg hover:opacity-75" src="{{ asset($event->cover) }}" alt="" onerror="this.src='https://via.placeholder.com/300'">
		        			</a>
		        		
		        		</div>
	        		</div>
        			<div class="sm:ml-4 py-3 w-full sm:w-2/3 flex flex-col items-start justify-between">
        				<div class="flex flex-row w-full items-center justify-between mb-5">
        					<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $event->title }}</h5>
        					</a>
        					@if($event->price > 0)
				      			<span class="text-xl text-blue-500 font-bold">
					      			$ {{ $event->price }}
					      		</span>	
				      		@else
				      			<span class="text-xl text-blue-500 font-bold">
					      			Free
					      		</span>	
				      		@endif
        				</div>
        				<p class="mb-5 text-lg text-gray-900">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>	
	        			<a  href="{{ url('events', $event->id . '-' . $event->slug)}}" class="text-blue-600 font-semibold hover:opacity-75">
	        				Show More <span class="ml-3 font-bold text-lg w-12">-</span>
	        			</a>
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
</div>
