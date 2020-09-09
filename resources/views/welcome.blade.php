@extends('layouts.app')

@section('title', 'Welcome To Events')
@section('head')
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<style>
		
	</style>
@endsection

@section('content')
    <div class=" w-full mb-8">

	    <div class="mt-6 md:mt-8 hero w-full flex flex-col md:flex-row justify-between items-center">
	    	<div class="flex flex-col w-full md:w-1/2">

	            <h1 class="text-4xl md:text-5xl lg:text-6xl text-c-black font-semibold mb-3 text-gray-900">Broaden your Horizon</h1>
	            <h1 class="text-lg md:text-2xl text-gray-800 ">Meet people that transform you</h1>
	    		<img  src="/images/events.svg" class="lozad w-full sm:w2/3 md:hidden h-64 object-contain w-full hero my-6" alt="">

	            <form method="GET" action="/events/search">
	            	<div class="flex flex-col md:flex-row items-center w-full mt-4 md:mt-10">
	            		<div class="flex items-center relative w-full md:w-1/4">
						  <select name="category" class="block appearance-none w-full border border-gray-400 hover:border-gray-500   pl-4 pr-6 py-4  border-t md:border-none md:border-l  rounded-t md:rounded-none md:rounded-l  shadow leading-tight focus:outline-none focus:shadow-outline">
						    @forelse($query_category as $category)
			          			<option  class="bg-gray-900 text-white border" value="{{ $category->id }}">{{ $category->name }} </option>
			          		@empty
			          			<option>Empty</option>
			          		@endforelse
						  </select>
						  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-900">
						    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
						  </div>
						</div>
                        	

                        <input type="text" name="keyword" class="w-full md:w-2/4 px-4 border-2 py-4 " value="" placeholder="Event...">
                        <button type="submit" class="w-full md:w-1/4 px-4 py-5  hover:opacity-75 text-white bg-blue-500 border-b md:border-none md:border-r  rounded-b md:rounded-none md:rounded-r uppercase">Find</button>      
                    </div>

                </form>
		            
	        </div>
        	<div id="heroImage" class=" hidden md:block md:w-1/2 h-full relative">
	        	<img  src="/images/events.svg" class="lozad w-full object-center h-74 object-cover hero" alt="">
	        </div>
           
	    </div>

	    <div class="mt-24 recent_events w-full">
	    	<div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Upcoming Events</h2>
			    <a href="/event" class="{{ ($trending_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75 hover:underline">	
			    	View all 
			    </a>
			</div>

			<div class="my-8 {{ $trending_total ? 'swiper-container' : ''  }} w-full relative">
			    <div class="swiper-wrapper ">
			    	@forelse($trending as $event)

		      			<div class="swiper-slide relative bg-gray-400 rounded-lg w-full flex flex-col">
		      				<div class="relative">
		      					
				            	<a href="{{ url('events', $event->id . '-' . $event->slug)}}">
				            		<img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg" onerror="this.src='/images/placeholder.png'">
				            	</a>
				            	<div class="absolute right-0 top-0 p-2 bg-white rounded-bl">
				            		@if($event->price > 0)
						      			<span class="text-xl text-blue-500 font-bold">
							      			Paid
							      		</span>	
						      		@else
						      			<span class="text-xl text-blue-500 font-bold">
							      			Free
							      		</span>	
					      		@endif
				            	</div>
		      				</div>
				            <div class="mt-4 flex flex-col items-start">
				            	<a class="mb-3" href="{{ url('events', $event->id . '-' . $event->slug)}}">
				            		<span class="font-semibold">{{ $event->title }}
						      		</span>
						      	</a>
						      	<span class="mb-2">{{ date("F j, Y, g:i a", strtotime($event->start)) }}
						      	</span>
							    
						    </div>
				            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			          	</div>
			       

			        @empty
			        	<div class=" flex flex-col justify-center w-full items-center my-4">
				      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
				      		<p class="mt-3">Empty event.</p>
			     		</div>
			        @endforelse
				      
			    </div>
			    <!-- Add Pagination -->
		      <!-- <div class="swiper-pagination"></div> -->
		      <div class="swiper-button-next"></div>
		      <div class="swiper-button-prev"></div>
			</div>
		    
	    </div>

	    <div class="mt-24 weekend_events w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Comming Weekends</h2>
			    <a href="/event" class="{{ ($this_weekend_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75 hover:underline">	
			    	View all 
			    </a>
			</div>

		    <div class="{{ ($this_weekend_total) ? 'swiper-container' : ''}} w-full">
		        <div class="swiper-wrapper ">
			        @forelse($this_weekend as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide rounded-lg w-full flex flex-col">
					      	<div class="relative">
		      					
				            	<a href="{{ url('events', $event->id . '-' . $event->slug)}}">
				            		<img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg" onerror="this.src='/images/placeholder.png'">
				            	</a>
				            	<div class="absolute right-0 top-0 p-2 bg-white rounded-bl">
				            		@if($event->price > 0)
						      			<span class="text-xl text-blue-500 font-bold">
							      			Paid
							      		</span>	
						      		@else
						      			<span class="text-xl text-blue-500 font-bold">
							      			Free
							      		</span>	
					      		@endif
				            	</div>
		      				</div>
				            <div class="mt-4 flex flex-col items-start">
				            	<a class="mb-3" href="{{ url('events', $event->id . '-' . $event->slug)}}">
				            		<span class="font-semibold">{{ $event->title }}
						      		</span>
						      	</a>
						      	<span class="mb-2">{{ date("F j, Y, g:i a", strtotime($event->start)) }}
						      	</span>
							    
						    </div>
					      	<div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full items-center my-4">
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

	
	    <!-- Speakers -->
	    <div class="mt-24 speakers w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold"> Speakers</h2>
			    <a href="/speaker" class="{{ ($speakers_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75 hover:underline">	
			    	View all 
			    </a>
			</div>
		    <div class="{{ ($speakers_total) ? 'swiper-container' : '' }} w-full">
		        <div class="swiper-wrapper ">
			        @forelse($speakers as $speaker)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide rounded-lg w-full flex flex-col">
					      <a href="{{ url('speakers', $speaker->id . '-' . $speaker->first_name . '-' . $speaker->last_name )}}">
					      	<img data-src="{{ asset($speaker->avatar) }}" class="swiper-lazy w-32 h-32 rounded-full bg-center
					      	bg-cover  rounded-lg" onerror="this.src='/images/placeholder.png'">
					      </a>

					      <a class="mt-3" href="">
	        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $speaker->first_name . ' '. $speaker->last_name }}</h5>
	        				</a>
					      <div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full items-center my-4">
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


	    <!-- Free -->
	    <div class="mt-24 free_events w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Free Events</h2>
			    <a href="/event?search=&type=free" class="{{ ($free_total) ? '' : 'hidden' }} text-blue-500 hover:opacity-75 hover:underline">	
			    	View all
			    </a>
			</div>
		    <div class="{{ ($free_total) ? 'swiper-container' : '' }} w-full">
		        <div class="swiper-wrapper ">
			        @forelse($free as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide rounded-lg w-full flex flex-col">
					        <div class="relative">
		      					
				            	<a href="{{ url('events', $event->id . '-' . $event->slug)}}">
				            		<img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg" onerror="this.src='/images/placeholder.png'">
				            	</a>
				            	<div class="absolute right-0 top-0 p-2 bg-white rounded-bl">
				            		@if($event->price > 0)
						      			<span class="text-xl text-blue-500 font-bold">
							      			Paid
							      		</span>	
						      		@else
						      			<span class="text-xl text-blue-500 font-bold">
							      			Free
							      		</span>	
					      		@endif
				            	</div>
		      				</div>
				            <div class="mt-4 flex flex-col items-start">
				            	<a class="mb-3" href="{{ url('events', $event->id . '-' . $event->slug)}}">
				            		<span class="font-semibold">{{ $event->title }}
						      		</span>
						      	</a>
						      	<span class="mb-2">{{ date("F j, Y, g:i a", strtotime($event->start)) }}
						      	</span>
							    
						    </div>
					        <div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full items-center my-4">
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

	    <div class="mt-24 categories w-full">
		    <div class="flex justify-between items-center mb-8">
			    <h2 class="text-blue-900 text-lg font-bold">Categories</h2>
			   
			</div>
		    <div class="swiper-container w-full">
		        <div class="swiper-wrapper ">
			        @forelse($query_category as $category)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide w-full flex flex-col items-center">
					      <a href="/event?category={{ $category->id }}&slug={{ $category->slug }}">
					      	<img data-src="{{ asset($category->thumbnail) }}" class="swiper-lazy w-full  rounded-lg" onerror="this.src='/images/placeholder.png'">
					      </a>

					      <div class="mt-2 flex">
					      	<a class="event?category={{ $category->id }}&slug={{ $category->slug }}">{{ $category->name }}</a>
					      </div>
					      <div class="flex justify-center items-center swiper-lazy-preloader"></div>
					    </div>

				    @empty
				    	<div class=" flex flex-col justify-center w-full items-center my-4">
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
    lazy: true,
	grabCursor: true,
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
       navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
})
</script>
@endpush
