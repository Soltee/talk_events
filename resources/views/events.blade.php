@extends('layouts.app')

@section('title' , 'Browse Events')

@section('head')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
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
	</style>
@endsection

@section('content')
    
    <div id="parentDiv" class="relative w-full flex flex-col md:flex-row  my-3 md:mt-4 md:mb-8">

    	
    	<div  class="hidden md:block mb-6 md:mb-0 flex flex-col items-start md:w-64">
        	
        	<form method="GET">
        		<div class="flex justify-between items-center">
	        		<input type="text" name="search" class="px-6 py-3 rounded mb-5 border border-blue-500 w-full" value="{{ request()->search ?? '' }}">

	        	</div>

	        	<div class="flex flex-col mb-5">
		        	<h3 class="mb-4 font-bold ">Category</h3>

		        	<div class="pb-5 md:pb-0 flex flex-col items-start  w-full ">
		        		<div class="flex items-center md:mb-2">
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
						<div class="flex flex-col">
							
				        	@forelse($categories as $c)
				        		@if($category)

				
					        		<div class="flex items-center md:mb-2">
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
		        </div>

	        	<div class="flex flex-col mb-5">
	        		<h3 class="mb-4 font-bold ">Type</h3>
	        		
					<div class="flex items-center mb-2">
						<label  class="custom_checkbox relative flex flex items-center">
							<div class="flex items-center border">
								<input class="hidden" class="roleCheckbox" type="radio"  
								name="type" value="free" {{ request()->type == 'free' ? 'checked' : '' }}>
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
								<input class="hidden" class="roleCheckbox" type="radio"  
								name="type" value="1" {{ request()->type == '1' ? 'checked' : '' }}>
								<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>

							<span  class="checkbox_btn text hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
							>
								Paid
							</span>
							
						</label>	    							
					</div>
					<div class="flex items-center mb-2">
						<label  class="custom_checkbox relative flex flex items-center">
							<div class="flex items-center border">
								<input class="hidden" class="roleCheckbox" type="radio"  
								name="type" value="both" {{ request()->type == 'both' ? 'checked' : '' }}>
								<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
							</div>

							<span  class="checkbox_btn text hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
							>
								Both
							</span>
							
						</label>	    							
					</div>
				</div>

				<button type="submit" class="w-full px-6 py-3 rounded bg-blue-600 hover:bg-blue-500 text-white">Filter</button>

			</form>

        </div>


        <div class="flex-1 md:ml-6 flex flex-col">
        	<!--  BreadCrumb -->
        	<div class="flex justify-between items-center mb-8">

        		<div class="flex items-center">
	        		<a href="/"><h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2">Home</h4></a>
	        		
	        		
	        		
	        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">Events</h4>

	        		@if($category)
		        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		        		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">{{ $category->name }}</h4>
		        	@endif
	        	</div>
        		
        		<span class="text-c-pink text-md">
        			@if($count > 0)
	        			{{ $events->firstItem() . '-' . $events->lastItem() }} of {{ $count }} 
	        			@if(request()->search) found @endif
        			@endif
        		</span>
        	</div>

        	<!-- Mobile Screen Filters -->
        	<div 
        		x-data="{ open: false }"
        		id="" class="  md:py-4 md:px-6 w-full flex flex-col items-start md:px-24 md:hidden">
	        	<div class="flex justify-between items-center w-full  mb-4 ">
	        		<h3 class="text-md text-gray-900">Filters</h3>
					<svg 
						x-on:click="open = !open"
						xmlns="http://www.w3.org/2000/svg" class='h-8 w-8 text-blue-500 cursor-pointer' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>

	        	</div>
	        	<div 
		        	x-show.transition.duration.50ms="open"
		        	class="w-full" 
	        		>
		        	<form 
		        		method="GET">
		        		<div class="flex justify-between items-center w-full">
			        		<input type="text" name="search" class="w-full px-6 py-3 rounded mb-5 border border-blue-500" value="{{ request()->search ?? '' }}">

			        	</div>

		        		<div class="flex justify-between w-full">
				        	<div class="flex flex-col mb-5 h-64 w-full overflow-x-hidden">
					        	<h3 class="mb-4 font-bold ">Category</h3>

					        	<div class="pb-5 md:pb-0 flex flex-col items-start overflow-x-scroll w-full md:overflow-x-auto">
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
											<input class="hidden" class="roleCheckbox" type="radio"  
											name="type" value="free" {{ request()->type == 'free' ? 'checked' : '' }}>
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
											<input class="hidden" class="roleCheckbox" type="radio"  
											name="type" value="1" {{ request()->type == '1' ? 'checked' : '' }}>
											<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
										</div>

										<span  class="checkbox_btn text hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
										>
											Paid
										</span>
										
									</label>	    							
								</div>
								<div class="flex items-center mb-2">
									<label  class="custom_checkbox relative flex flex items-center">
										<div class="flex items-center border">
											<input class="hidden" class="roleCheckbox" type="radio"  
											name="type" value="both" {{ request()->type == 'both' ? 'checked' : '' }}>
											<svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
										</div>

										<span  class="checkbox_btn text hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
										>
											Both
										</span>
										
									</label>	    							
								</div>
							</div>
						</div>

						<button type="submit" class="w-full px-6 py-3 rounded bg-blue-600 hover:bg-blue-500 text-white">Filter</button>

					</form>
				</div>

	        </div>
        	<!--  Events -->
			<div class="plain mt-4
				">
	        	@forelse($events as $event)
	        		<div class="flex flex-col sm:flex-row items-start mb-6 plain-item 
	        		">
	        			<div class="img-hover-zoom w-full sm:w-1/3">
	        				<div class="relative py-3">
		        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
			        				
			        				<img  class="w-full mb-5 rounded-lg hover:opacity-75" src="{{ asset($event->cover) }}" alt=""onerror="this.src='/images/placeholder.png'">
			        			</a>
			        			<div class="absolute md:hidden right-0 top-0 p-2 bg-white rounded-bl">
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
		        		</div>
	        			<div class="sm:ml-4 py-3 w-full sm:w-2/3 flex flex-col items-start justify-between">
	        				<div class="flex flex-row w-full items-center justify-between mb-3">
	        					<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
	        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ date("F j, Y, g:i a", strtotime($event->start)) }}</h5>
	        					</a>
	        					<div class="hidden md:block border border-blue-500 p-2 bg-white rounded">
				            		@if($event->price > 0)
						      			<span class="text-lg text-blue-500 font-bold">
							      			Paid
							      		</span>	
						      		@else
						      			<span class="text-lg text-blue-500 font-bold">
							      			Free
							      		</span>	
					      			@endif
				            	</div>
	        					
	        				</div>
	        				<div class="flex items-center mb-3">
	        					<h4 class="mr-3 border border-gray-300 p-2 rounded w-24">Title</h4>
		        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
		        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $event->title }}</h5>
		        				</a>
	        				</div>
	        				<div class="flex items-center mb-3">
	        					<h4 class="mr-3 border border-gray-300 p-2 rounded w-24">Place</h4>
		        				<a class="" href="{{ url('events', $event->id . '-' . $event->slug)}}">
		        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $event->venue_name }}</h5>
		        				</a>
	        				</div>
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

			<div class="">
				{{ $events->links('vendor.pagination.default') }}
			</div>
			
        </div>

        

        <!-- Large Screen Filters -->
        
    </div>

@endsection

@push('scripts')
	<script>
		function debounce(func, wait = 10, immediate = true) {
    var timeout;
    return function() {
        var context = this,
            args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    }
}

		const filters   = document.getElementById('filters');
		const parentDiv   = document.getElementById('parentDiv');

        var filtersTop  = filters.getBoundingClientRect();

		window.addEventListener("scroll", debounce(applyFixedPostion));
		function applyFixedPostion() { 
			
            if(window.pageYOffset > filtersTop.top){
				document.body.style.paddingTop = filtersTop.offsetHeight + 'px';
            	// parentDiv.classList.remove('relative');
            	filters.classList.remove('absolute');
            	filters.classList.add('fixed');
            	filters.classList.add('px-6');
            	filters.classList.add('bg-gray-100');
            } else {
            	// console.log(window.pageYOffset);
				document.body.style.paddingTop = 0;
            	filters.classList.remove('fixed');
            	filters.classList.remove('px-6');
            	filters.classList.add('absolute');
            	filters.classList.remove('bg-gray-100');
            	// parentDiv.classList.add('parentDiv');
            }
         
        } 


		document.addEventListener('DOMContentLoaded', function(){
			

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
