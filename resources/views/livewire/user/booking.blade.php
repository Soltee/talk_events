<div>
	@if (session()->has('error'))
		<div class="my-4  flex flex-col justify-center items-center w-full">
	  		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
	  		<p class="mt-3 text-red-500">{{ session('error') }}</p>
		</div>

	@else

    @if (session()->has('success'))

        <div class=" flex flex-row justify-center items-center w-full">
  		
	  		<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
	  		<p class="ml-3 text-green-500">{{ session('success') }}</p>
		</div>

    @else 
	   	<form
	    	id="bookForm"
	    	method="POST"
	    	>   
			@csrf
				{{-- @if(!$step) --}}
	    		<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
	    	
	    			<div class="mt-5 mb-3">
		    			<div class="flex flex-col items-center mb-4">
			    			<div  class="w-full flex flex-col mb-4">
			    				<label for="first_name" class="mb-2 text-c-lighter-black text-sm">First name</label>
			    				<input type="text" wire:model="first_name" value="{{ old('first_name') ?? ($auth ? $auth->first_name : '') }}" class="px-6 py-3 rounded-md border border-gray-300" placeholder="Shraddha">
			    				<div class="mt-2 ">
			    					@error('first_name')
					                    <p class="text-red-500 text-xs italic mt-4">
					                        {{ $message }}
					                    </p>
					                @enderror
			    				</div>
			    			</div>
			    			<div  class="w-full flex flex-col mb-3">
			    				<label for="last_name" class="text-c-lighter-black text-sm mb-2">Last name</label>
			    				<input type="text" wire:model="last_name" value="{{ old('last_name') ?? ($auth ? $auth->last_name : '') }}" class="px-6 py-3 rounded-lg border border-gray-300" placeholder="Shrestha">
			    				<div class="mt-2">
			    					@error('last_name')
					                    <p class="text-red-500 text-xs italic mt-4">
					                        {{ $message }}
					                    </p>
					                @enderror
			    				</div>
			    			</div>
		    			</div>

		    	
		    			<div  class="flex flex-col mb-4">
			    				<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Email</label>
			    				<input type="email" wire:model="email" value="{{ old('email') ?? ($auth ? $auth->email : '') }}" class="px-6 py-3 rounded-lg border border-gray-300" placeholder="shrastha@gmail.com">
			    		</div>

			    		@error('email')
		                    <p class="text-red-500 text-xs italic my-4">
		                        {{ $message }}
		                    </p>
		                @enderror
	    			</div>		    			
	    		</div>
	    		{{-- @endif --}}

	    		
	    		@if($event->price > 0)
	    			
		    			<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
		    			<div wire:ignore class="flex flex-col">
		    				<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Card</label>
		    				<div 
				    			>
						        <input type="hidden" name="payment_type" value="stripe">
						        <div class="flex flex-col">
						          
						            <div id="card-element" class="mb-3">
						              <!-- A Stripe Element will be inserted here. -->
						            </div>

						            <!-- Used to display form errors. -->
						            <div id="card-errors" role="alert"></div>
						        </div>
						    </div>
						</div>
					</div>
		    		@if($step)

						<div  class="flex w-full justify-end mb-4 cursor-pointer">
		    				<div wire:click.prevent="book" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline flex justify-around items-center">

		                    	<div wire:loading class="spinner">
								  <div class="bounce1"></div>
								  <div class="bounce2"></div>
								  <div class="bounce3"></div>
								</div>
		                    	<span wire:loading.remove class="font-semibold">{{ __('Confirm') }} {{ $event->price ? '$'. $event->price : '' }}</span>
		                    </div>
						</div>
		    		@else
		    			<div id="payBtn" class="flex w-full justify-end mb-4 cursor-pointer">
		    				<div wire:click="validateData" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline flex justify-around items-center">

		                    	<div wire:loading class="spinner">
								  <div class="bounce1"></div>
								  <div class="bounce2"></div>
								  <div class="bounce3"></div>
								</div>
		                    	<span wire:loading.remove class="font-semibold">{{ __('Pay Now') }} {{ $event->price ? '$'. $event->price : '' }}</span>
		                    </div>
						</div>
					@endif
				@else
	    			<div id=""  class="flex w-full justify-end mb-4">
						<button wire:click.prevent="book" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline flex justify-around items-center">

	                    	<div wire:loading class="spinner">
							  <div class="bounce1"></div>
							  <div class="bounce2"></div>
							  <div class="bounce3"></div>
							</div>
	                    	<span wire:loading.remove class="font-semibold">{{ __('Pay Now') }}</span>
	                    </button>
					</div>
				@endif
		</form>

	@endif

	@endif

</div>

<script>
    window.addEventListener('DOMContentLoaded', function(){
	//Get the Tabs
        // const stripeTab    = document.getElementById('stripeTab');
        // const khaltiTab = document.getElementById('khaltiTab');
        const bookForm         = document.getElementById('bookForm');


	    //Stripe Confrimation 
	       	// stripeTab.addEventListener('click', () => {
	       		const key = '{{ env('STRIPE_KEY') }}';
	            var stripe = Stripe(`${key}`);
	            // console.log(key, stripe);
	            // Create an instance of Elements.
	            var elements = stripe.elements();

	            // Custom styling can be passed to options when creating an Element.
	            // (Note that this demo uses a wider set of styles than the guide below.)
	            var style = {
	              base: {
	                color: '#32325d',
	                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
	                fontSmoothing: 'antialiased',
	                fontSize: '16px',
	                '::placeholder': {
	                  color: '#aab7c4'
	                },
	                padding:'6px'
	              },
	              invalid: {
	                color: '#fa755a',
	                iconColor: '#fa755a'
	              }
	            };

	            // Create an instance of the card Element.
	            var card = elements.create('card', {style: style});

	            // Add an instance of the card Element into the `card-element` <div>.
	            card.mount('#card-element');

	            // Handle real-time validation errors from the card Element.
	            card.addEventListener('change', function(event) {
	              var displayError = document.getElementById('card-errors');
	              if (event.error) {
	                displayError.textContent = event.error.message;
	              } else {
	                displayError.textContent = '';
	              }
	            });

	            // Handle form submission.
	            document.getElementById('payBtn').addEventListener('click', function(){
	            	stripe.createToken(card).then(function(result) {
		                if (result.error) {
		                  // Inform the user if there was an error.
		                  var errorElement = document.getElementById('card-errors');
		                  errorElement.textContent = result.error.message;
		                } else {
		                  // Send the token to your server.
		                  stripeTokenHandler(result.token);
		                }
	              	});

	            });
	            // bookForm.addEventListener('submit', function(event) {
	            //   event.preventDefault();

	            //   stripe.createToken(card).then(function(result) {
	            //     if (result.error) {
	            //       // Inform the user if there was an error.
	            //       var errorElement = document.getElementById('card-errors');
	            //       errorElement.textContent = result.error.message;
	            //     } else {
	            //       // Send the token to your server.
	            //       stripeTokenHandler(result.token);
	            //     }
	            //   });
	            // });

	           // Submit the form with the token ID.
	            function stripeTokenHandler(token) {
	            	@this.set('stripeToken', token.id);
	            	// @this.set('step', true);
	            	window.livewire.emit('setNextStep');

	            	// document.getElementById('payBtn').style.display="none";
	            	// document.querySelector('.conBtn').classList.remove('hidden');

	            	// component.set('stripeToken', token.id)
	              // Insert the token ID into the form so it gets submitted to the server
	              // var hiddenInput = document.createElement('input');
	              // hiddenInput.setAttribute('type', 'hidden');
	              // hiddenInput.setAttribute('wire:model.lazy', 'stripeToken');
	              // hiddenInput.setAttribute('value', token.id);
	              // bookForm.appendChild(hiddenInput);
	              // document.getElementById('payBtn').style.display="none";
	            	// document.querySelector('.conBtn').classList.remove('hidden');	    
	              // bookForm.submit();
	            }

	       	// });

    });
</script>

