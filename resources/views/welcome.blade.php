@extends('layouts.app')
@section('head')
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<style>
		
	</style>
@endsection

@section('content')
    <div class=" w-full mb-8">

	    <div class="mt-12 hero w-full flex flex-col md:flex-row justify-between items-center">
	    	<div class="flex flex-col w-full md:w-1/2">
	            <h1 class="text-4xl md:text-5xl lg:text-6xl text-c-black mb-3">Broaden your Horizon</h1>
	            <h1 class="text-lg md:text-2xl text-c-black ">Meet people that transform you</h1>
	            <img src="/images/hero.svg" class="lozad w-full sm:w2/3 md:hidden h-64 object-cover object-center w-full hero mt-3" alt="">
        		<a href="/event" class="mt-10 w-40 text-center px-4 py-4 md:px-8 md:py-4 rounded bg-blue-600 hover:opacity-75 text-white text-md md:text-lg">
        			Meet Now
        		</a>
	        	</div>
        	<div id="heroImage" class=" hidden md:block md:w-1/2 h-full relative">
	        	<img  src="/images/events.svg" class="lozad w-full object-center h-74 object-cover hero" alt="">
	        </div>
           
	    </div>

	    <div class="mt-16 recent_events w-full">
	    	<div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Recent Events</h2>
			    <a href="/event" class="{{ ($trending_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75">	
			    	View all 
			    </a>
			</div>

		    <div class="swiper-container w-full">
		        <div class="swiper-wrapper">
			        @forelse($trending as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide bg-gray-400 rounded-lg w-full flex flex-col items-center">
					      <a href="{{ url('events', $event->id . '-' . $event->slug)}}"><img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg"></a>

					      <div class="mt-2 flex ">
					      	{{ date("F j, Y, g:i a", strtotime($event->start)) }}
					      </div>
					      <div class="flex justify-center items-center swiper-lazy-preloader"></div>
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

	    <div class="mt-16 weekend_events w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Comming Weekends</h2>
			    <a href="/event" class="{{ ($this_weekend_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75">	
			    	View all 
			    </a>
			</div>

		    <div class="{{ ($this_weekend_total) ? 'swiper-container' : ''}} w-full">
		        <div class="swiper-wrapper">
			        @forelse($this_weekend as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide bg-gray-400 rounded-lg w-full">
					      <a href="{{ url('events', $event->id . '-' . $event->slug)}}"><img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg"></a>
					      <div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full">
				      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
				      		<p class="mt-3">Empty event comming weekends.</p>
			     		</div>
				    @endforelse
		        </div>
		      <!-- Add Pagination -->
		      <!-- <div class="swiper-pagination"></div> -->
		      @if($this_weekend_total)
			      <div class="swiper-button-next"></div>
			      <div class="swiper-button-prev"></div>
		      @endif
		    </div>
	    </div>

	   {{--  @if($featured)
		    <div class="mt-16 recent_events w-full flex flex-col md:flex-row">
		    	<div class="w-full md:w-1/2 mb-3 md:mb-0">
		    		<h5>{{ $featured->title }}</h5>
		    	</div>

		    	<div class="w-full md:w-1/2">
		    		<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
		    			<img src="{{ asset($featured->cover) }}" class="swiper-lazy w-full  rounded-lg">
		    		</a>
		    	</div>
		    </div>
		@endif
 --}}

	    <div class="mt-16 free_events w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Free Events</h2>
			    <a href="/event?search=&type=free" class="{{ ($free_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75">	
			    	View all
			    </a>
			</div>
		    <div class="{{ ($free_total) ? 'swiper-container' : '' }} w-full">
		        <div class="swiper-wrapper">
			        @forelse($free as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide bg-gray-400 rounded-lg w-full">
					      <a href="{{ url('events', $event->id . '-' . $event->slug)}}"><img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg"></a>
					      <div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full">
				      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
				      		<p class="mt-3">Empty free events.</p>
			     		</div>
				    @endforelse
		        </div>
		     
		      @if($free_total)
		      <div class="swiper-button-next"></div>
		      <div class="swiper-button-prev"></div>
		      @endif
		    </div>
	    </div>

	    <div class="mt-16 categories w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Categories</h2>
			   
			</div>
		    <div class="swiper-container w-full">
		        <div class="swiper-wrapper">
			        @forelse($query_category as $category)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide bg-gray-400 w-full flex flex-col items-center">
					      <a href="/event?category={{ $category->id }}&slug={{ $category->slug }}">
					      	<img data-src="{{ asset($category->thumbnail) }}" class="swiper-lazy w-full  rounded-lg">
					      </a>

					      <div class="mt-2 flex">
					      	<a class="event?category={{ $category->id }}&slug={{ $category->slug }}">{{ $category->name }}</a>
					      </div>
					      <div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full">
				      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
				      		<p class="mt-3">Empty categories.</p>
			     		</div>
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
	    960: {
	      slidesPerView: 3,
	      spaceBetween: 20
	    }
	    ,
	    // when window width is >= 640px
	    1080: {
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
