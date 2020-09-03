@section('title', 'Profile')

<div class="px-3 md:px-6 pb-6 mb-10">
	<div class="flex items-center">
        @include('partials.admin-breadcrumb', ['url' => '/admin/users', 'link' => false, 'pageName' => 'Users', 'routeName' => Route::currentRouteName()])
    </div>

    @if($modal)
	    <div 
			class="fixed  inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
		    <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
		    	<div class=" flex flex-col items-center w-full">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mb-3 h-32 w-32 text-green-600 font-semibold border p-1 border-green-600 rounded-full"><polyline points="20 6 9 17 4 12"></polyline></svg>
					<p class=" bg-green-200 rounded  px-6 py-3 text-green-600">{{ $status }}</p>

					<div class="mt-6 mb-3 flex justify-end w-full">
		                <button wire:click="setVisibility" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Close</button>
		            </div>

				</div>
			</div>
		</div>
 	@else

		<div class="mt-5">
	    	<div class="flex flex-col md:flex-row">
	    		<div class="w-full md:w-1/3">
		    		<h5 class="font-bold text-gray-800">Avatar</h5>
		    	</div>

		    	<div class="w-full md:w-2/3 flex items-center">
		    		<form wire:submit.prevent="save">
		    			<div class="flex flex-col">
			    			<div class="flex flex-col">
							    <input type="file" wire:model="avatar">

							    @error('avatar') <span class="text-red-600 px-3 py-3">{{ $message }}</span> @enderror
							</div>

							<div class="flex justify-end items-center mt-5">
					    		<button type="submit" class="px-3 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded w-32 font-semibold">Save Photo</button>
					    	</div>
						</div>
					</form>

				</div>
			</div>

			<div class="flex flex-col md:flex-row mt-10">
	    		<div class="w-full md:w-1/3">
		    		<h5 class="font-bold text-gray-800">Info</h5>
		    	</div>

					<div class="mt-3 md:mt-0">
						<form wire:submit.prevent="update">
		    			<div class="flex flex-col">
		    				
			    			<div class="flex flex-col mb-3">
			    				<div class="flex flex-col md:flex-row md:items-baseline">
			    					<label class="mb-2 md:border-l md:mb-0 text-gray-800 font-semibold px-3 py-3 md:w-64">Firstname</label>
								    <input type="text" class="md:ml-3 md:border-r border px-3 py-3 rounded w-full text-blue-600" wire:model="firstname" value="{{ $auth->first_name }}">
								</div>

							    @error('firstname') <span class="text-red-600 px-3 py-3">{{ $message }}</span> @enderror
							</div>

							<div class="flex flex-col mb-3">
			    				<div class="flex flex-col md:flex-row md:items-baseline">
			    					<label class="mb-2 md:border-l md:mb-0 text-gray-800 font-semibold px-3 py-3 md:w-64">Lastname</label>
								    <input type="text" class="md:ml-3 md:border-r border px-3 py-3 rounded w-full text-blue-600" wire:model="lastname" value="{{ $auth->last_name }}">
								</div>

							    @error('lastname') <span class="text-red-600 px-3 py-3">{{ $message }}</span> @enderror
							</div>

							<div class="flex flex-col mb-3">
			    				<div class="flex flex-col md:flex-row md:items-baseline">
			    					<label class="mb-2 md:border-l md:mb-0 text-gray-800 font-semibold px-3 py-3 md:w-64">Email</label>
								    <input type="text" class="md:ml-3 md:border-r border px-3 py-3 rounded w-full text-blue-600" wire:model="email" value="{{ $auth->email }}">
								</div>

							    @error('email') <span class="text-red-600 px-3 py-3">{{ $message }}</span> @enderror
							</div>

							<div class="flex justify-end items-center mt-5">
					    		<button type="submit" class="px-3 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded w-32 font-semibold">Save</button>
					    	</div>
						</div>
					</form>
					</div>
		    	</div>

		    </div>

		    <div class="flex flex-col md:flex-row mt-10">
	    		<div class="w-full md:w-1/3">
		    		<h5 class="font-bold text-gray-800">Change Password</h5>
		    	</div>

					<div class="mt-3 md:mt-0">
						<form wire:submit.prevent="change">
		    			<div class="flex flex-col">
							<div class="flex flex-col mb-3">
			    				<div class="flex flex-col md:flex-row md:items-baseline">
			    					<label class="mb-2 md:border-l md:mb-0 text-gray-800 font-semibold px-3 py-3 md:w-64">Password</label>
								    <input type="password" class="md:ml-3 md:border-r border px-3 py-3 rounded w-full text-blue-600" wire:model="password">
								</div>

							    @error('password') <span class="text-red-600 px-3 py-3">{{ $message }}</span> @enderror
							</div>

							<div class="flex flex-col mb-3">
			    				<div class="flex flex-col md:flex-row md:items-baseline">
			    					<label class="mb-2 md:border-l md:mb-0 text-gray-800 font-semibold px-3 py-3 md:w-64">Confirm Password</label>
								    <input type="password" class="md:ml-3 md:border-r border px-3 py-3 rounded w-full text-blue-600" wire:model="password_confirmation">
								</div>

							</div>

							<div class="flex justify-end items-center mt-5">
					    		<button type="submit" class="px-3 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded w-32 font-semibold">Change</button>
					    	</div>
						</div>
					</form>
					</div>
		    	</div>

		    </div>
		</div>
	@endif

</div>
