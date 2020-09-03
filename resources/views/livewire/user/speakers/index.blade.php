@section('title', 'Speakers')
@section('head')

@endsection

<div class="w-full">
	<div class="flex justify-between items-center mb-4">
		<div class="flex items-center">
		    <a href="/"><h4 class="text-sm md:text-md font-light hover:font-semibold mr-2">Home</h4></a>

		    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
		    <a href="/speaker" class="text-sm md:text-md font-bold opacity-75">Speakers</a>
		</div>

		<div class="flex justify-between items-center">
    		<input type="text" wire:model="keyword" class=" px-6 py-3 rounded border border-blue-500" value="{{ $keyword }}">
    	</div>


	</div>

	<div class="mt-4">
		<!--- Speakers speakers -->
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
			@forelse($speakers as $speaker)
				<div class="flex flex-col  items-center mb-6 plain-item  items-center
	        		">
        			<div class="img-hover-zoom w-full">
        				<div class="relative">
		        			<a href="{{ url('speakers', $speaker->id . '-' . $speaker->first_name . '-' . $speaker->last_name )}}">
					      		<img src="{{ asset($speaker->avatar) }}" class="w-full  hover:opacity-75  bg-center
					      	bg-cover  rounded-lg">
					        </a>
		        		
		        		</div>
	        		</div>
        			<div class="mt-3 w-full  flex flex-col items-start justify-between">
        				<div class="flex flex-row w-full items-center justify-between mb-5">
        					<a class="" href="{{ url('speakers', $speaker->first_name . '-' . $speaker->last_name )}}">
        						<h5 class="text-lg font-bold text-gray-900 hover:opacity-75">{{ $speaker->first_name . ' ' . $speaker->last_name }}</h5>
        					</a>
        				</div>
	        			<a  href="{{ url('speakers', $speaker->id . '-' . $speaker->first_name . '-' . $speaker->last_name )}}" class="text-blue-600 font-semibold hover:opacity-75">
	        				Show More <span class="ml-3 font-bold text-lg w-12">-</span>
	        			</a>
        			</div>
        			
        		</div>
        	@empty
	        	<div class=" flex flex-col justify-center w-full">
		      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
		      		<p class="mt-3">No speaker yet.</p>
	     		</div>
        	@endforelse

		</div>

		<div class="my-6">
            {{ $speakers->links('vendor.pagination.tailwind') }}
        </div>
	</div>
    

</div>