@extends('layouts.app')

@section('title')
	FAQs
@endsection
@section('head')
	<meta property="og:title" content="FAQs">
	<meta property="og:description" content="Foot-wear FAQs">
@endsection

@section('content')
	<div class="mb-8">
		<div class="flex justify-between items-center mb-8">

    		<div class="flex items-center">
        		<a href="/"><h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2">Home</h4></a>
        		
        		
        		
        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">Help</h4>

        		<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        		<h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">FAQs</h4>
        	</div>
    		
    	</div>

    	<div>
    		
			<h1 class="text-2xl md:text-5xl text-gray-900 font-semibold mb-4">FAQs</h1>
			<p class="leading-6">Here are some of the most frequently asked questions on Awwwards, anything else, give us a shout at: events[at]events.com.</p>

			<div>
				<div
			x-data="{ tab : 'cost' }"
		    class="flex flex-col md:flex-row">
			<div class="w-full">
				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							x-on:click="tab = 'cost'"
							:class="{ 'font-bold' : tab === 'cost' }"
							class="text-custom-light-black cursor-pointer hover:font-bold  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">1. How much does it cost to use TalkEvents?</h3>
						<svg x-on:click="tab = 'cost'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div x-show.transition.60ms="tab === 'order-detail'"
						>
						<p class="leading-6 text-custom-light-black mb-6 ml-4 ">
							Your will be paying for the events you like to go one by one.
						</p>

					</div>

				</div>

				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							x-on:click="tab = 'sell'"
							:class="{ 'font-bold' : tab === 'sell' }"
							class="text-custom-light-black cursor-pointer hover:font-bold  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">2. How do I sell tickets on TalkEvents?</h3>
						<svg x-on:click="tab = 'sell'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div x-show.transition.60ms="tab === 'sell'"
						>
						<p class="leading-6 text-custom-light-black mb-6 ml-4 ">
							Currently NO. We aren't accepting now.
						</p>

					</div>

				</div>

				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							x-on:click="tab = 'pay'"
							:class="{ 'font-bold' : tab === 'delivery' }"
							class="text-custom-light-black cursor-pointer hover:font-bold  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">3. How can we pay for the tickets?</h3>
						<svg x-on:click="tab = 'pay'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div x-show.transition.60ms="tab === 'pay'"
						>
						<p class="leading-6 text-custom-light-black mb-6 ml-4 ">
							Currently, we support stripe payments. But our team is expanding, so we gonna expand our payments also.
						</p>

			

					</div>

				</div>


				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							x-on:click="tab = 'refunds'"
							:class="{ 'font-bold' : tab === 'refunds' }"
							class="text-custom-light-black cursor-pointer hover:font-bold  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">4. How do I get a refund on TalkEvents?</h3>
						<svg x-on:click="tab = 'refunds'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div x-show.transition.60ms="tab === 'refunds'"
						>
						<p class="leading-6 text-custom-light-black mb-6 ml-4 ">
							TalkEvents organizers set their own refund policies. Before requesting a refund, first check the event listing to see if the event organizer set a refund policy.
						</p>


					</div>

				</div>

				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							x-on:click="tab = 'cancel'"
							:class="{ 'font-bold' : tab === 'cancel' }"
							class="text-custom-light-black cursor-pointer hover:font-bold  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">4. How do I cancel my bookings on TalkEvents?</h3>
						<svg x-on:click="tab = 'cancel'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div x-show.transition.60ms="tab === 'cancel'"
						>
						<p class="leading-6 text-custom-light-black mb-6 ml-4 ">
							We appreciate attendees taking the time to update their order, and if you can't attend, it's easy to cancel your registration from your TalkEvents account. Just log in to TalkEvents, Go to the Tickets page, and locate your order. Click your order to view order details, and then select "Cancel Order" to cancel your registration. We'll send you and the event organizer an email confirming the cancellation.


						</p>


					</div>

				</div>


			</div>

		</div>
			</div>

    	</div>
	</div>


@endsection