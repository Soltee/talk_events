@extends('layouts.app')

@section('content')
    
    <div class="w-full flex flex-col md;flex-row  px-6 md:px-24  lg:px-40  my-8">
        
        <div class="flex-1 md:mr-10 flex flex-col">
        	<div class="flex justify-between items-center mb-8">

        		<div class="flex items-center">
	        		<a href="/"><h4 class="text-md font-light text-c-pink mr-2">Home</h4></a>
	        		
	        		@if($current)
		        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		        		<h4 class="text-md font-light text-c-pink opacity-75">{{ $current->name }}</h4>
		        	@endif
	        		
	        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        		<h4 class="text-md font-light text-c-pink opacity-75">Events</h4>
	        	</div>
        		
        		<span class="pb-4 text-c-pink">{{ ($count < 9) ? $count : '9' }} of {{ $count }} @if(request()->search) found @endif</span>
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
			        				
			        				<img  class="w-full mb-5 rounded " src="{{ asset('/images/placeholder.png') }}" alt="">
			        			</a>
			        		
			        		</div>
		        		</div>
	        			<div class="sm:ml-3 py-3 w-full sm:w-2/3 flex flex-col items-start justify-between">
	        				<h5 class="mb-3 text-lg text-c-dark-gray">{{ $event->title }}</h5>
	        				<p class="mb-3 text-lg text-c-dark-gray">{{ $event->description }}</p>	
	        				<p class="mb-3 text-lg text-c-dark-gray">$ {{ $event->price }}</p>
	        			</div>
	        			
	        		</div>
	        	@empty
	        		<p>No event yet.</p>
	        	@endforelse
	        </div>

	
	        <div class=" flex justify-center items-center my-6">
	        	@if($events->appends(request()->input())->previousPageUrl())
	        	<a class="px-6 py-3 rounded text-c-dark-gray border-1 hover:bg-c-dark-gray hover:text-white" href="{{ $events->appends(request()->input())->previousPageUrl()}}">
	        		Prev
	        	</a>
	        	@else
	        	<span class="px-6 py-3 rounded text-c-dark-gray border-1 hover:bg-c-dark-gray hover:text-white">
	        		Prev
	        	</span>
	        	
	        	@endif
	        	<span class="px-6 py-3 rounded text-c-dark-gray border-1 hover:bg-c-dark-gray hover:text-white">{{ $events->appends(request()->input())->currentPage() }}</span>
	        	@if($events->appends(request()->input())->nextPageUrl())
	        	<a class="px-6 py-3 rounded text-c-dark-gray border-1 hover:bg-c-dark-gray hover:text-white" href="{{ $events->appends(request()->input())->nextPageUrl()}}">
	        		Next
	        	</a>
	        	@else
	        	<span class="px-6 py-3 rounded-lg  text-transparent">
	        		Next
	        	</span>
	        	@endif
	        </div>
        </div>

        <div class="w-full md:w-48 flex flex-col items-start">
        	{{-- <form action="{{ route('events.all') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex items-center w-full mb-3">

    				<input type="text" name="search" class="w-full px-3 py-2 rounded border-1 border-c-light-gray" value="{{ request()->search }}" placeholder="Wvent name">
    							
    			</div>
    		</form> --}}
        	{{-- <h3 class="mb-3">Categories</h3> --}}
        	<div class="md:ml-3 pb-5 md:pb-0 flex flex-row md:flex-col items-start overflow-x-scroll w-full md:overflow-x-auto">
	        	@forelse($categories as $category)
	        		<a  class="w-full pr-4 py-2 text-c-pink hover:opacity-75" href="{{ url('events?category=' . $category->id . '&slug='. $category->slug) }}">{{ $category->name }}</a>
	        	@empty
	        		<p>No category yet.</p>
	        	@endforelse
	        </div>
        </div>
    </div>

@endsection
