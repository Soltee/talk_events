@extends('layouts.admin')

@section('styles')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/tail.datetime@0.4.13/css/tail.datetime-default.css">
@endsection

@section('content')
    <div class="px-3 md:px-6 pb-6 pt-4">

    	
        <p class="my-2 text-red-600">{{ session('success') }}</p>
        <p class="my-2 text-red-600">{{ session('error') }}</p>
        @if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
        	@csrf
        	@method('PATCH')
	       	<div class="flex justify-between items-center  mb-6">
	       		<div class="flex items-center">
	       			<a href="{{ route('users') }}" class=" text-md font-md text-gray-900   mr-5  hover:opacity-75">Back</a>
	       			<h3 class="text-gray-900 text-lg ">Edit {{ $user->name }}</h3>
	       		</div>

				<button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
	    			Save
	    		</button>	

	    	
	    	</div>

		 
		 	<div class="flex justify-between flex-col md:flex-row">
	    			<div class="flex flex-col md:mr-4 w-full md:w-2/3">

	    				<h4 class="text-md mb-3 ">1. General Info</h4>
	    				<div class="flex flex-wrap mb-6">
	                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('first_name') }}
	                        </label>

	                        <input id="first_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('first_name') border-red-500 @enderror " name="first_name" value="{{ old('first_name') ?? $user->first_name }}"  autofocus placeholder="">

	                        @error('first_name')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <div class="flex flex-wrap mb-6">
	                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Sub Title') }}
	                        </label>

	                        <input id="last_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('last_name') border-red-500 @enderror " name="last_name" value="{{ old('last_name') ?? $user->last_name }}"  autofocus placeholder="">

	                        @error('last_name')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
		                    
	                    <div class="flex flex-wrap mb-8">
	                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Email') }}
	                        </label>

	                        <input id="email" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror " name="email" value="{{ old('email') ?? $user->email }}"  autofocus placeholder="">

	                        @error('email')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	          

	    				

	                     <div class="flex flex-wrap mb-8">
	                        <label for="user_full_address" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('User Address') }}
	                        </label>

	                        <input id="user_full_address" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('user_full_address') border-red-500 @enderror " name="user_full_address" value="{{ old('user_full_address') ?? $event->user_full_address }}"  autofocus placeholder="">

	                        @error('user_full_address')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

						
	    			</div>
	    			<div class="flex flex-col md:pl-2  w-full md:w-1/3">
	    			
	                    <div class="flex flex-wrap mb-6">
	                        <label for="avatar" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('User avatar') }}
	                        </label>

	                        <input id="avatar" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('avatar') border-red-500 @enderror " name="avatar" value="{{ old('avatar') }}"  autofocus placeholder="">

	                        @error('avatar')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                    <img id="avatarImage" src="{{ asset($user->cover) }}" class="mb-6 rounded object-cover object-center">

	    			</div>
	    	</div>

		</form>
    </div>
@endsection

@section('scripts')

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.datetime@0.4.13/js/tail.datetime.min.js"></script>
	<script>

        document.addEventListener("DOMContentLoaded", function(){

        
			let readImage = document.getElementById('avatarImage');

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

@endsection