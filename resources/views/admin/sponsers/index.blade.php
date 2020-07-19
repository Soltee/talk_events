@extends('layouts.admin')

@section('content')
    <div class="px-3 md:px-6 pb-6">

        <p class="my-2 text-red-600">{{ session('success') }}</p>
        <p class="my-2 text-red-600">{{ session('error') }}</p>
           
        @can('add sponsers')
    		<a href="{{ route('sponser.create') }}" class="fixed right-0 bottom-0 mr-3 md:mr-16 mb-6 md:mb-16 text-xl font-3xl text-white bg-blue-600 rounded-full px-6 py-5  hover:opacity-75">+</a>
    	@endcan

        <div class="flex justify-between items-center  mb-6">

       		<h3 class="text-gray-900 text-lg ">
       			<a href="{{ route('sponsers') }}">Sponsers</a>
       		</h3>
    		<form action="{{ route('sponsers') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex items-center justify-between">

    				<input type="text" name="filter[full_name]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['full_name'] ?? '' }}" placeholder="Name">
    				<input type="text" name="filter[company_name]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['email'] ?? '' }}" placeholder="Company">
    				<input type="text" name="filter[email]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['company_name'] ?? '' }}" placeholder="Email">
    			
			
					<button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
		    			Search
		    		</button>	
    			</div>
    		</form>

    	
    	</div>

        <div id='sponsers' class="w-full">
		 
			
			<table id="example" class="stripe hover w-full">
				<thead>
					<tr>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Avatar</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Fullname</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Email</th>

						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Company</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Link</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600">Event</th>
						<th class="px-4 py-4 text-left text-capitalize text-gray-600"></th>
					</tr>
				</thead>
				<tbody>
					@forelse($sponsers as $sponser)
					<tr>
						
							<td class="border px-4 py-4">
								{{-- <a href="{{ route('sponser.show', $sponser->id) }}">
									<img class="" src="{{ $sponser->avatar }}" >
								</a> --}}
							</td>
							<td class="border px-4 py-4">
								<a class="text-blue-600" href="{{ route('sponser.show', $sponser->id) }}">
									{{ $sponser->full_name }}
								</a>
							</td>
							<td class="border px-4 py-4">{{ $sponser->email }}</td>
					

							

							<td class="border px-4 py-4">{{ $sponser->company_name }}</td>
							<td class="border px-4 py-4">{{ $sponser->company_link }}</td>
							<td class="border px-4 py-4">{{ $sponser->events_count }}</td>
							<td class="border px-4 py-4">
								<div class="flex items-center">
									<a class="text-blue-600 mr-5" href="{{ route('sponser.edit', $sponser->id) }}">
										Edit
									</a>	
									<form method="POST" action="{{ route('sponser.destroy', $sponser->id) }}">
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
							<td class="border px-4 py-4">No sponser yet.</td>
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
