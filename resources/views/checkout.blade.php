@extends('layouts.app')

@section('styles')

@endsection 

@section('content')
       
    <div class="w-full flex flex-col md:flex-row   px-6 md:px-24  lg:px-40  my-8">

    	<div class="flex-1 flex flex-col">
			<div class="flex items-center mb-4 ">

				<a href="/" class="mr-3" class="flex items-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="transform rotate-180 w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
					<span class="ml-3 text-md">Back</span>
				</a>
				
	        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        		<h4 class="text-md font-light text-c-pink opacity-75">{</h4>
	    		
		    </div>

		    <form method="POST" action="{{ url('event.book' . $event->id . "/book" ) }}">   
	    		@csrf		
		    		<div class="flex flex-col border-2 border-lighter-black rounded-lg p-3 mb-4">
		    			<h3 class="mt-2 mb-3">
		    				<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-c-light-blue">1</span> 
		    				<span class="text-md text-c-light-blue font-semibold">Personal Info</span>
		    			</h3>

		    			<div class="mt-5 mb-3">
			    			<div class="flex flex-col lg:flex-row items-center mb-4">
				    			<div class="lg:w-1/2 lg:mr-2 flex flex-col mb-4">
				    				<label for="first_name" class="mb-2 text-c-lighter-black text-sm">First name</label>
				    				<input type="text" name="first_name" value="{{ $auth ? $auth->first_name : '' }}" class="px-6 py-3 rounded-lg border-2 border-gray-300" placeholder="Shraddha">
				    			</div>
				    			<div class="lg:w-1/2  lg:ml-2 flex flex-col">
				    				<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Last name</label>
				    				<input type="text" name="last_name" value="{{ $auth ? $auth->last_name : '' }}" class="px-6 py-3 rounded-lg border-2 border-gray-300" placeholder="Shrestha">
				    			</div>
			    			</div>
			    			<div class="flex flex-col mb-4">
				    				<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Email</label>
				    				<input type="email" name="email" value="{{ $auth ? $auth->email : '' }}" class="px-6 py-3 rounded-lg border-2 border-gray-300" placeholder="shrastha@gmail.com">
				    		</div>
				    		<div class="flex flex-col mb-4">
				    			<label for="phone_number" class="mb-2 text-c-lighter-black text-sm">Phone number</label>
				    			<div class="flex items-center w-full">
				    				<span class="p-3 border-2 border-lighter-black rounded-lg">+977</span>
				    				<input type="text" name="phone_number" min="1" max="10" class="px-6 py-3 rounded-lg border-2 border-lighter-black flex-1" placeholder="980*******">
				    			</div>
				    		</div>

				    		<div class="flex flex-col mb-4">
				    			<label for="quantity" class="mb-2 text-c-lighter-black text-sm">Quantity</label>
				    			<div class="flex items-center w-full">
				    			
				    				<input type="text" name="quantity" min="1" max="10" class="px-6 py-3 rounded-lg border-2 border-lighter-black flex-1" placeholder="">
				    			</div>
				    		</div>
				    		<div class="flex  flex-col md:flex-row md:items-center mb-4">
			    				<div class="md:w-1/2 md:mr-1 flex flex-col mb-4">
				    				<label for="first_name" class="mb-2 text-c-lighter-black text-sm">Country</label>
				    				<select name="city" class="px-4 py-3 rounded-lg">
				    					<option class="" value="pokhara">Nepal</option>
				    				</select>
					    		</div>
				    			<div class="md:w-1/2  md:ml-1 flex flex-col">
				    				<label for="first_name" class="mb-2 text-c-lighter-black text-sm">City</label>
				    				<select name="city" class="px-4 py-3 rounded-lg">
				    					<option class="" value="pokhara">Pokhara</option>
				    				</select>
				    			</div>
			    			</div>
		    			</div>		    			
		    		</div>

		    		

		    				
			    			
			    		

		    		<div class="flex flex-col border-2 border-lighter-black rounded-lg p-3 mb-4">
		    			<h3 class="mt-2 mb-3">
		    				<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-c-light-blue">3</span> 
		    				<span class="text-md text-c-light-blue font-semibold">Payment Info</span>
		    			</h3>

		    			{{-- <div class="mt-5 mb-3">
			    			<div class="flex flex-col mb-4">
				    				<label for="last_name" class="w-64 mb-2 px-4 py-2 flex items-center border-2 border-c-light-green rounded cursor-pointer">
				    					<svg xmlns="http://www.w3.org/2000/svg" class="rounded-full p-1 border-2 border-c-green   w-8 h-8 text-c-light-green mr-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
				    					<span class="text-md">Cash On Delivery</span>
				    				</label>
				    				<input class="hidden" type="text" value="cash-on-delivery" name="payment_method">
				    		</div>
				    		
		    			</div> --}}

		    			<div class="flex w-full justify-end mb-4">
		    				<button type="submit" class="px-10 py-4 rounded bg-blue-500 hover:bg-blue-600 text-white text-lg cursor-pointer">Pay Now</button>
		    			</div>
		    		</div>
	    	</form>
	    	
		    
		</div>

		<div class="w-1/3">
		</div>


    </div>

@endsection

<script>
    window.addEventListener('DOMContentLoaded', function(){
        
       
    });
</script>
