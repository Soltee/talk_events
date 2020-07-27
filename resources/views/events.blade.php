@extends('layouts.app')

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
			<div class="
				{{-- grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 --}}
				">
	        	@forelse($events as $event)
	        		<div class="flex flex-row items-start mb-6 
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
	       
        </div>

        <div class="md:ml-3 w-full md:w-48 flex flex-col items-start">
        	
        	<h3 class="mb-3 font-bold ">Filters</h3>
        	<div class="pb-5 md:pb-0 flex flex-row md:flex-col items-start overflow-x-scroll w-full md:overflow-x-auto">
	        	@forelse($categories as $c)
	        		@if($category)
		        		<a  
		        			class="w-full pr-4 py-2 text-c-pink hover:opacity-75
		        			{{ ($category->id == $c->id) ? 'font-bold' : '' }}
		        			" 
		        			href="{{ url('event?category=' . $c->id . '&slug='. $c->slug) }}">
		        			{{ $c->name }}
		        		</a>
	        		@else 
	        			<a  
	        			class="w-full pr-4 py-2 text-c-pink hover:opacity-75
	        			" 
	        			href="{{ url('event?category=' . $c->id . '&slug='. $c->slug) }}">
	        			{{ $c->name }}
	        		</a>
	        		@endif
	        	@empty
	        		<p>No category yet.</p>
	        	@endforelse
	        </div>
        </div>
    </div>

@endsection
