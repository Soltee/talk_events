<div 
	x-data="{open : false}"
	>
	<span
		x-on:click="open = true;"
	    class="no-underline hover:underline text-blue-600 text-sm  md:text-md hover:font-semibold p-3 cursor-pointer">
	    
	    Logout
	</span>

	<div 
		x-show.transition.60ms="open"
		class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
	        <div class="h-full w-full bg-gray-300" 
	        		x-on:click="open = false;"
				>
	            
	    </div>
	    <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">

	        <div class="text-right">
	            <button 
	        		x-on:click="open = false;"
	            	type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
	                <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75">
	                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
	                </svg>
	            </button>

	        </div>
	        <div class="">
	            <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure?</p>
	            <div class="mt-6 mb-3 flex justify-end">
	                <button 
	        			x-on:click="open = false;"
	                	class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
	                <button wire:click="invalidate" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Logout</button>
	            </div>
	        </div>


	    </div>

	</div>


</div>



