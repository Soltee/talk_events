<div class="flex flex-col mt-5 mb-5">
	@if($auth)
		<form wire:submit.prevent="post" accept-charset="utf-8">
			@csrf
			<div class="flex flex-col md:flex-row w-full">
				<input type="text" wire:model="message" class="w-full md:w-2/3 px-4 border py-2 rounded-t md:rounded-none md:rounded-l" value="" placeholder="">
				<button type="submit" class="w-full md:w-1/4 px-4 py-3  hover:opacity-75 text-white bg-blue-500 border-b md:border-none md:border-r  rounded-b md:rounded-none md:rounded-r uppercase">Post</button> 
			</div>
		</form>
	@endif

	<div class="mt-5">
			
		@forelse($activities as $activity)

		    <div class="mb-6">
			    <div class="flex flex-row mb-3">
			    	<div class="w-16">
			    		<img src="{{ $activity->user->avatar }}" alt="" onerror="this.src='https://lorempixel.com/400'" class="rounded-full w-16 h-16 object-cover object-center">
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

			    <div class="ml-8 my-3">
					<div class="flex flex-col">
						@forelse($activity->replies as $reply)

						    <div class="flex flex-row mb-3">
						    	<div class="w-16">
						    		<img src="{{ $reply->user->avatar }}" alt="" onerror="this.src='https://lorempixel.com/400'" class="rounded-full w-16 h-16 object-cover object-center">
						    	</div>
							    <div class="flex-1 flex flex-col ml-3">
							    	<h5 class="text-md mb-2">{{ $reply->user->first_name . ' ' . $reply->user->last_name }}</h5>
							    	<div class="leading-6">
							    		{{  $reply->message }}
							    	</div>
							    </div>
						    </div>

					    @empty
					    	
					    @endforelse
					</div>
				</div>

			    {{-- <livewire:user.events.reply :activity="$activity" /> --}}
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
