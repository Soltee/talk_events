<div 
	id="modal"
	
	class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
        <div class="h-full w-full bg-gray-300" x-on:click="open = false;">
            
    </div>
    <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
    	@if($status === 'success')
    		<div class="flex flex-col items-center">
    			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mb-3 h-32 w-32 text-green-600 font-semibold border p-1 border-green-600 rounded-full"><polyline points="20 6 9 17 4 12"></polyline></svg>
				<p class=" bg-green-200 rounded  px-6 py-3 text-green-600">{{ $status }}</p>

				<div class="mt-6 mb-3 flex justify-end">
	                <button wire:click="setVisibility" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Close</button>
	            </div>

    		</div>
	 	@else
	        <div class="text-right">
	            <button wire:click="setVisibility" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
	                <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75">
	                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
	                </svg>
	            </button>

	        </div>
	        <div class="">
	            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure?</p>
	            <div class="mt-6 mb-3 flex justify-end">
	                <button wire:click="setVisibility" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
	                <button wire:click="drop({{ $key }})" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Delete</button>
	            </div>
	        </div>
        @endif

    </div>

</div>

