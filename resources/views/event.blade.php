@extends('layouts.app')

@section('title')
	{{ $event->title }}
@endsection

@section('head')
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>    
<script src="https://js.stripe.com/v3/"></script>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<style>
	

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
            /**
             * The CSS shown here will not be introduced in the Quickstart guide, but shows
             * how you can use CSS to style your Element's container.
             */
            .StripeElement {
              box-sizing: border-box;

              height: 40px;

              padding: 10px 12px;

              border: 1px solid transparent;
              border-radius: 4px;
              background-color: white;

              box-shadow: 0 1px 3px 0 #e6ebf1;
              -webkit-transition: box-shadow 150ms ease;
              transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
              box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
              border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
              background-color: #fefde5 !important;
            }
	</style>
@endsection

@section('content')
       
    <div class="w-full flex flex-col  mt-8 mb-24 md:mb-12">
	    <div
	    	x-data="{open:false}" 
	    	class="">

	    	<div class="flex justify-between items-center  mb-4 ">
				<div class="flex items-center">
					<a href="/"><h4 class="text-md font-light hover:font-semibold text-gray-800 mr-2">Home</h4></a>
					@if($cat)
		        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		        		<a href="/event?category={{ $cat->id }}&slug={{ $cat->slug }}" class="text-md font-light hover:font-semibold text-c-pink opacity-75">{{ $cat->name }}</a>
		        	@endif
		    		<svg xmlns="http://www.w3.org/2000/svg" class="hidden lg:block w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		    		<a href="/event" class="hidden lg:block "><h4 class="text-md font-light hover:font-semibold text-gray-800 mr-2">Events</h4></a>
		    		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		    		<h4 class="text-md font-bold text-gray-800 opacity-75">{{ $event->title }}</h4>
			    </div>

		    	<!--Book Btn on Desktop -->
			    <div 
					class="hidden md:block flex justify-end items-center  py-4 md:py-0">
				    	@if($event->price > 0)
			      			<span class="text-lg font-bold text-blue-900">
				      			$ {{ $event->price }}
				      		</span>	
			      		@else
			      			<span class="text-lg font-bold text-blue-900">
				      			Free
				      		</span>	
			      		@endif
					    <button 
				    		x-on:click="open = !open" 
				    		type="submit" class="ml-3 text-white bg-blue-600 hover:bg-blue-500 px-10 md:px-6 py-5 md:py-3 rounded-lg">Book Now</button>
			    </div>
			</div>

		    <!--Book Btn on Mobile -->
			<div
				x-on:click="open = !open" 
				class="bg-gray-300 z-20 md:hidden flex justify-between items-center fixed bottom-0 w-full left-0 px-6 py-4">
				@if($event->price > 0)
	      			<span class="text-lg font-bold text-blue-900">
		      			$ {{ $event->price }}
		      		</span>	
	      		@else
	      			<span class="text-lg font-bold text-blue-900">
		      			Free
		      		</span>	
	      		@endif
			    <button class="text-white bg-blue-600 hover:bg-blue-500 px-6 py-4 rounded-lg">Book Now</button>
		    </div>

		    <!-- Booking Modal -->
		    <div 
			    {{-- x-show.transition.50ms="open" --}}
			    class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
			        <div 
			        	x-on:click="open = false;" class="h-full w-full bg-gray-300 opacity-50">
			        </div>
			        <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
				    	<livewire:user.booking :event="$event" />
				    </div>
		    </div>

		</div>


		<div class="flex flex-col mt-8">
			<div class="flex flex-col md:flex-row mb-6">
		    	<div class="flex-1 mb-4 md:mb-0 md:mr-6">
				    <img src="{{ $event->cover }}" class="w-full h-40 md:h-full rounded-lg object-cover object-center" alt="" onerror="this.src='https://via.placeholder.com/300'">
		    	</div>
		    	<div class="w-full md:w-64">
	      			<span class="text-xl text-blue-500 font-bold">
		      			{{ date("F j, Y, g:i a", strtotime($event->start)) }}
		      		</span>	
		      	
    				<div class="mt-3 flex items-center mb-3">
    					<h4 class="mr-3 p-2 rounded font-semibold w-24">Place</h4>
        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $event->venue_name }}</h5>
        				</a>
    				</div>

					<div 
				    	class="flex flex-col my-5">
		    			<h3  class="  w-40">Speakers</h3>
				    	<div class="mt-4 flex flex-row items-center">
				    		@forelse($speakers as $speaker)
				    			<div class="flex flex-col mb-5 items-center flex-wrap mr-4">
				    				<a href="/speakers/{{ $speaker->id }}-{{ $speaker->first_name }}-{{ $speaker->last_name }}">
				    					<img src="{{ $speaker->avatar }}" class="w-12 h-12 hover:border hover:border-blue-500  rounded-full" alt="" onerror="this.src='https://via.placeholder.com/300'">
				    				</a>
				    			</div>
				    		@empty
				    			<div class=" flex flex-col justify-center w-full items-center">
						      		<svg class="h-16 w-16 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
						      		<p class="mt-3">No speakers yet.</p>
					     		</div>
				    		@endforelse
				    	</div>

				    </div>
				    <div 
				    	class="flex flex-col mb-5">
		    			<h3  class="  w-40">Sponsers</h3>
				    	<div class="mt-6 flex flex-row items-center">
				    		@forelse($sponsers as $sponser)
				    			<div class="flex flex-col items-center mr-4">
				    				<a href="/sponsers/{{ $sponser->id }}-{{ $sponser->first_name }}-{{ $sponser->last_name }}">
				    					<img src="{{ $sponser->avatar }}" class="w-12  h-12 rounded-full" alt="" onerror="this.src='https://via.placeholder.com/300'">
				    				</a>
				    			</div>
				    		@empty

				    		@endforelse
				    	</div>

					</div>
		    	</div>
		    </div>
		 
		 
		    <div x-data="{ tab : 'details' }" class="flex flex-col">
		    	<div class="flex items-center">
		    		<h3 x-on:click="tab = 'details'" :class="{'font-bold' : tab === 'details' }" class="cursor-pointer">Details</h3>
		    		<h3 x-on:click="tab = 'activity'" :class="{'font-bold' : tab === 'activity' }" class="ml-4 cursor-pointer">Discussion</h3>
		    	</div>
		    	<div class="flex flex-col">
		    		<div x-show.transition.60ms="tab === 'details'">
						<div class="mt-6 leading-6">{{ $event->description }}</div>
		    		</div>

		    		<div x-show.transition.60ms="tab === 'activity'">
				    	<livewire:user.events.activity :event="$event" />
		    		</div>
		    	</div>
		   
		    </div>
		</div>

		<!-- Similar Events-->
		{{-- <div class="mt-12 weekend_events w-full">
		    <h2 class="text-blue-900 text-lg font-bold mb-8">You may be interested in</h2>
		    <div class="{{ ($similar_count) ? 'swiper-container' : ''}} w-full">
		        <div class="swiper-wrapper">
			        @forelse($similar as $event)
						    <!-- Lazy image -->
					    <div class="relative swiper-slide bg-gray-400 rounded-lg w-full flex flex-col">
					      <a href="{{ url('events', $event->id . '-' . $event->slug) }}">
					      	<img data-src="{{ asset($event->cover) }}" class="swiper-lazy w-full  rounded-lg" onerror="this.src='https://via.placeholder.com/300'">
					      </a>
					      <div class="absolute inset-0 flex justify-center items-center swiper-lazy-preloader"></div>

					       <div class="flex justify-between items-center mt-3 w-full">
					      		<a href="{{ url('events', $event->id . '-' . $event->slug) }}">
					      			<span class="text-lg">
					      			{{ $event->title }}
					      			</span>	
					      		</a>
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
				    	<div class=" flex flex-col justify-center w-full items-center">
				      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
				      		<p class="mt-3">Empty events.</p>
			     		</div>
				    @endforelse
		        </div>
		        <!-- Add Pagination -->
		        <!-- <div class="swiper-pagination"></div> -->
		        @if($similar_count)
			      <div class="swiper-button-next"></div>
			      <div class="swiper-button-prev"></div>
		        @endif
		    </div>
	    </div> --}}

    </div>

@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function(){

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
		});

        
    });

</script>
@endpush
