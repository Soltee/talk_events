<div class="ml-8 mt-4 mb-4">
	<div class="flex flex-col">
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
		
	        {{-- {{ $replies->links('vendor.pagination.tailwind') }} --}}
	</div>
</div>
