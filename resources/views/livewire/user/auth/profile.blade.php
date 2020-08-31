<div class="mb-10">
    @include('partials.user-nav')

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

						    @error('avatar') <span class="error">{{ $message }}</span> @enderror
						</div>
						{{-- @if ($avatar)
					        <img src="{{ $avatar->temporaryUrl() }}" class="w-40 h-40 mt-3 rounded object-cover">
					    @else
							<img src="{{ $oldAvatar }}"  class="w-40 h-40 mt-3 rounded object-cover" />
					    @endif --}}

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
	    				@if(session('done'))
	    					<p class="fixed top-0 right-0 bg-green-200 rounded  px-6 py-3 text-green-600">{{session('done')}}</p>
	    				@endif
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
</div>
