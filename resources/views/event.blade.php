@extends('layouts.app')

@section('head')
	{{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	   crossorigin=""/>
	Make sure you put this AFTER Leaflet's CSS
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	   crossorigin=""></script> --}}
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<style>
		/*.swiper-container {
		  width: 100%;
		  height: 100%;
		}*/

		.swiper-slide {
		  text-align: center;
		  font-size: 18px;
		  background: #fff;
		  /* Center slide text vertically */
		  display: -webkit-box;
		  display: -ms-flexbox;
		  display: flex;
		  -webkit-box-pack: center;
		  -ms-flex-pack: center;
		  justify-content: center;
		  -webkit-box-align: center;
		  -ms-flex-align: center;
		  align-items: center;
		}

		img {
		  max-width: 100%;
		  height: auto;
		}

		.swiper-button-next, .swiper-button-prev{color:blue;}
	</style>
@endsection

@section('content')
       
    <div class="w-full flex flex-col  px-6 md:px-24  lg:px-40  mt-8 mb-12">

    	<div class="flex justify-between items-center  mb-4 ">
			<div class="flex items-center">
				<a href="/"><h4 class="text-md font-light text-gray-800 mr-2">Home</h4></a>
				@if($cat)
	        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        		<a href="/event?category={{ $cat->id }}&slug={{ $cat->slug }}" class="text-md font-light text-c-pink opacity-75">{{ $cat->name }}</a>
	        	@endif
	    		<svg xmlns="http://www.w3.org/2000/svg" class="hidden lg:block w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    		<a href="/event" class="hidden lg:block "><h4 class="text-md font-light text-gray-800 mr-2">Events</h4></a>
	    		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    		<h4 class="text-md font-light text-gray-800 opacity-75">{{ $event->title }}</h4>
		    </div>
		    <div class="hidden md:block flex justify-end items-center  py-4 md:py-0">
		    	<span class="text-lg font-bold">$ {{ $event->price }} </span>
			    <a href="{{ url('events', $event->id . '-' . $event->slug . '/checkout') }}" class="md:ml-3">
			    	<button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 px-10 md:px-6 py-5 md:py-3 rounded-lg">Book Now</button>
		    	</a>
		    </div>
		</div>
		<div class="bg-gray-300 z-20 md:hidden flex justify-between items-center fixed bottom-0 w-full left-0 px-6 py-4">
	    	<span class="text-lg font-bold text-blue-900">$ {{ $event->price }} </span>
		    <a href="{{ url('events', $event->id . '-' . $event->slug . '/checkout') }}">
		    	<button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 px-6 py-4 rounded-lg">Book Now</button>
	    	</a>
	    </div>


		<div class="flex flex-col mt-8">
		    <div class="mb-6">
		    	<img src="{{ $event->cover }}" class="w-full h-56 rounded-lg object-cover object-center" alt="">
		    </div>

		    <div class="flex flex-col md:flex-row">
		    	<div class="flex-1">
		    		<h3  class="py-4 px-6 md:px-5 rounded-l border border-l w-40">Details</h3>
					<p class="mt-6">{{ $event->description }}</p>
		    	</div>
		    	<div class="w-full md:w-64">

					<div 
				    	class="flex flex-col mb-5">
		    			<h3  class="  w-40">Speakers</h3>
				    	<div class="mt-6 flex flex-row items-center">
				    		@forelse($speakers as $speaker)
				    			<div class="flex flex-col mb-5 items-center flex-wrap mr-4">
				    				<img src="{{ $speaker->avatar }}" class="w-12 h-12  rounded-full" alt="">

				    				<h5 class="text-md text-gray-700 mt-4">{{ $speaker->first_name }} </h5>
				    			</div>
				    		@empty

				    		@endforelse
				    	</div>

				    </div>
				    <div 
				    	class="flex flex-col mb-5">
		    			<h3  class="  w-40">Sponsers</h3>
					    	<div class="mt-6 flex flex-row items-center">
					    		@forelse($sponsers as $sponser)
					    			<div class="flex flex-col items-center mr-4">
					    				<img src="{{ $sponser->avatar }}" class="w-12  h-12 rounded-full" alt="">

					    				<h5 class="text-md text-gray-700 mt-4">{{ $sponser->full_name }} </h5>
					    			</div>
					    		@empty

					    		@endforelse
					    	</div>

					</div>
		    	</div>
		    </div>
		   
		  

		</div>

		<div class="mt-12 weekend_events w-full">
		    <h2 class="text-blue-900 text-lg font-bold mb-8">You may be interested in</h2>
		    <div class="swiper-container w-full">
		        <div class="swiper-wrapper">
			        @forelse($similar as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide bg-gray-400 rounded-lg w-full flex flex-col">
					      <a href="{{ url('events', $event->id . '-' . $event->slug) }}"><img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg"></a>
					      <div class="absolute inset-0 flex justify-center items-center swiper-lazy-preloader"></div>

					      <div class="flex justify-between items-center mt-3 w-full">
					      		<span class="text-lg">
					      			{{ $event->title }}
					      		</span>	
					      		@if($event->is_paid)
					      			<span class="text-lg text-blue-500 font-light">
						      			Paid
						      		</span>	
					      		@else
					      			<span class="text-lg text-blue-500 font-light">
						      			Free
						      		</span>	
					      		@endif
					      </div>
					    </div>

				    @empty

				    @endforelse
		        </div>
		      <!-- Add Pagination -->
		      <!-- <div class="swiper-pagination"></div> -->
		      <div class="swiper-button-next"></div>
		      <div class="swiper-button-prev"></div>
		    </div>
	    </div>



    </div>

@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>

  
var swiper = new Swiper('.swiper-container', {
  // Default parameters
	slidesPerView: 1,
  // spaceBetween: 2,
  // Responsive breakpoints
	 breakpoints: {
	    // when window width is >= 320px
	    0: {
	      slidesPerView: 1,
	      spaceBetween: 10
	    },
	    // when window width is >= 640px
	    640: {
	      slidesPerView: 2,
	      spaceBetween: 10
	    }
	    ,
	    // when window width is >= 640px
	    1080: {
	      slidesPerView: 3,
	      spaceBetween: 20
	    }
	    ,
	    // when window width is >= 640px
	    1440: {
	      slidesPerView: 4,
	      spaceBetween: 20
	    }
  	},
      lazy: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
})
</script>
@endpush
