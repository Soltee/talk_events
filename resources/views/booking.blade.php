@extends('layouts.app')

@section('head')

	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>    
    {{-- <script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script> --}}
    <script src="https://js.stripe.com/v3/"></script>
    <style type="text/css">
            /**
             * The CSS shown here will not be introduced in the Quickstart guide, but shows
             * how you can use CSS to style your Element's container.
             */
            .StripeElement {
              box-sizing: border-box;

              height: 40px;

              padding: 10px 12px;

              border: 1px solid transparent;
              border-radius: 4px;
              background-color: white;

              box-shadow: 0 1px 3px 0 #e6ebf1;
              -webkit-transition: box-shadow 150ms ease;
              transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
              box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
              border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
              background-color: #fefde5 !important;
            }
    </style>

@endsection 

@section('content')
       
    <div class="w-full flex flex-col  px-6 md:px-24  lg:px-40  my-8">
    	<p class="text-red-600 my-4">{{ session('error') }}</p>

    	<div class="flex-1 flex flex-col">
		
		    {{-- <livewire:user.booking  :event="$event"/> --}}
	     
		  </div>

    </div>

@endsection
@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function(){
        //Get the Tabs
        const stripeTab    = document.getElementById('stripeTab');
        // const khaltiTab = document.getElementById('khaltiTab');
        const bookForm         = document.getElementById('bookForm');

     //    var config = {
     //        // replace the publicKey with yours
     //        "publicKey": "<?php echo env('KHALTI_PUBLIC_KEY'); ?>",
     //        "productIdentity": "{{ $event->id }}",
     //        "productName": "{{ $event->title }}",
     //        "productUrl": "{{ $event->cover }}",
     //        "paymentPreference": [
     //            // "MOBILE_BANKING",
     //            "KHALTI",
     //            // "EBANKING",
     //            // "CONNECT_IPS",
     //            // "SCT",
     //            ],
     //        "eventHandler": {
     //            onSuccess (payload) {
     //                // hit merchant api for initiating verfication
     //                console.log(payload);
     //                //Payment Typed
	    //             // hit merchant api for initiating verfication
	    //             var hiddenInput = document.createElement('input');
		   //          hiddenInput.setAttribute('type', 'hidden');
		   //          hiddenInput.setAttribute('name', 'payment_type');
		   //          hiddenInput.setAttribute('value', 'khalti');
		   //          bookForm.appendChild(hiddenInput);

		   //          //Khalti Token
		   //          var hiddenInput = document.createElement('input');
		   //          hiddenInput.setAttribute('type', 'hidden');
		   //          hiddenInput.setAttribute('name', 'khalti_token');
		   //          hiddenInput.setAttribute('value', payload.token);
		   //          bookForm.appendChild(hiddenInput);

     //            //Khalti Amount
     //            var hiddenInput = document.createElement('input');
     //            hiddenInput.setAttribute('type', 'hidden');
     //            hiddenInput.setAttribute('name', 'khalti_amount');
     //            hiddenInput.setAttribute('value', payload.amount);
     //            bookForm.appendChild(hiddenInput);


		   //          // submit form
		   //          bookForm.submit();
     //            },
     //            onError (error) {
     //                console.log(error);
     //                var hiddenInput = document.createElement('p');
		   //          hiddenInput.setAttribute('class', 'text-red-600 text-lg');
		   //          if(error.detail){
		   //          	hiddenInput.setAttribute('value', error.payload.detail);		     
		   //          }
		   //          if(error.payload.detail){
		   //          	hiddenInput.setAttribute('value', error.payload.detail);		     
		   //          }
		   //          bookForm.appendChild(hiddenInput);
     //            },
     //            onClose () {
     //                console.log('widget is closing');
     //            }
     //        }
     //    };

     //    var checkout = new KhaltiCheckout(config);

     //    const total         = "{{ $total }}";

	    // khaltiTab.onclick = function () {
	    //     checkout.show({amount: total});
	    // }

	    //Stripe Confrimation 
       	stripeTab.addEventListener('click', () => {
       		const key = '{{ env('STRIPE_PUBLIC_KEY') }}';
            var stripe = Stripe(`${key}`);
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
                }
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
            bookForm.addEventListener('submit', function(event) {
              event.preventDefault();

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

           // Submit the form with the token ID.
            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              bookForm.appendChild(hiddenInput);

    
              bookForm.submit();
            }

       	});

    });
</script>
@endpush
