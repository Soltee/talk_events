<div class="ml-8 mt-4 mb-4">
	@if($auth)
		<form wire:submit.prevent="post" accept-charset="utf-8">
			@csrf
			<div class="flex flex-col md:flex-row w-full">
				<input type="text" wire:model="message" class="w-full md:w-2/3 px-4 border py-2 rounded-t md:rounded-none md:rounded-l" value="" placeholder="">
				<button type="submit" class="w-full md:w-1/4 px-4 py-3  hover:opacity-75 text-white bg-blue-500 border-b md:border-none md:border-r  rounded-b md:rounded-none md:rounded-r uppercase">Reply</button> 
			</div>
		</form>
	@endif
	<div class="flex flex-col mt-4">
		@forelse($replies as $reply)

		    <div class="flex flex-row mb-3">
		    	<div class="w-16">
		    		<img src="{{ $reply->user->avatar }}" alt="" onerror="this.src='https://lorempixel.com/400'" class="rounded-full w-16 h-16 object-cover object-center">
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
	<div class="my-6">
		{{-- @if($replies->nextPageUrl())
			<span wire:click="next">Show More</span>
		@endif --}}
	        {{-- {{ $replies->links('vendor.pagination.tailwind') }} --}}
	</div>
</div>