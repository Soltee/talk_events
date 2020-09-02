@section('title', 'Bookings')

<div class="px-3 md:px-6 pb-6">
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
            @include('partials.admin-breadcrumb', ['url' => '/admin/bookings', 'link' => false, 'pageName' => 'Bookings', 'routeName' => Route::currentRouteName()])
        </div>
		<form method="get" accept-charset="utf-8">
			@csrf
			<div class="flex items-center justify-between">

				<input type="text" wire:model="first_name" class="mr-4 px-3 py-3  rounded-lg border "  placeholder="Firstname">
                <input type="text" wire:model="last_name" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Lastname">
                <input type="text" wire:model="payment_type" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Payment Type">
				<input type="date" wire:model="created_at" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Date">
			
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
                            User
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Event
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Name
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
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Action
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)


                    <tr>
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            @if($booking->user && $booking->user->avatar)
                                <a class="text-blue-500 hover:underline" href="{{ route('user.show', $booking->user->id) }}">
                                        <img class="w-24 h-24 hover:opacity-75 rounded-lg object-cover object-center" src="{{ $booking->user->avatar }}" >
                                </a>
                            @else
                                <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-24 h-24 hover:opacity-75 rounded-lg object-cover object-center text-blue-600 hover:text-blue-500 rounded-full object-cover object-center">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            @endif
                        </td> 
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="/events/{{ $booking->event->id }}-{{ $booking->event->slug }}" class="text-blue-500 hover:font-bold whitespace-no-wrap">{{ $booking->event->title }}</p>
                        </td>
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap"> {{ $booking->first_name . ' ' . $booking->last_name }}</p>
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
                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
                            <div class="flex items-center">
                                <a 
                                    class="hover:font-semibold" 
                                    href="/admin/bookings/{{ $booking->id }}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>

                                <div 
                                    wire:click="setVisibility"
                                    class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
                                             
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </div>

                                @if($modal)
                                    <div    
                                        >
                                        @include('partials.modal', [
                                            'key' => $booking->id, 
                                            'modal' => $modal,
                                            'status' => $status 
                                        ])
                                    </div>
                                @endif
           
                            </div>
                        </td>
                    </tr>
                            
                    @empty
                        <tr>
                            <td class="">
                                <div class=" flex flex-col justify-center w-full items-center">
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