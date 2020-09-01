<div>
	@if (session()->has('error'))
		<div class=" flex flex-col justify-center items-center w-full">
	  		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
	  		<p class="mt-3 text-red-500">{{ session('error') }}</p>
		</div>
	@endif


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
					
	    		<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
	    	
	    			<div class="mt-5 mb-3">
		    			<div class="flex flex-col md:flex-row items-center mb-4">
			    			<div wire:ignore class="w-full md:w-1/2 md:mr-2 flex flex-col">
			    				<label for="first_name" class="mb-2 text-c-lighter-black text-sm">First name</label>
			    				<input type="text" wire:model.lazy="first_name" value="{{ old('first_name') ?? ($auth ? $auth->first_name : '') }}" class="px-6 py-3 rounded-md border border-gray-300" placeholder="Shraddha">
			    				<div class="mt-2 md:hidden">
			    					@error('first_name')
					                    <p class="text-red-500 text-xs italic mt-4">
					                        {{ $message }}
					                    </p>
					                @enderror
			    				</div>
			    			</div>
			    			<div wire:ignore class="w-full md:w-1/2  md:ml-2 flex flex-col">
			    				<label for="last_name" class="text-c-lighter-black text-sm mb-2">Last name</label>
			    				<input type="text" wire:model.lazy="last_name" value="{{ old('last_name') ?? ($auth ? $auth->last_name : '') }}" class="px-6 py-3 rounded-lg border border-gray-300" placeholder="Shrestha">
			    				<div class="mt-2 md:hidden">
			    					@error('last_name')
					                    <p class="text-red-500 text-xs italic mt-4">
					                        {{ $message }}
					                    </p>
					                @enderror
			    				</div>
			    			</div>
		    			</div>

		    			<div class="hidden md:block grid mt-3 md:grid-cols-2 mb-3 w-full justify-between items-center">
			    			<div class="md:w-1/2 md:mr-2 flex flex-col">
			    				@error('first_name')
				                    <p class="text-red-500 text-xs italic mt-4">
				                        {{ $message }}
				                    </p>
				                @enderror
			    			</div>
			    			<div class="md:w-1/2  md:ml-2 flex flex-col">
			    				@error('last_name')
				                    <p class="text-red-500 text-xs italic mt-4">
				                        {{ $message }}
				                    </p>
				                @enderror
			    			</div>
		    			</div>

		    			<div wire:ignore class="flex flex-col mb-4">
			    				<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Email</label>
			    				<input type="email" wire:model.lazy="email" value="{{ old('email') ?? ($auth ? $auth->email : '') }}" class="px-6 py-3 rounded-lg border border-gray-300" placeholder="shrastha@gmail.com">
			    		</div>

			    		@error('email')
		                    <p class="text-red-500 text-xs italic mt-4">
		                        {{ $message }}
		                    </p>
		                @enderror
		                @if($event->price > 0)
		                <div wire:ignore class="flex flex-col mb-4">
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
					    @endif
	    			</div>		    			
	    		</div>

	    		
	    		@if($event->price > 0)
		    		@if($step)
						<div class="conBtn  flex w-full justify-end mb-4">
							

							<div class="flex flex-col">

									<span 
										wire:click="book"
										class="px-10 py-4 rounded bg-blue-500 hover:bg-blue-600 text-white text-lg cursor-pointer">Confirm</span>

							</div>
						</div>
		    		@else
		    			<div id="payBtn"  class="flex w-full justify-end mb-4">
							<span type="span" wire:click="changeStep" class="px-10 py-4 rounded bg-blue-500 hover:bg-blue-600 text-white text-lg cursor-pointer">Pay Now</span>
						</div>
					@endif
				@else
	    			<div id="payBtn"  class="flex w-full justify-end mb-4">
						<span 
							wire:click="book"
							class="px-10 py-4 rounded bg-blue-500 hover:bg-blue-600 text-white text-lg cursor-pointer">Pay Now</span>
					</div>
				@endif
		</form>

	@endif
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    window.addEventListener('DOMContentLoaded', function(){
	//Get the Tabs
        // const stripeTab    = document.getElementById('stripeTab');
        // const khaltiTab = document.getElementById('khaltiTab');
        const bookForm         = document.getElementById('bookForm');


	    //Stripe Confrimation 
	       	// stripeTab.addEventListener('click', () => {
	       		const key = '{{ env('STRIPE_PUBLIC_KEY') }}';
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

