@extends('layouts.admin')

@section('content')
    <div class="px-3 md:px-6 pb-6">

    	@can('add events')
    		<a href="{{ route('event.create') }}" class="fixed right-0 bottom-0 mr-3 md:mr-8 mb-3 md:mb-8 text-xl font-3xl text-white bg-blue-600 rounded-full px-6 py-5  hover:opacity-75">+</a>
    	@endcan

        <p class="my-2 text-red-600">{{ session('success') }}</p>
        <p class="my-2 text-red-600">{{ session('error') }}</p>
           	
       	<div class="flex justify-between items-center  mb-6">

       		<h3 class="text-gray-900 text-lg ">Events</h3>
    		<form action="{{ route('events') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex items-center justify-between">

    				<input type="text" name="keyw" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Search Order by title, location, price">
			
					<button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
		    			Search
		    		</button>	
    			</div>
    		</form>

    	
    	</div>

        <div id='events' class="">
		 
			
			<table id="example" class="stripe hover">
				<thead>
					<tr>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Image</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Title</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Price</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Date</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Ticket</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Venue</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Created At</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600"></th>
					</tr>
				</thead>
				<tbody>
					@forelse($events as $event)
					<tr>
						
							<td class="border px-4 py-4">
								{{-- <a href="{{ route('event.show', $event->id) }}">
									<img class="" src="{{ $event->cover }}" >
								</a> --}}
							</td>
							<td class="border px-4 py-4">
								<a class="text-blue-600" href="{{ route('event.show', $event->id) }}">
									{{ $event->title }}
								</a>
							</td>
							<td class="border px-4 py-4">$ {{ $event->price }}</td>
							{{-- <td class="border px-4 py-4"> {{ $event->start .'-'. $event->end }}</td> --}}
							<td class="border px-4 py-4">{{ $event->format_date($event->date) }}</td>
							<td class="border px-4 py-4">{{ $event->ticket }}</td>
							<td class="border px-4 py-4">{{ $event->venue_full_address }}</td>
							<td class="border px-4 py-4">{{ $event->created_at->diffForHumans() }}</td>
							<td class="border px-4 py-4">
								<a class="text-blue-600" href="{{ route('event.edit', $event->id) }}">
									Edit
								</a>								
							</td>
						</a>
						
					</tr>
					@empty
						<tr>
							<td class="border px-4 py-4">No Event yet.</td>
						</tr>
					@endforelse
					
				
				</tbody>
				
			</table>
			
			<div class="my-6 flex justify-between items-center">
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
@endsection
