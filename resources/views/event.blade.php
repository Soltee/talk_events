@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
<!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
@endsection 

@section('content')
       
    <div class="w-full flex flex-col  px-6 md:px-24  lg:px-40  my-8">

    	<div class="flex justify-between items-center">
			<div class="flex items-center mb-4 ">
				<a href="/"><h4 class="text-md font-light text-gray-800 mr-2">Home</h4></a>
				@if($cat)
	        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        		<h4 class="text-md font-light text-c-pink opacity-75">{{ $cat->name }}</h4>
	        	@endif
	    		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    		<a href="/events"><h4 class="text-md font-light text-gray-800 mr-2">Events</h4></a>
	    		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    		<h4 class="text-md font-light text-gray-800 opacity-75">{{ $event->title }}</h4>
		    </div>
		    <div class="flex items-center">
		    	<span class="text-lg font-bold">$ {{ $event->price }} </span>
			    <a href="{{ url('events', $event->id . '-' . $event->slug . '/checkout') }}" class="ml-3">
			    	<button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 px-6 py-3 rounded-lg">Attend Now</button>
		    	</a>
		    </div>
		</div>


		<div class="flex flex-col md:flex-row mt-4">
		    <div class="">

		    </div>
		    <div class="flex flex-col">
		    	<h3 class="text-md text-gray-700 mb-4">Speakers</h3>
		    	<div class="flex items-center">
		    		@forelse($speakers as $speaker)
		    			<div class="flex flex-col items-center mr-4">
		    				<img src="{{ $speaker->avatar }}" class="w-16  h-16 rounded-full" alt="">

		    				<h5 class="text-md text-gray-700 mt-4">{{ $speaker->first_name }} {{ $speaker->last_name }}</h5>
		    			</div>
		    		@empty

		    		@endforelse
		    	</div>

		    	<p class="mt-6 text-lg text-gray-900">{{ $event->description }}</p>
		    </div>

		</div>


    </div>

@endsection

{{-- <script>
    window.addEventListener('DOMContentLoaded', function(){
        

	        var map = L.map('map').setView(["{{ $venue->latitude }}" , "{{ $venue->longitude }}"], 13);

			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map);

			L.marker(["{{ $venue->latitude }}" , "{{ $venue->longitude }}"]).addTo(map)
			    .bindPopup("{{ $venue->name }}")
			    .openPopup();
    });
</script> --}}
