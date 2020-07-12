@extends('layouts.admin')

@section('content')
    <div class="">
        <div class="">
            <p class="my-2 text-red-600">{{ session('success') }}</p>
            <p class="my-2 text-red-600">{{ session('error') }}</p>
           	
           	<div class="flex justify-between items-center  mb-6">
	    		<form action="{{ route('events') }}" method="get" accept-charset="utf-8">
	    			@csrf
	    			<div class="flex items-center">

	    				<input type="text" name="keyw" class="px-3 py-2  rounded-l-lg border-2 border-gray-400" placeholder="Search Order by title, location, price">
	    				<button type="submit" class="px-3 py-3  rounded-r-lg bg-indigo-600 hover:bg-indigo-500 text-white">
			    			Search
			    		</button>


	    				<span class="ml-6 text-lg font-bold">{{ $total }} Events</span>
						
	    			</div>
	    		</form>

	    	
	    	</div>
            <div id='recipients' class="">
			 
				
				<table id="example" class="stripe hover">
					<thead>
						<tr>
							<th class="text-left p-3">Image</th>
							<th class="text-left p-3">Title</th>
							<th class="text-left p-3">Price</th>
							<th class="text-left p-3">Remaining Days</th>
							<th class="text-left p-3">Ticket</th>
							<th class="text-left p-3">Venue</th>
							<th class="text-left p-3">Created At</th>
						</tr>
					</thead>
					<tbody>
						@forelse($events as $event)
						<tr>
							<td class="p-2 text-left">
								{{-- <img class="" src="{{ $event->cover }}" > --}}
							</td>
							<td class="p-2 text-left">{{ $event->title }}</td>
							<td class="p-2 text-left">$ {{ $event->price }}</td>
							<td class="p-2 text-left">{{ $event->Daysdiff() }}</td>
							<td class="p-2 text-left">{{ $event->ticket }}</td>
							<td class="p-2 text-left">{{ $event->venue_full_address }}</td>
							<td class="p-2 text-left">{{ $event->created_at->diffForHumans() }}</td>
							
						</tr>
						@empty
							<tr>
								<td class="p-2 text-left">No Event yet.</td>
							</tr>
						@endforelse
						
					
					</tbody>
					
				</table>
				
				<div class="my-6 flex justify-between items-center w-full px-4">
					@if($previous)
					<a  class="px-4 py-3 rounded-lg text-indigo-500 text-lg" href="{{ $previous }}">
						Prev
					</a>
					@else
					<span  class="px-4 py-3 rounded-lg text-transparent text-lg">
						Prev
					</span>
					@endif

					@if($next)
					<a  class="px-4 py-3 rounded-lg text-indigo-500 text-lg" href="{{ $next }}">
						Next
					</a>
					@else
					<span  class="px-4 py-3 rounded-lg text-transparent text-lg">
						Next
					</span>
					@endif
				</div>
			</div>
        </div>
    </div>
@endsection
