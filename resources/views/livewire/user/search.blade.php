@section('title')
	Search {{ ($keyword) ? '- ' . $keyword : "" }} 
@endsection
@section('head')
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<style>
		
	</style>
@endsection

<div class="mt-3 mb-10">
	<div class="flex items-center">
		<a href="/"><h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2">Home</h4></a>
		
		
		
		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">Search</h4>

		@if($total > 0)
		<span class="ml-3">{{ $total }}  found</span>
		@endif
	</div>
        		

	<form method="POST" >
		@csrf
		<div class="flex flex-col md:flex-row items-center w-full my-4">
	        <select wire:model="category" id="categoriesSelect"  class=" appearance-none w-full md:w-1/3 px-3 py-3 md:py-5  border-t md:border-none md:border-l  rounded-t md:rounded-none md:rounded-l">
	        	@forelse($categories as $c)
	      			<option   class="bg-gray-900 text-white border" value="{{ $c->id }}">{{ $c->name }} </option>
	      		@empty
	      			<option>Empty</option>
	      		@endforelse
	        </select>

	        <input wire:ignore type="text" wire:model="keyword" class="w-full md:w-2/3 px-4 border py-3 md:py-4 rounded-b md:rounded-none md:rounded-r" value="" placeholder="Event...">
	    </div>
	</form>

	<div class="">
	     	
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
		        	<div class=" flex flex-col justify-center w-full items-center">
			      		<svg class="h-16 w-16 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
			      		<p class="mt-3">No event yet.</p>
		     		</div>
	        	@endforelse
	        </div>

			<div class="my-6">
                {{-- {{ $events->links('vendor.pagination.tailwind') }} --}}
            </div>
	
		
	</div>

</div>
