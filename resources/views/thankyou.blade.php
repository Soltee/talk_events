@extends('layouts.app')

@section('styles')

@endsection 

@section('content')
       
    <div class="w-full flex flex-col md:flex-row justify-center  px-6 md:px-24  lg:px-40  my-8">

    	<div class="">

    		<div class=" border-2 border-gray-300 rounded-lg p-3">
	    		<div class="flex items-center my-3">
	    			<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-c-light-green mr-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
    				<p class="text-c-dark-gray leading-relaxed">T{{ session('success') }} Check out <a href="/shop" class="text-c-pink hover:opacity-75">some more</a>.</p>
    			</div>

    			<div class="my-5">
    				<div class=" border-2 border-gray-300 rounded-lg p-3 mb-5">
		    			<h4 class="text-sm text-c-light-blue">Personal Info</h4>

		    			<div class="my-5">
			    			<div class="flex items-center mb-4">
				    			<div class="md:w-1/2 md:mr-2 flex flex-col text-lg text-c-dark-gray">
				    				{{ $booking->first_name . ' ' . $booking->last_name  }}
				    			</div>
			    			</div>
			    			<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
				    			{{ $booking->email }}
				    		</div>
		    			</div>

		    		</div>

		    		<div class=" border-2 border-gray-300 rounded-lg p-3 mb-5">
		    			<h4 class="text-sm text-c-light-blue">Payment Info</h4>
		    			<div class="my-5">
			    			
			    			<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
				    			$ {{ $booking->payment_type }}
				    		</div>
				    		<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
				    			$ {{ $booking->sub_total }}
				    		</div>
				    		<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
				    			$ {{ $booking->taxes }}
				    		</div>
				    		<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
				    			$ {{ $booking->grand_total }}
				    		</div>
		    			</div>
		    		</div>
    			</div>

    		</div>

    	</div>


    </div>

@endsection

<script>
    window.addEventListener('DOMContentLoaded', function(){
        
       
    });
</script>
