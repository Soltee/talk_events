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

		.swiper-button-next, .swiper-button-prev{color:black;}
	</style>
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
	    		<svg xmlns="http://www.w3.org/2000/svg" class="hidden lg:block w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    		<a href="/events" class="hidden lg:block "><h4 class="text-md font-light text-gray-800 mr-2">Events</h4></a>
	    		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    		<h4 class="text-md font-light text-gray-800 opacity-75">{{ $event->title }}</h4>
		    </div>
		    <div class="z-20 md:z-0 flex justify-between md:justify-end items-center fixed bottom-0 md:left-0 w-full md:w-auto py-4 md:py-0 px-10 md:static">
		    	<span class="text-lg font-bold">$ {{ $event->price }} </span>
			    <a href="{{ url('events', $event->id . '-' . $event->slug . '/checkout') }}" class="md:ml-3">
			    	<button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 px-10 md:px-6 py-5 md:py-3 rounded-lg">Book Now</button>
		    	</a>
		    </div>
		</div>


		<div class="flex flex-col mt-8">
		    <div class="mb-6">
		    	<img src="{{ $event->cover }}" class="w-full h-56 rounded-lg object-cover object-center" alt="">
		    </div>
		    <div 
				x-data="{ tab: 'details' }"				
				>

				<div class="flex items-center mb-4">
		    			<button :class="{ 'bg-blue-500 text-white font-bold': tab === 'details' }" class="py-4 px-6 md:px-5 rounded-l border border-l" x-on:click="tab = 'details'">Details</button>
		    			<button :class="{ 'bg-blue-500 text-white font-bold': tab === 'speakers' }" class="py-4 px-6 md:px-5 border border-t border-b" x-on:click="tab = 'speakers'">Speakers</button>
						<button :class="{ 'bg-blue-500 text-white font-bold': tab === 'sponsers' }" class="py-4 px-6 md:px-5 rounded-r border border-r" x-on:click="tab = 'sponsers'">Sponsers</button>
		    		</div>

				<div 
				x-show.transition.100ms="tab === 'details'"
				class="flex flex-col flex-row">

					<p class="mt-6 text-lg text-gray-900 text-justify leading-5">{{ $event->description }}
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Diam ut venenatis tellus in metus vulputate. Semper auctor neque .

						<span class="text-xl font-bold">Tellus elementum sagittis vitae et leo.</span> 
						Parturient montes nascetur ridiculus mus mauris vitae. Sit amet est placerat in egestas erat imperdiet sed euismod. Neque aliquam vestibulum morbi blandit. Et ligula ullamcorper malesuada proin libero. Semper risus in hendrerit gravida. Sapien nec sagittis aliquam malesuada bibendum. Lacus vel facilisis volutpat est velit egestas dui. Amet luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor. Tempor orci eu lobortis elementum. Vestibulum sed arcu non odio euismod lacinia at. Posuere ac ut consequat semper viverra nam libero justo laoreet. Eu facilisis sed odio morbi quis commodo odio. In cursus turpis massa tincidunt dui ut ornare lectus. Fermentum leo vel orci porta non pulvinar neque. Ut porttitor leo a diam sollicitudin tempor id. Faucibus nisl tincidunt eget nullam non nisi est. Ultricies mi quis hendrerit dolor magna eget est lorem.

						A cras semper auctor neque. Blandit libero volutpat sed cras ornare arcu dui. Diam vulputate ut pharetra sit amet aliquam id. Feugiat pretium nibh ipsum consequat. Egestas sed sed risus pretium quam vulputate dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Amet porttitor eget dolor morbi non arcu risus. Vestibulum morbi blandit cursus risus. Lorem donec massa sapien faucibus. Odio tempor orci dapibus ultrices in iaculis nunc. Dolor purus non enim praesent elementum facilisis leo vel. Tempus quam pellentesque nec nam aliquam sem et tortor.

						Nunc lobortis mattis aliquam faucibus purus in massa. Tempor orci dapibus ultrices in iaculis nunc sed. Amet aliquam id diam maecenas ultricies mi. At augue eget arcu dictum varius. Integer enim neque volutpat ac tincidunt vitae semper quis. Urna neque viverra justo nec ultrices. In eu mi bibendum neque egestas congue. Laoreet id donec ultrices tincidunt. Cras ornare arcu dui vivamus arcu felis bibendum. Accumsan lacus vel facilisis volutpat est. Ultrices mi tempus imperdiet nulla malesuada pellentesque elit eget gravida. Facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum. Pharetra convallis posuere morbi leo. Sit amet volutpat consequat mauris nunc congue nisi vitae suscipit. Augue ut lectus arcu bibendum at varius. Malesuada fames ac turpis egestas maecenas.



						<span class="text-xl font-bold">Tellus elementum sagittis vitae et leo.</span> 

						Semper feugiat nibh sed pulvinar proin gravida hendrerit lectus. Cras adipiscing enim eu turpis egestas pretium aenean pharetra magna. Arcu odio ut sem nulla pharetra diam sit. Venenatis lectus magna fringilla urna porttitor. Duis convallis convallis tellus id interdum velit. Felis bibendum ut tristique et egestas quis ipsum suspendisse. Eleifend donec pretium vulputate sapien nec. Quam vulputate dignissim suspendisse in est ante in nibh. Dictum varius duis at consectetur. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare.
					</p>

				</div>

				<div 
			    	x-show.transition.100ms="tab === 'speakers'"
			    	class="flex flex-col">
			    	<div class="flex flex-row items-center">
			    		@forelse($speakers as $speaker)
			    			<div class="flex flex-col items-center flex-wrap mr-4">
			    				<img src="{{ $speaker->avatar }}" class="w-12 h-12 md:w-24  w-12 h-12 md:h-24 rounded-full" alt="">

			    				<h5 class="text-md text-gray-700 mt-4">{{ $speaker->first_name }} </h5>
			    			</div>
			    		@empty

			    		@endforelse
			    	</div>

			    	<p class="mt-6 text-lg text-gray-900">{{ $event->description }}</p>
			    </div>
			    <div 
			    	x-show.transition.100ms="tab === 'sponsers'"
			    	class="flex flex-col">
				    	<div class="flex flex-row items-center">
				    		@forelse($sponsers as $sponser)
				    			<div class="flex flex-col items-center mr-4">
				    				<img src="{{ $sponser->avatar }}" class="w-24  h-24 rounded-full" alt="">

				    				<h5 class="text-md text-gray-700 mt-4">{{ $sponser->full_name }} </h5>
				    			</div>
				    		@empty

				    		@endforelse
				    	</div>

				</div>

			</div>
		    {{-- <div class="flex flex-col items">
			    <div 
					x-data="{ tab: 'speakers' }"				
					>
					<div class="flex items-center">
		    			<button :class="{ 'active': tab === 'bar' }" x-on:click="tab = 'speakers'">Speakers</button>
						<button :class="{ 'active': tab === 'foo' }" x-on:click="tab = 'sponsers'">Speakers</button>
		    		</div>

				    <div 
				    	x-show.transition.100ms="tab === 'speakers'"
				    	class="flex flex-col">
				    	<h3 class="text-md text-gray-700 mb-4">Speakers</h3>
				    	<div class="flex flex-col items-center">
				    		@forelse($speakers as $speaker)
				    			<div class="flex flex-col items-center mr-4">
				    				<img src="{{ $speaker->avatar }}" class="w-24  h-24 rounded-full" alt="">

				    				<h5 class="text-md text-gray-700 mt-4">{{ $speaker->first_name }} </h5>
				    			</div>
				    		@empty

				    		@endforelse
				    	</div>

				    	<p class="mt-6 text-lg text-gray-900">{{ $event->description }}</p>
				    </div>
				    <div 
				    	x-show.transition.100ms="tab === 'sponsers'"
				    	class="flex flex-col">
				    	<h3 class="text-md text-gray-700 mb-4">Sponsers</h3>
				    	<div class="flex flex-col items-center">
				    		@forelse($sponsers as $sponser)
				    			<div class="flex flex-col items-center mr-4">
				    				<img src="{{ $sponser->avatar }}" class="w-24  h-24 rounded-full" alt="">

				    				<h5 class="text-md text-gray-700 mt-4">{{ $sponser->full_name }} </h5>
				    			</div>
				    		@empty

				    		@endforelse
				    	</div>

				    </div>
				</div>
			</div> --}}

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

					      <div class="flex items-center mt-3">
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
      lazy: true
})
</script>
@endpush
