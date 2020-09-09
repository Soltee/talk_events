@extends('layouts.app')

@section('title')
	Contact-us
@endsection
@section('head')
	
@endsection

@section('content')
	<div class="mb-8">
		<div class="flex justify-between items-center mb-8">

    		<div class="flex items-center">
        		<a href="/"><h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2">Home</h4></a>
        		
        		
        		
        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">Help</h4>

        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">Contact Us</h4>
        	</div>
    		
    	</div>

        	<div>
        		
				<h1 class="text-2xl md:text-5xl text-gray-900 font-semibold mb-4">Contact us</h1>
				<p class="leading-6 mb-3 font-semibold">Together we are strong.</p>

				<livewire:user.contact-us />

        	</div>
	</div>


@endsection