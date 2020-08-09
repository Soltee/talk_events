@extends('layouts.app')

@section('head')
	<style>
		/* The container */
		.check{opacity: 0;}
		.custom_checkbox input:checked + .check{
			opacity: 1;
			color:blue;
		}
		.custom_checkbox input:checked + .text{
			font-weight: bold;
		}

	.loader-ellips {
	  font-size: 20px; /* change size here */
	  position: relative;
	  width: 4em;
	  height: 1em;
	  margin: 10px auto;
	}
	.loader-ellips__dot {
	  display: block;
	  width: 1em;
	  height: 1em;
	  border-radius: 0.5em;
	  background: #555; /* change color here */
	  position: absolute;
	  animation-duration: 0.5s;
	  animation-timing-function: ease;
	  animation-iteration-count: infinite;
	}
	.loader-ellips__dot:nth-child(1),
	.loader-ellips__dot:nth-child(2) {
	  left: 0;
	}
	.loader-ellips__dot:nth-child(3) { left: 1.5em; }
	.loader-ellips__dot:nth-child(4) { left: 3em; }
	@keyframes reveal {
	  from { transform: scale(0.001); }
	  to { transform: scale(1); }
	}
	@keyframes slide {
	  to { transform: translateX(1.5em) }
	}
	.loader-ellips__dot:nth-child(1) {
	  animation-name: reveal;
	}
	.loader-ellips__dot:nth-child(2),
	.loader-ellips__dot:nth-child(3) {
	  animation-name: slide;
	}
	.loader-ellips__dot:nth-child(4) {
	  animation-name: reveal;
	  animation-direction: reverse;
	}
	</style>
@endsection

@section('content')
    
    <div class="w-full flex flex-col md:flex-row  px-6 md:px-24  lg:px-40  my-8">
        
        <div class="flex-1 md:mr-10 flex flex-col">
        	<div class="flex justify-between items-center mb-8">

        		<div class="flex items-center">
	        		<a href="/"><h4 class="text-md font-light text-c-pink mr-2">Home</h4></a>
	        		
	        		@if($category)
		        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		        		<h4 class="text-md font-light text-c-pink opacity-75">{{ $category->name }}</h4>
		        	@endif
	        		
	        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        		<h4 class="text-md font-light text-c-pink opacity-75">Events</h4>
	        	</div>
        		
        		<span class="pb-4 text-c-pink">
        			{{ $events->firstItem() . '-' . $events->lastItem() }} of {{ $count }} 
        			@if(request()->search) found @endif
        		</span>
        	</div>
			<div class="plain
				{{-- grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 --}}
				">
	        	@forelse($events as $event)
	        		<div class="flex flex-row items-start mb-6 plain-item 
	        		{{-- w-full md:w-1/2 lg:w-1/3 --}}
	        		">
	        			<div class="img-hover-zoom w-full sm:w-1/3">
	        				<div class="relative py-3">
		        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
			        				
			        				<img  class="w-full mb-5 rounded-lg " src="{{ asset($event->cover) }}" alt="">
			        			</a>
			        		
			        		</div>
		        		</div>
	        			<div class="sm:ml-4 py-3 w-full sm:w-2/3 flex flex-col items-start justify-between">
	        				<div class="flex flex-row w-full items-center justify-between mb-4">
	        					<h5 class="text-xl font-bold text-gray-900">{{ $event->title }}</h5>
	        					@if($event->is_paid)
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
	        				<p class="mb-5 text-lg text-gray-900">{{ $event->category->name }}</p>	
		        			<a  href="{{ url('events', $event->id . '-' . $event->slug)}}" class="text-blue-600 font-semibold">
		        				Show More <span class="ml-3 font-bold text-lg w-12">-</span>
		        			</a>
	        			</div>
	        			
	        		</div>
	        	@empty
	        		<p>No event yet.</p>
	        	@endforelse
	        </div>

			<div class="">
				{{ $events->onEachSide(5)->appends(request()->input())->links() }}
			</div>
			{{-- <div class="page-load-status">
		      	<div class="loader-ellips infinite-scroll-request">
			        <span class="loader-ellips__dot"></span>
			        <span class="loader-ellips__dot"></span>
			        <span class="loader-ellips__dot"></span>
			        <span class="loader-ellips__dot"></span>
		      	</div>
		      	<div class="infinite-scroll-last flex flex-col justify-center w-full">
		      		<svg class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
		      		<p class="mt-3">No more events..</p>
		     	</div>
		     	<div class="infinite-scroll-error flex flex-col justify-center w-full">
		      		<svg class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
		      		<p class="mt-3">No more pages to load</p>
		     	</div>
		    </div>
	        --}}
        </div>

        <div class="md:ml-3 w-full md:w-64 flex flex-col items-start">
        	
        	<form method="GET">
        		<input type="text" name="search" class="px-6 py-3 rounded mb-5 border border-blue-500" value="{{ request()->search ?? '' }}">
	        	<div class="flex flex-col mb-5">
		        	<h3 class="mb-4 font-bold ">Category</h3>

		        	<div class="pb-5 md:pb-0 flex flex-row md:flex-col items-start overflow-x-scroll w-full md:overflow-x-auto">
		        		<div class="flex items-center mb-2">
							<label  class="custom_checkbox relative flex flex items-center">
								<div class="flex items-center border">
									<input class="hidden" class="roleCheckbox" type="radio"  
									name="category" value="" checked="">
									<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
								</div>

								<span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold 
								
								"
								>
									None
								</span>
								
							</label>	    							
						</div>
			        	@forelse($categories as $c)
			        		@if($category)

			
				        		<div class="flex items-center mb-2">
									<label  class="custom_checkbox relative flex flex items-center">
										<div class="flex items-center border">
											<input class="hidden" class="roleCheckbox" type="radio"  
											name="category" value="{{ $c->id }}" {{ ($category->id == $c->id) ? 'checked' : '' }}>
											<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
										</div>

										<span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold 
										{{ ($category->id == $c->id) ? 'font-bold' : '' }}
										"
										>
											{{ \Illuminate\Support\Str::limit($c->name, 10, '') }}
										</span>
										
									</label>	    							
								</div>
			        		@else 
				        		<div class="flex items-center mb-2">
									<label  class="custom_checkbox relative flex flex items-center">
										<div class="flex items-center border">
											<input class="hidden" class="roleCheckbox" type="radio"  
											name="category" value="{{ $c->id }}">
											<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
										</div>

										<span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
										>
											{{ \Illuminate\Support\Str::limit($c->name, 10, '') }}
										</span>
										
									</label>	    							
								</div>
			        		
			        		@endif
			        	@empty
			        		<p>No category yet.</p>
			        	@endforelse
			        </div>
		        </div>

	        	<div class="flex flex-col mb-5">
	        		<h3 class="mb-4 font-bold ">Type</h3>
	        		
					<div class="flex items-center mb-2">
						<label  class="custom_checkbox relative flex flex items-center">
							<div class="flex items-center border">
								<input class="hidden" class="roleCheckbox" type="checkbox"  
								name="type" value="free" {{ request()->type == '0' ? 'checked' : '' }}>
								<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>

							<span  class="checkbox_btn text hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
							>
								Free
							</span>
							
						</label>	    							
					</div>
					<div class="flex items-center mb-2">
						<label  class="custom_checkbox relative flex flex items-center">
							<div class="flex items-center border">
								<input class="hidden" class="roleCheckbox" type="checkbox"  
								name="type" value="1" {{ request()->type == '1' ? 'checked' : '' }}>
								<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>

							<span  class="checkbox_btn text hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
							>
								Paid
							</span>
							
						</label>	    							
					</div>
				</div>

				<button type="submit" class="w-full px-6 py-3 rounded bg-blue-600 hover:bg-blue-500 text-white">Filter</button>

			</form>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function(){
			// var infScroll = new InfiniteScroll( '.plain', {
	  //         path: '?page=@{{#}}',
	  //         append: '.plain-item',
	  //         history: false,
	  //         status: '.page-load-status',
	  //       });

	
	        const images = document.querySelectorAll("img");

            const imgOptions = {};
            const imgObserver = new IntersectionObserver((entries, imgObserver) => {
              entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const img = entry.target;
                img.src = img.src.replace("w=10&", "w=800&");
                imgObserver.unobserve(entry.target);
              });
            }, imgOptions);

            images.forEach((img) => {
              imgObserver.observe(img);
            });
		});
	</script>
@endpush
