<div class="flex flex-col mt-5 mb-5">
	@if($auth)
		<form wire:submit.prevent="post" accept-charset="utf-8">
			@csrf
			<div class="flex flex-col md:flex-row w-full">
				<input type="text"  wire:ignore wire:model="message" class="w-full md:w-2/3 px-4 border py-2 rounded-t md:rounded-none md:rounded-l" value="" placeholder="">
				<button type="submit" class="w-full md:w-1/4 px-4 py-3  hover:opacity-75 text-white bg-blue-500 border-b md:border-none md:border-r  rounded-b md:rounded-none md:rounded-r uppercase">Post</button> 
			</div>
		</form>
	@endif

	<div class="mt-5">
			
		@forelse($activities as $activity)

		    <div class="mb-6">
			    <div class="flex flex-row mb-3">
			    	<div class="w-16">
			    		<img src="{{ $activity->user->avatar }}" alt="" onerror="this.src='https://via.placeholder.com/300'" class="rounded-full w-16 h-16 object-cover object-center">
			    	</div>
				    <div class="flex-1 flex flex-col ml-3">
				    	<div class="flex items-center mb-3">
				    		
				    		<h5 class="text-sm mr-3">{{ ucfirst($activity->user->first_name . ' ' . $activity->user->last_name) }}</h5>
				    		<span>{{ date("F j, Y, g:i a", strtotime($activity->creaed_at)) }}</span>
				    	</div>
				    	<div class="leading-6">
				    		{{  $activity->message }}
				    	</div>
				    </div>
			    </div>


			    <div class="ml-8 mt-4 mb-4">
				    	
				    @if(count($activity->replies) > 0)
						<div class="flex flex-col">
							@forelse($activity->replies as $reply)

							    <div class="flex flex-row mb-3">
							    	<div class="w-16">
							    		<img src="{{ $reply->user->avatar }}" alt="" onerror="this.src='https://via.placeholder.com/300'" class="rounded-full w-16 h-16 object-cover object-center">
							    	</div>
								    <div class="flex-1 flex flex-col ml-3">
								    	<div class="flex items-center mb-3">
								    		
								    		<h5 class="text-sm mr-3">{{ ucfirst($reply->user->first_name . ' ' . $reply->user->last_name) }}</h5>
								    		<span>{{ date("F j, Y, g:i a", strtotime($reply->created_at)) }}</span>
								    	</div>
								    	<div class="leading-6">
								    		{{  $reply->message }}
								    	</div>
								    </div>
							    </div>

						    @empty
						    	
						    @endforelse
						</div>
					@endif

			    	@if($auth)
						@if($show)
					    		<div 
									class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
							        <div class="h-full w-full bg-gray-300" wire:click="toggle">
								            
								    </div>
								    <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
								    	
								        <div class="text-right">
								            <button wire:click="toggle" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
								                <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="hover:opacity-75">
								                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
								                </svg>
								            </button>

								        </div>
										<form  accept-charset="utf-8">
											@csrf
											<div class="flex flex-col md:flex-row w-full">
												<input wire:ignore type="text" wire:model="reply" class="w-full md:w-2/3 px-4 border py-2 rounded-t md:rounded-none md:rounded-l" value="" placeholder="">
												<button wire:click.prevent="reply({{ $activity->id }})" class="w-full md:w-1/4 px-4 py-3  hover:opacity-75 text-white bg-blue-500 border-b md:border-none md:border-r  rounded-b md:rounded-none md:rounded-r uppercase">Reply</button> 
											</div>
										</form>
									</div>
								</div>
				    	@else
				    		<div class="ml-12 mt-6">
					    		<span wire:click="toggle" class=" text-white bg-blue-600 hover:bg-blue-500 px-3 py-3 rounded">Reply</span>
					    	</div>
				    	@endif
					@endif
						
				</div>
			    
				

			</div>

	    @empty
	    	<div class=" flex flex-col justify-center w-full items-center my-4">
	      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
	      		<p class="mt-3">No Activity yet.</p>
	 		</div>
	    @endforelse
	</div>
	<div class="my-6">
            {{ $activities->links('vendor.pagination.tailwind') }}
    </div>


</div>
