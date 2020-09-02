@section('title', 'Users')

<div class="px-3 md:px-6 pb-6">

	<!-- Add User Icon -->
	@can('add users')
		<a href="{{ route('user.create') }}" class="fixed right-0 bottom-0 mr-3 md:mr-8 mb-3 md:mb-8 text-xl font-3xl text-white bg-blue-600 rounded-full px-6 py-5  hover:opacity-75">+</a>
	@endcan
    	
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
            @include('partials.admin-breadcrumb', ['url' => '/admin/users', 'link' => false, 'pageName' => 'Users', 'routeName' => Route::currentRouteName()])
        </div>
		<form method="get" accept-charset="utf-8">
			@csrf
			<div class="flex items-center justify-between">

				<input type="text" wire:model="first_name" class="mr-4 px-3 py-3  rounded-lg border "  placeholder="Firstname">
                <input type="text" wire:model="last_name" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Lastname">
                <input type="text" wire:model="role" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Role">
                <input type="text" wire:model="email" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Email">
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
                            Role
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Avatar
                        </th>
                        
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                            Email
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
                    @forelse($users as $user)

                    	<div >
							<tr>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        <p class="text-gray-900 whitespace-no-wrap">{{ ucfirst($user->roles->pluck('name')[0]) }}</p>
							    </td>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        @if($user->avatar)
							            <a class="text-blue-500 hover:underline" href="{{ route('user.show', $user->id) }}">
							                    <img class="w-24 h-24 hover:opacity-75 rounded-lg object-cover object-center" src="{{ $user->avatar }}" >
							            </a>
							        @else
							            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-24 h-24 hover:opacity-75 rounded-lg object-cover object-center text-blue-600 hover:text-blue-500 rounded-full object-cover object-center">
							            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
							                <circle cx="12" cy="7" r="4"></circle>
							            </svg>
							        @endif
							    </td> 
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        <a href="/user/{{ $user->id }} }}" class="text-blue-500 hover:font-bold whitespace-no-wrap">
							        	<p class="text-gray-900 whitespace-no-wrap"> {{ $user->first_name . ' ' . $user->last_name }}</p>
							        </a>
							    </td>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        <p class="text-gray-900 whitespace-no-wrap"> {{ $user->email }}</p>
							    </td>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        <p class="text-gray-900 whitespace-no-wrap">
							            {{ ($user->created_at->diffForHumans()) }}
							        </p>
							    </td>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
							        <div class="flex items-center">
							            <a 
							                class="hover:font-semibold" 
							                href="/admin/users/{{ $user->id }}" >
							                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
							            </a>

							            <div >
											<div wire:click="setVisibility"
											 	class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
											</div>

											@if($modal)
											<div 	
												>
									        	@include('partials.modal', [
									        		'key' => $user->id, 
									        		'modal' => $modal,
									        		'status' => $status 
									        		])
									        </div>
									        @endif
		   
										</div>

							        </div>
							    </td>
							</tr>

						</div>

                            
                    @empty
                        <tr>
                            <td class="">
                                <div class=" flex flex-col justify-center w-full my-3 items-center">
						      		<svg class="h-10 w-10 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
						      		<p class="mt-3">Oops! No Users or must have mispelled .</p>
					     		</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="my-6">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

</div>