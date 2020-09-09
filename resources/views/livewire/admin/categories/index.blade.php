@section('title', 'Categories')

<div class="px-3 md:px-6 pb-6">

	<!-- Add categorys Icon -->
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
            @include('partials.admin-breadcrumb', ['url' => '/admin/categories', 'link' => true, 'pageName' => 'Categories', 'routeName' => Route::currentRouteName()])
        </div>
		<form method="get" accept-charset="utf-8">
			@csrf
			<div class="flex items-center justify-between">

				<input type="text" wire:model="name" class="mr-4 px-3 py-3  rounded-lg border "  placeholder="Title">
				<input type="date" wire:model="created_at" class="mr-4 px-3 py-3  rounded-lg border " placeholder="Date">
			
			</div>
		</form>

	
	</div>

	@if($status)
		<div class="flex flex-row justify-around items-center w-full bg-green-400 px-4 py-2 rounded">
			<div class="flex items-center">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check h-8 w-8 text-white border-2 border-white font-semibold text-white rounded-full"><polyline points="20 6 9 17 4 12"></polyline></svg>
			<p class="ml-4 rounded text-white ">{{ $message }}</p>
			</div>

	        <button wire:click="close" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg">Close</button>

		</div>
	@endif

	<div class="my-3">
		<form wire:submit.prevent="store">
			<div class="flex flex-wrap w-full justify-around">
	    		<div class="flex flex-col mb-3">
				    <input type="file" class="px-3 py-3 rounded" wire:model="cover">
				    @error('cover') 
				   	<span class="text-red-600 px-3 py-3">{{ $message }}</span> 
					@enderror
				</div>
				<div class="flex flex-col mb-3">
					<input type="text" wire:model="category_name" class="px-3 py-3  rounded border " placeholder="Name">
					@error('category_name') 
				   		<span class="text-red-600 px-3 py-3">{{ $message }}</span> 
					@enderror
				</div>
				<div class="mb-3 flex justify-end ">
					
					<button class="px-6 py-4 h-auto rounded bg-blue-600 hover:bg-blue-500 text-white">Add</button>
				</div>
			</div>

		</form>
	</div>

	<div  class=" overflow-x-auto">
        <div  class="inline-block min-w-full  rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider whitespace-no-wrap">
                            Cover
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider whitespace-no-wrap">
                            Created By
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider whitespace-no-wrap">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider whitespace-no-wrap">
                            Events 
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider whitespace-no-wrap">
                            Created_at
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider whitespace-no-wrap">
                            Action
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)

                    	<div >
							<tr>
							   
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
	                                        <img class="w-24 h-24 hover:opacity-75 rounded-lg object-cover object-center" src="{{ $category->cover }}" onerror="this.src='/images/placeholder.png'">
		                        </td> 
		                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                        	<p>{{ $category->user->first_name . ' ' . $category->user->last_name }}</p>
		                        	{{-- {{$category}} --}}
		                        </td> 
		                       
							    
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        <p class="text-gray-900 whitespace-no-wrap"> {{ $category->name }}</p>
							    </td>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
		                        	<p>{{ $category->events_count }}</p>
		                        </td> 
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
							        <p class="text-gray-900 whitespace-no-wrap"> {{ \Carbon\Carbon::parse($category->created_at)->translatedFormat('l jS F Y') }}</p>
							    </td>
							    <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200">
							        <div class="flex justify-between items-center">
							            <a 
							                class="hover:font-semibold" 
							                href="/admin/categorys/{{ $category->id }}" >
							                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
							            </a>

							            <a 
							                class="hover:font-semibold" 
							                href="/admin/categorys/{{ $category->id }}/edit" >
							                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 feather feather-eye text-gray-900 hover:opacity-75"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
							            </a>
							            <div >
											<div wire:click="drop({{ $category->id }})"
											 	class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded  cursor-pointer">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
											</div>
		   
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
						      		<p class="mt-3">Oops! No categories or must have mispelled .</p>
					     		</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="my-6">
                {{ $categories->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

</div>