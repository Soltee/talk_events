@extends('layouts.admin')

@section('styles')

@endsection

@section('content')
    <div class="px-3 md:px-6 pb-6 pt-4">

        <p class="my-2 text-red-600">{{ session('success') }}</p>
        <p class="my-2 text-red-600">{{ session('error') }}</p>
 		@can('update events')
    		<a href="{{ route('event.edit', $event->id) }}" class="fixed right-0 bottom-0 mr-3 md:mr-8 mb-3 md:mb-8 text-xl font-3xl text-white bg-blue-600 rounded-full px-6 py-5  hover:opacity-75">Edit</a>
    	@endcan
 		<div class="flex justify-between items-center  mb-6">
       		<div class="flex items-center">
       			<a href="{{ route('events') }}" class=" text-md font-md text-gray-900   mr-5  hover:opacity-75">Back</a>
       			<h3 class="text-gray-900 text-lg ">{{ $event->title }}</h3>
       		</div>

       		<div class="flex items-center">
				<p class="text-lg font-bold text-gray-900 mr-6"><span class="mr-3">Book Before</span>{{ $event->format_date($event->book_before) }}</p>

				<form method="POST" action="{{ route('event.destroy', $event->id) }}">
					@csrf
					@method('DELETE')
					<button type="submit" class="px-6 py-3 bg-red-600 hover:opacity-75 text-white rounded">Drop</button>
				</form>
			</div>

			
    	</div>

        <img class="h-48 rounded w-full object-cover mt-3  mb-6"  src="{{ asset($event->cover) }}">
       	

    	<div class="my-8 flex flex-col md:flex-row">
    		<div class="w-1/2">
    			<h5 class="mb-4 text-md text-gray-800 px-2">General Info</h5>
	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Category</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $cat->name }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Title</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->title }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Subtitle</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->sub_title }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">$ Price</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->price }}</h4>
		    	</div>
		    	

		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Ticket</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->ticket }} left</h4>
		    	</div>
		    	<div class="flex mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Description</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->description }}</h4>
		    	</div>
		    </div>

		    <div class="w-1/2">
		    	<h5 class="mb-4 text-md text-gray-800 px-2">Time</h5>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Start</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->format_date($event->start) }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Time</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->time }}</h4>
		    	</div>
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 w-32">End</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->format_date($event->end) }}</h4>
		    	</div>

		    	<h5 class="mb-4 text-md text-gray-800 px-2">Venue</h5>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Venue Name</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->venue_name }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Venue Name</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $event->venue_full_address }}</h4>
		    	</div>
		    </div>
    	</div>
    </div>
@endsection

@section('scripts')

	<script>

        document.addEventListener("DOMContentLoaded", function(){

        	
		});		
		
	</script>

@endsection