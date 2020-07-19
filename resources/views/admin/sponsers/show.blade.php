@extends('layouts.admin')

@section('head')

@endsection

@section('content')
    <div class="px-3 md:px-6 pb-6 pt-4">

        <p class="my-2 text-red-600">{{ session('success') }}</p>
        <p class="my-2 text-red-600">{{ session('error') }}</p>
 		@can('update sponsers')
    		<a href="{{ route('sponser.edit', $sponser->id) }}" class="fixed right-0 bottom-0 mr-3 md:mr-8 mb-3 md:mb-8 text-xl font-3xl text-white bg-blue-600 rounded-full px-6 py-5  hover:opacity-75">Edit</a>
    	@endcan
 		<div class="flex justify-between items-center  mb-6">
       		<div class="flex items-center">
       			<a href="{{ route('sponsers') }}" class=" text-md font-md text-gray-900   mr-5  hover:opacity-75">Back</a>
       			<h3 class="text-gray-900 text-lg ">{{ $sponser->full_name }} </h3>
       		</div>

       		<div class="flex items-center">

				<form method="POST" action="{{ route('sponser.destroy', $sponser->id) }}">
					@csrf
					@method('DELETE')
					<button type="submit" class="px-6 py-3 bg-red-600 hover:opacity-75 text-white rounded">Drop</button>
				</form>
			</div>

			
    	</div>

        <img class="h-48 rounded w-full object-cover mt-3  mb-6"  src="{{ asset($sponser->avatar) }}">
       	

    	<div class="my-8 flex flex-col md:flex-row">
    		<div class="w-1/2">
    			<h5 class="mb-4 text-md text-gray-800 px-2">General Info</h5>
	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Email</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $sponser->email }}</h4>
		    	</div>

		    	<div class="flex mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">About</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $sponser->about }}</h4>
		    	</div>

		    	<h5 class="mb-4 text-md text-gray-800 px-2">Company Info</h5>
	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Name</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $sponser->company_name }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-32">Link</label>
		    		<h4 class="border rounded px-4 py-3 ">{{ $sponser->company_link }}</h4>
		    	</div>
		    </div>

		    <div class="w-1/2">
		    

		    	<h5 class="mb-4 text-md text-gray-800 px-2">Events <span class=" text-lg  ont-bold ml-4 text-blue-600">{{ $count_events }}</span></h5>
		    	@forelse($events as $event)
			    <div class="flex flex-col md:flex-row items-center mb-6">
			    	<div class="flex items-center">
			    		{{-- <label for="" class=" border rounded px-4 py-3 w-32">Title</label> --}}
			    		<h4 class="border rounded px-4 py-3 ">{{ $event->title }}</h4>
			    	</div>
			    	<div class="flex items-center">
			    		{{-- <label for="" class=" border rounded px-4 py-3 w-32">Title</label> --}}
			    		<h4 class="border rounded px-4 py-3 ">{{ $event->format_date($event->date) }}</h4>
			    	</div>
		    	</div>
		    	@empty
		    		<p class="border rounded px-4 py-3 "> No events yet.</p>
		    	@endforelse
		    	
		    </div>
    	</div>
    </div>
@endsection

@push('scripts')

	<script>

        document.addEventListener("DOMContentLoaded", function(){

        	
		});		
		
	</script>

@endpush