@extends('layouts.admin')

@section('content')
    <div class="px-3 md:px-6 pb-6">

    	@can('add events')
    		<a href="{{ route('event.create') }}" class="fixed right-0 bottom-0 mr-3 md:mr-8 mb-3 md:mb-8 text-xl font-3xl text-white bg-blue-600 rounded-full px-6 py-5  hover:opacity-75">+</a>
    	@endcan

        <p class="my-2 text-red-600">{{ session('success') }}</p>
        <p class="my-2 text-red-600">{{ session('error') }}</p>
           	
       	<div class="flex justify-between items-center  mb-6">

       		<h3 class="text-gray-900 text-lg ">
       			<a href="{{ route('events') }}">Events</a>
       		</h3>
    		<form action="{{ route('events') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex items-center justify-between">

    				<input type="text" name="filter[title]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['title'] ?? '' }}" placeholder="Title">
    				<input type="text" name="filter[venue_name]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['venue_name'] ?? '' }}" placeholder="Venue">
    				<input type="date" name="filter[starts_at]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['starts_at'] ?? '' }}" placeholder="Start Date">
    			
			
					<button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
		    			Search
		    		</button>	
    			</div>
    		</form>

    	
    	</div>

        <div class="mt-6 overflow-x-scroll md:overflow-x-auto ">
                <table class=" min-w-full  table-auto">
				<thead>
					<tr>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Image</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Title</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Price</th>

						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Ticket</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Venue</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Start</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600"></th>
					</tr>
				</thead>
				<tbody>
					@forelse($events as $event)
					<tr>
						
							<td class="border px-4 py-4 whitespace-no-wrap">
								{{-- <a href="{{ route('event.show', $event->id) }}">
									<img class="" src="{{ $event->cover }}" >
								</a> --}}
							</td>
							<td class="border px-4 py-4 whitespace-no-wrap">
								<a class="text-blue-600" href="{{ route('event.show', $event->id) }}">
									{{ $event->title }}
								</a>
							</td>
							<td class="border px-4 py-4 whitespace-no-wrap">$ {{ $event->price }}</td>
					

							

							<td class="border px-4 py-4 whitespace-no-wrap">{{ $event->ticket }}</td>
							<td class="border px-4 py-4 whitespace-no-wrap">{{ $event->venue_full_address }}</td>
							<td class="border px-4 py-4 whitespace-no-wrap">{{ $event->format_date($event->start) }}</td>
							<td class="border px-4 py-4 whitespace-no-wrap">
								<div class="flex items-center">
									<a class="text-blue-600 mr-5" href="{{ route('event.edit', $event->id) }}">
										Edit
									</a>	
									<form method="POST" action="{{ route('event.destroy', $event->id) }}">
										@csrf
										@method('DELETE')
										<button type="submit" class="px-6 py-3 bg-red-600 hover:opacity-75 text-white rounded">Drop</button>
									</form>						
								</div>	
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
				<div class="flex items-center">
					Showing {{ $first }} - {{ $last }} of {{ $total }}
				</div>
				<div class="flex justify-between items-center">
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
