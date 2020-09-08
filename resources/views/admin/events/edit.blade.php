@extends('layouts.admin')

@section('head')
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
     <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.min.css') }}">
  	<script src="{{ asset('js/trix.min.js') }}"></script>
@endsection

@section('content')
    <div class="px-3 md:px-6 pb-6 pt-4">

        <form method="POST" action="{{ route('event.update', $event->id) }}" enctype="multipart/form-data">
        	@csrf
        	@method('PATCH')
        	<div class="flex justify-between items-center  mb-6">

		        <div class="flex items-center">
		            @include('partials.admin-breadcrumb', ['url' => '/admin/events', 'link' => true, 'pageName' => 'Events', 'routeName' => Route::currentRouteName()])
		            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
				    <h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 font-semibold">Edit {{ $event->title }}</h4>
		        </div>

		        <button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
		    			Save
		    	</button>
			
			</div>

		 
		 	<div class="flex justify-between flex-col md:flex-row">
	    			<div class="flex flex-col md:mr-4 w-full md:w-1/2">

	    				<h4 class="text-md mb-3 ">1. General Info</h4>
	    				<div class="flex flex-wrap mb-6">
	                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Title') }}
	                        </label>

	                        <input id="title" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror " name="title" value="{{ old('title') ?? $event->title }}"  autofocus placeholder="">

	                        @error('title')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <div class="flex flex-wrap mb-6">
	                        <label for="subtitle" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Sub Title') }}
	                        </label>

	                        <input id="subtitle" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('sub_title') border-red-500 @enderror " name="sub_title" value="{{ old('sub_title') ?? $event->sub_title }}"  autofocus placeholder="">

	                        @error('sub_title')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
		                    
	                    <div class="flex flex-wrap mb-8">
	                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Price') }}
	                        </label>

	                        <input id="price" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror " name="price" value="{{ old('price') ?? $event->price }}"  autofocus placeholder="">

	                        @error('price')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	    				<h4 class="text-md mb-3 ">2. Datetime & Ticket</h4>
	                    <div class="flex justify-between items-center">
		                    <div class="flex flex-wrap mb-6">
		                        <label for="start" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Start') }}
		                        </label>

		                        <input id="start" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('start') border-red-500 @enderror " name="start" value="{{  $event->actual_date($event->start) }}"  autofocus placeholder="">

		                        @error('start')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
		                    <div class="flex flex-wrap mb-6">
		                        <label for="time" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Time') }}
		                        </label>

		                        <input id="time" type="time"  class="datetime-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('time') border-red-500 @enderror " name="time" value="{{ old('time') ?? $event->time }}"  autofocus placeholder="">

		                        @error('time')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
		                    <div class="flex flex-wrap mb-6">
		                        <label for="end" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Finish') }}
		                        </label>
		                        <input id="end" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('end') border-red-500 @enderror " name="end" value="{{ old('end') ?? $event->actual_date($event->end) }}"  autofocus placeholder="">

		                        @error('end')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
	                    </div>
	                    
	                    <div class="flex justify-between items-center">
		                    <div class="flex flex-wrap mb-6">
		                        <label for="book_before" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Book Before') }}
		                        </label>

		                        <input id="book_before" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_before') border-red-500 @enderror " name="book_before" value="{{ old('book_before') ?? $event->book_before }}"  autofocus placeholder="">

		                        @error('book_before')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
		                    <div class="flex flex-wrap mb-6">
		                        <label for="ticket" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Ticket') }}
		                        </label>

		                        <input id="ticket" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('ticket') border-red-500 @enderror " name="ticket" value="{{ old('ticket') ?? $event->ticket }}"  autofocus placeholder="">

		                        @error('ticket')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
	                    </div>
	                    <div class="flex flex-wrap mb-8">
	                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Description') }}
	                        </label>

	                        <textarea id="description" type="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 -40 @enderror " name="description" value=""  rows="10">
	                        	
	                        		{{ old('description') ?? $event->description }}
	                        </textarea>

	                        @error('description')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	    				<h4 class="text-md mb-3 ">3. Place Info</h4>
	                    <div class="flex flex-wrap mb-6">
	                        <label for="venue_name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Venue') }}
	                        </label>

	                        <input id="venue_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('venue_name') border-red-500 @enderror " name="venue_name" value="{{ old('venue_name') ?? $event->venue_name }}"  autofocus placeholder="">

	                        @error('venue_name')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                     <div class="flex flex-wrap mb-8">
	                        <label for="venue_full_address" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Venue Address') }}
	                        </label>

	                        <input id="venue_full_address" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('venue_full_address') border-red-500 @enderror " name="venue_full_address" value="{{ old('venue_full_address') ?? $event->venue_full_address }}"  autofocus placeholder="">

	                        @error('venue_full_address')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

						
	    			</div>
	    			<div class="flex flex-col md:pl-2  w-full md:w-1/2">
	    			
	                    <div class="flex flex-wrap mb-6">
	                        <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('4. Event Cover') }}
	                        </label>

	                        <input id="cover" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cover') border-red-500 @enderror " name="cover" value="{{ old('cover') }}"  autofocus placeholder="">

	                        @error('cover')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                    <img id="coverImage" src="{{ asset($event->cover) }}" class="mb-6 rounded object-cover object-center">
	                    
	                    <div class="flex flex-wrap mb-6">
	                        
	                    	<label for="category" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Category') }}
	                        </label>
	                        <div class="inline-block relative w-full">
							  <select name="category" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
							  	<option value="{{ $cat->id }}" selected="">{{ $cat->name }}</option>
							  	@forelse($categories as $category)
							    	<option value="{{ $category->id }}">{{ $category->name }}</option>
							    @empty
							    @endforelse
							  </select>
							  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
							    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
							  </div>
							</div>

	                        @error('category')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                    <h4 class="text-md mb-3 ">5. Speakers </h4>
	                    <div class="flex flex-wrap mb-6">
	                        @error('speakers')
	                            <p class="text-red-500 text-xs italic my-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                      
	                        <div class="inline-block relative w-full">
	                            <select 
	                                id="slim-speakers" 
	                                multiple 
	                                name="speakers[]" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
	                                >
	                                    <option data-placeholder="true"></option>
	                                    @forelse($speakers as $speaker)
	                                        <option selected value="{{ $speaker->id }}">{{ $speaker->first_name }} {{ $speaker->last_name }}</option>
	                                    @empty
	                                    @endforelse

	                                    @forelse($new_speakers as $speaker)
	                                        <option value="{{ $speaker->id }}">{{ $speaker->first_name }} {{ $speaker->last_name }}</option>
	                                    @empty
	                                    @endforelse

	                            </select>
	                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
	                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
	                            </div>
	                        </div>

	                    </div>

	                    <h4 class="text-md mb-3 ">6. Sponser </h4>
	                    <div class="flex flex-wrap mb-6">
	                        @error('sponsers')
	                            <p class="text-red-500 text-xs italic my-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                      
	                        <div class="inline-block relative w-full">
	                            <select 
	                                id="slim-sponsers" 
	                                multiple 
	                                name="sponsers[]" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
	                                >
	                                    <option data-placeholder="true"></option>
	                                    @forelse($sponsers as $sponser)
	                                        <option selected value="{{ $sponser->id }}">{{ $sponser->full_name }} </option>
	                                    @empty
	                                    @endforelse
	                                    @forelse($new_sponsers as $sponser)
	                                        <option value="{{ $sponser->id }}">{{ $sponser->full_name }}</option>
	                                    @empty
	                                    @endforelse

	                            </select>
	                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
	                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
	                            </div>
	                        </div>

	                    </div>

	    			</div>
	    	</div>

		</form>
    </div>
@endsection

@push('scripts')

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.datetime@0.4.13/js/tail.datetime.min.js"></script>
	<script>

        document.addEventListener("DOMContentLoaded", function(){

        	document.querySelector("#time").value = "{{ $event->time }}";

        	function outPut(date){
        		const reTime = /^([0-1][0-9]|2[0-3]):[0-5][0-9]$/;
			    const time = this.date;
			    if (reTime.exec(time)) {
			        const minute = Number(time.substring(3,5));
			        const hour = Number(time.substring(0,2)) % 12 + (minute / 60);
			   } 
        	};

        	var speakers =  new SlimSelect({
              select: '#slim-speakers',
                placeholder: 'Select Speakers'
            });

            var sponsers =  new SlimSelect({
              select: '#slim-sponsers',
                placeholder: 'Select Sponsers'
            });

            // console.log(select.selected());


			let readImage = document.getElementById('coverImage');

			var file = document.querySelector('input[type=file]');
			file.addEventListener('change', function(e){

				var reader = new FileReader(); // Creating reader instance from FileReader() API

				reader.addEventListener("load", function () { // Setting up base64 URL on image
				    readImage.classList.add('h-40');
	            	readImage.src = reader.result;

				}, false);

				reader.readAsDataURL(e.target.files[0]);
				console.log(readImage);
			});  // File refrence

		});		
		
	</script>

@endpush