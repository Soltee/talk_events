<div class="px-3 md:px-6 pb-6">
	<div class="flex justify-between items-center  mb-6">

   		<h3 class="text-gray-900 text-lg ">
   			<a href="{{ route('events') }}">Events</a>
   		</h3>
		<form wire:submit.prevent="render" method="get" accept-charset="utf-8">
			@csrf
			<div class="flex items-center justify-between">

				<input type="text" name="filter[title]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['title'] ?? '' }}" placeholder="Title">
				<input type="text" name="filter[venue_name]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['venue_name'] ?? '' }}" placeholder="Venue">
				<input type="date" name="filter[starts_at]" class="mr-4 px-3 py-3  rounded-lg border " value="{{ request()->filter['starts_at'] ?? '' }}" placeholder="Start Date">
			
		
				<button type="submit" class="px-6 py-4  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
	    			Search
	    		</button>	
			</div>
		</form>

	
	</div>

	<div  class=" overflow-x-auto">
        <div  class="inline-block min-w-full  rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Event
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Price
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Payment
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Total
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Created at
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)


                    <tr>
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="/bookings/{{ $booking->id }}" class="text-blue-500 hover:font-bold whitespace-no-wrap">{{ $booking->event->title }}</p>
                        </td>
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">$ {{ $booking->price }}</p>
                        </td>
                         <td class="px-5 whitespace-no-wrap py-3 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{!! $booking->typeOfPayment() !!}</p>
                        </td>
                         <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">$ {{ $booking->grand_total}}</p>
                        </td>
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ ($booking->created_at->diffForHumans()) }}
                            </p>
                        </td>
                    </tr>
                            
                    @empty
                        <tr>
                            <td class="">
                                <div class=" flex flex-col justify-center w-full">
						      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
						      		<p class="mt-3">Oops! No Bookings .</p>
					     		</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="my-6">
                {{ $bookings->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

</div>