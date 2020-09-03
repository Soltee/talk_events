<div  class="flex flex-col mb-8 relative">    

	  	<h3 class="text-white hover:opacity-75 mb-3 text-xl md:text-2xl font-bold pr-3 ">Subscribe</h3>
	  	<p class="mb-5 text-white font-normal">Get news regarding events first.</p>
   

	    @if ($visibility)
			<div class=" flex flex-col justify-center items-center w-full bg-white rounded-lg px-3 py-3">
		  		<div class=" flex justify-end w-full">
			  		<button wire:click="setVisibility" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
		                <svg class="fill-current text-red-600" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75">
		                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
		                </svg>
		            </button>
	            </div>
				<div class="mt-3 mb-3 flex flex-row items-center">
	  		
			  		<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600 font-semibold w-1/3"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" ><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
			  		<p class="pl-3 leading-7 w-2/3 text-green-600 font-semibold ">{{ $message }}</p>
			  	</div>

			</div>
		@else
	  	<form wire:submit.prevent="subscribe"  method="POST" >
	  		@csrf
	      	<div class="mt-4 w-full flex flex-col ">
	      		<label class="mb-2 inline-flex items-center text-sm text-gray-600" for="agree">
                    <input type="checkbox" wire:model="agree" id="agree" class="form-checkbox" {{ $agree ? 'checked' : '' }}>
                    <span class="ml-2 text-white ">I agree to receive newsletter.</span>
                </label>
                @error('agree')
                	<p class="text-red-600 mb-2 font-normal">Please check on I Agree.</p>
                @enderror
	          	<input id="email" wire:model="email" value="{{ $email }}" type="email" class="focus:outline-none  w-full bg-white rounded-t  px-6 py-3 sm:mb-0 border-2 focus:border-custom-light-orange @error('email') border-red-500 @enderror" placeholder="Enter email..">
	          	<button type="submit" class="focus:outline-none w-full  bg-blue-500  hover:opacity-75 rounded-b md:uppercase text-white font-bold md:tracking-wide py-3 px-3 md:px-6 text-center cursor-pointer">Subscribe</button>
	      	</div>
	  	</form>

	@endif
</div>

@push('scripts')

<script>
	// window.addEventListener('name-updated', () => {
	// 	document.getElementById('Message').style.
	// });
</script>

@endpush