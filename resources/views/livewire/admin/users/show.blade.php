@section('title')
	{{ $user->first_name . ' ' . $user->last_name }}
@endsection

<div class="px-3 md:px-6 pb-6">
	
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
			@include('partials.admin-breadcrumb', ['url' => 'admin/users/', 'link' => true, 'pageName' => 'Users', 'routeName' => Route::currentRouteName()])
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>

		    <h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">{{ $user->email }}</h4>

		    <span class="ml-4 px-3 py-2 text-md font-bold text-white rounded bg-green-600">
	   			{{ $roles }}
			</span>
		    
        </div>

        <div >
			<div 
				wire:click="setVisibility"
			 	class="flex items-center px-3 py-3 hover:opacity-50 text-md font-bold text-white rounded cursor-pointer">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete text-red-600 hover:text-red-500 ml-3"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
			</div>

			@if($modal)
				<div 
					{{-- x-on:close-modal.window="on = false" --}}

					>
		        	@include('partials.modal', [
		        		'key'    => $user->id, 
		        		'modal'  => $modal,
						'status' => $status 
		        	])
		        </div>
	        @endif
		   
		</div>
			

	
	</div>


	<div class="flex flex-col md:flex-row">
		<div class="w-full md:w-64">
			
    		<img class="h-48 rounded w-full md:w-64 object-cover mt-3  mb-6"  src="{{ asset($user->avatar) }}">
    	</div>
    	<div class="flex-1 md:ml-6">
    		<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">General Info</h5>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Full Name</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $user->first_name . ' - ' . $user->last_name }}</h4>
	    	</div>
	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Email</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ $user->email }}</h4>
	    	</div>

	    	<div class="flex items-center mb-6">
	    		<label for="" class=" border rounded px-4 py-3 w-40">Created At</label>
	    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('l jS F Y g:i a') }}</h4>
	    	</div>

	    	@if($roles !== 'user')

		    	<h5 class="mb-4 text-md font-semibold text-gray-800 px-2">Permissions & roles</h5>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-40">Roles</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ ucfirst($roles) }}</h4>
		    	</div>
		    	<div class="flex mb-6">
		    		<label for="" class=" border rounded px-4 py-3 w-40">Permissions</label>
		    		<div class="flex flex-col">
		    			@forelse($permissions as $permission)
		    			<h4 class="border rounded px-4 py-3 font-bold text-gray-800">{{ ucfirst($permission) }}</h4>
		    			@empty
		    				<p class="text-red-600 font-semibold">No permissions.</p>
		    			@endforelse
		    		</div>
		    	</div>

	    	@endif



    		
        </div>
   
    </div>

</div>