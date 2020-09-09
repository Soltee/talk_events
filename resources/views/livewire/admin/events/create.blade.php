@section('title', 'Events')
@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.min.css') }}">
  	<script src="{{ asset('js/trix.min.js') }}"></script>
@endsection

<div class="">
	@if($modal)
	<div 	
		>
    	@include('partials.modal', [
    		'key' => '', 
    		'modal' => $modal,
    		'status' => $status 
    		])
    </div>
    @endif

		<form wire:submit.prevent="store" enctype="multipart/form-data">
	        @csrf
			<div class="flex justify-between items-center  mb-6">

		        <div class="flex items-center">
		            @include('partials.admin-breadcrumb', ['url' => '/admin/events', 'link' => true, 'pageName' => 'Events', 'routeName' => Route::currentRouteName()])
		            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
				    <h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 font-semibold">Add Event</h4>
		        </div>

		        <button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
		    			Publish
		    	</button>
			
			</div>
			 
		 	<div class="flex justify-between flex-col md:flex-row">
	    			<div class="flex flex-col md:mr-4 w-full md:w-1/2">

	    				<h4 class="text-md mb-3 ">1. General Info</h4>
	    				<div class="flex flex-wrap mb-6">
	                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Title') }}
	                        </label>

	                        <input id="title" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror " wire:model="title" value="{{ $title }}"  autofocus placeholder="">

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

	                        <input id="subtitle" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('sub_title') border-red-500 @enderror " wire:model="sub_title" value="{{ $sub_title }}"  autofocus placeholder="">

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

	                        <input id="price" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror " wire:model="price" value="{{ $price }}"  autofocus placeholder="">

	                        @error('price')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	    				<h4 class="text-md mb-3 ">2. Datetime & Ticket</h4>
	                    <div class="flex flex-col">
		                    <div class="flex flex-wrap mb-6">
		                        <label for="start" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Start') }}
		                        </label>

		                        <input id="start" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('start') border-red-500 @enderror " wire:model="start" value="{{ $start }}"  autofocus placeholder="">

		                        @error('start')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
		                    <div class="flex flex-col mb-6">
		                        <label for="time" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Time') }}
		                        </label>

		                        <input id="time" type="time"  class="datetime-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('time') border-red-500 @enderror " wire:model="time" value="{{ $time }}"  autofocus placeholder="">

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

		                        <input id="end" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('end') border-red-500 @enderror " wire:model="end" value="{{ $end }}"  autofocus placeholder="">

		                        @error('end')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
	                    </div>
	                    
	                    <div class="flex justify-between items-center">
		                    <div class="flex flex-col mb-6">
		                        <label for="book_before" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Book Before') }}
		                        </label>

		                        <input id="book_before" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_before') border-red-500 @enderror " wire:model="book_before" value="{{ $book_before }}"  autofocus placeholder="">

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

		                        <input id="ticket" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('ticket') border-red-500 @enderror " wire:model="ticket" value="{{ $ticket }}"  autofocus placeholder="">

		                        @error('ticket')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
	                    </div>
	                    <div class="mb-8" >
					        <label class="block text-gray-700 text-sm text-xl font-bold mb-2" for="order">
					            Description
					        </label>
					        <textarea id="body" wire:model="description"  wire:ignore >
					        	{{ $description }}
					        </textarea>
					        {{-- <trix-editor input="body"></trix-editor> --}}
					        @error('description')
					        <p class="text-red-700 font-semibold mt-2">
					            {{$message}}
					        </p>
					        @enderror
					    </div>

	    				<h4 class="text-md mb-3 ">3. Place Info</h4>
	                    <div class="flex flex-wrap mb-6">
	                        <label for="venue_name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Venue') }}
	                        </label>

	                        <input id="venue_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('venue_name') border-red-500 @enderror " wire:model="venue_name" value="{{ $venue_name }}"  autofocus placeholder="">

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

	                        <input id="venue_full_address" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('venue_full_address') border-red-500 @enderror " wire:model="venue_full_address" value="{{ $venue_full_address }}"  autofocus placeholder="">

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

	                        <input id="cover" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cover') border-red-500 @enderror " wire:model="cover" value="{{ $cover }}"  autofocus placeholder="">

	                        @error('cover')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <img id="coverImage" class="mb-6 rounded object-cover object-center">
	                    
	                    <div class="flex flex-wrap mb-6">
	                        
	                    	<label for="category" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Category') }}
	                        </label>
	                        <div class="inline-block relative w-full">
							  <select wire:model="category" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
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
	                           
	                            <select id="slim-speakers" multiple wire:model="speakers" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								  	@forelse($new_speakers as $speaker)
								  	{{$speaker->first_name}}
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
	                        		{{-- {{  $sponsers }} --}}
	                            <select 
	                                id="slim-sponsers" 
	                                multiple 
	                                wire:model="sponsers" class="block appearance-none w-full border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
	                                >
	                                    <option data-placeholder="true"></option>
	                                    @forelse($new_sponsers as $sponser)
	                                        <option value="{{ $sponser->id }}">{{ $sponser->full_name }} </option>
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


@push('scripts')

	<script>

        document.addEventListener("DOMContentLoaded", function(){


		});		
		
	</script>

@endpush