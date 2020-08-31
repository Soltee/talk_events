<div class="w-full">
    <div  class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
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
                            <p class="text-gray-900 whitespace-no-wrap">{{ $booking->event->title }}</p>
                        </td>
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">$ {{ $booking->price }}</p>
                        </td>
                         <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $booking->payment_type }}</p>
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
						      		<p class="mt-3">Oops! I haven't book any event.</p>
					     		</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- {{ $bookings->links() }} --}}

            <div
                class="px-5  py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                <span class="text-xs xs:text-sm text-gray-900">
                    Showing {{ $first }} to {{ $last }} of {{$total}} Entries
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                    @if($has_previous)
                        <a href="{{ $has_previous }}">
                            <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                            Prev
                            </button>
                        </a>
                        @endif
                    @if($has_next)
                        <a href="{{ $has_next }}">
                            <button
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>