<div class="my-6">

	@include('partials.user-nav', ['event' => $event['title']])


	<div class="flex justify-between items-center  mb-6">
   		<div class="flex items-center">
   			<a href="/home" class=" text-md font-md text-gray-900   mr-5  hover:opacity-75">Back</a>
   			<h3 class="text-gray-900 text-lg ">{{ $event['title'] }}</h3>
   		</div>

   		<div class="flex items-center">
   			@if($status === 'Incoming')
				
   				<span class="px-3 py-3 text-lg font-bold text-white rounded bg-green-600">
   					{{ $status }}
				</span>
   			@elseif($status === 'Ended')
   				<span class="px-3 py-3 text-lg font-bold text-white rounded bg-red-500">
   					{{ $status }}
				</span>
				<span class="ml-3">{{ $booking->format_date($event['end']) }}</span>
   			@else
				<p class="">
					<span class="ml-3 text-lg font-bold text-gray-900">{{ $status }}
					</span>
				</p>
			@endif
		</div>

		
	</div>

	<div class="flex flex-col md:flex-row">
		<div class="w-full md:w-64">
    		<img class="h-48 rounded w-full md:w-64 object-cover mt-3  mb-6"  src="{{ asset($event['cover']) }}">
    	</div>
    	<div class="flex-1 md:ml-6">
    		<h5 class="mb-4 text-md text-gray-800 px-2">General Info</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Price</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">$ {{ $booking->price }}</h4>
	    	</div>


    		<h5 class="mb-4 text-md text-gray-800 px-2">DateTime</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Start</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $booking->format_date($event['start']) }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Time</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $booking->format_time($event['time']) }}</h4>
	    	</div>
	    	<div class="flex items-center mb-8">
	    		<label for="" class=" border rounded px-4 py-3 w-40">End</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $booking->format_date($event['end']) }}</h4>
	    	</div>

	    	<h5 class="mb-4 text-md text-gray-800 px-2">Venue</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Venue Name</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event['venue_name'] }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Venue Name</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $event['venue_full_address'] }}</h4>
	    	</div>

	    	<!-- Payment -->
	    	<h5 class="mb-4 text-md text-gray-800 px-2">Payment</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Type</label>
	    		<h4 class=" ml-3 rounded font-bold text-gray-800">{!! $booking->typeOfPayment() !!}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">SubTotal</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">$ {{ $booking->sub_total }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Taxes</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">$ {{ $booking->taxes }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Grand Total</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">$ {{ $booking->grand_total }}</h4>
	    	</div>
        </div>
   
    </div>