@extends('layouts.admin')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
<style>

    .custom_checkbox input:checked + .checkbox_btn{
		font-size: bold;
	}

</style>
@endsection

@section('content')
    <div class="">

    	
        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        	@csrf
	       	<div class="flex justify-between items-center  mb-6">

                <div class="flex items-center">
                    @include('partials.admin-breadcrumb', ['url' => '/admin/users', 'link' => true, 'pageName' => 'Users', 'routeName' => Route::currentRouteName()])
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    <h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 font-semibold">Add User</h4>
                </div>

                <button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
                        Publish
                </button>
            
            </div>

		 
		 	<div class="flex justify-between flex-col md:flex-row">
	    			<div class="flex flex-col md:mr-4 w-full md:w-1/2">

	    				<h4 class="text-md mb-4">1. General Info</h4>
	    				<div class="flex flex-wrap mb-6">
	                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Firstname') }}
	                        </label>

	                        <input id="first_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('first_name') border-red-500 @enderror " name="first_name" value="{{ old('first_name') }}"  autofocus placeholder="">

	                        @error('first_name')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <div class="flex flex-wrap mb-6">
	                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Lastname') }}
	                        </label>

	                        <input id="last_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('last_name') border-red-500 @enderror " name="last_name" value="{{ old('last_name') }}"  autofocus placeholder="">

	                        @error('last_name')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
		                    
	                    <div class="flex flex-wrap mb-10">
	                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Email') }}
	                        </label>

	                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror " name="email" value="{{ old('email') }}"  autofocus placeholder="">

	                        @error('email')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                    <div class="flex flex-row justify-between items-center mb-4">
	    					<h4 class="text-md">2. Password</h4>
	    					<span id="generatePass" class="px-4 py-2 rounded bg-green-600 text-white hover:opacity-75">Generate</span>
	    				</div>
	    				<div class="flex flex-wrap mb-8">
	                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Password') }}
	                        </label>

	                        <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror " name="password" value="{{ old('password') }}"  autofocus placeholder="">

	                        @error('password')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                    <div class="flex flex-wrap mb-8">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror " name="password_confirmation" required autocomplete="new-password">
                        </div>
	  
	    			</div>
	    			<div class="flex flex-col md:pl-2  w-full md:w-1/2 md:px-4">
	    				<div class="flex flex-row justify-between items-center mb-4">
	    					<h4 class="text-md">3. Role & Permissions</h4>
	    					{{-- <span id="generatePass" class="px-4 py-2 rounded bg-green-600 text-white hover:opacity-75">Generate</span> --}}
	    				</div>
	    				
	    				<div class="flex flex-col mb-8">
	    					<div id="RoleTab" class="flex justify-between w-full mb-6">
				       			<input id="new_role" type="text" class=" appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  autofocus placeholder="">
				       			<span id="roleSubmit" class="px-6 py-3  rounded-r bg-green-600 cursor-pointer hover:bg-green-500 text-white">
					    			Create
					    		</span>
					    	</div>
		    				<div id="userRoles" class="flex flex-col mb-3">
		    					@forelse($roles as $role)
		    						<div class="flex justify-between items-center mb-2">
			    						<div class="flex items-center">
			    							<label  class="custom_checkbox relative flex flex items-center">
												<input class="" class="roleCheckbox" type="radio"  
												name="role" value="{{$role->id}}">
												<span  class="checkbox_btn roleCheckboxCheckedOrNot mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold"
												>
													{{ strtoupper($role->name) }}
												</span>
												
											</label>	    							
			    						</div>
			    						<svg  data-id="{{ $role->id }}" xmlns="http://www.w3.org/2000/svg" class="roleDelBtn h-10 w-10 text-red-600 hover:opacity-50 cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
			    					</div>
		    					@empty
		    						<p> No roles yet.</p>
		    					@endforelse
		    				</div>
		    				@error('role_name')
	                            <p class="text-red-500 text-xs italic my-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
		    				
					       	

		    			</div>

		    			<div class="flex flex-col mb-8">
		    				<div id="PermissionTab" class="flex justify-between w-full mb-6">
				       			<input id="new_permission" type="text" class=" appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  autofocus placeholder="">
				       			<span id="permissionSubmit" class="px-6 py-3  rounded-r bg-green-600 cursor-pointer hover:bg-green-500 text-white">
					    			Create
					    		</span>
					    	</div>

					    	<div class="flex flex-col mb-8">
					    		@error('permission_name')
		                            <p class="text-red-500 text-xs italic my-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		    				<div class="inline-block relative w-full">
	                            <select 
	                                id="slim-permissions" 
	                                multiple 
	                                name="permission_name[]" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
	                                >
	                                    <option data-placeholder="true"></option>
	                                    @forelse($perms as $perm)
	                                        <option value="{{ $perm->id }}">{{ $perm->name }} </option>
	                                    @empty
	                                    @endforelse

	                            </select>
	                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
	                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
	                            </div>
	                        </div>
		    				<div  class="flex flex-col mb-3">
								
		    				</div>

		    			</div>
		    				
		    			</div>

	    			</div>
	    	</div>

		</form>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>

        document.addEventListener("DOMContentLoaded", function(){
        	const generatePass    = document.getElementById('generatePass');
        	const password        = document.getElementById('password');
        	const passwordConfirm = document.getElementById('password-confirm');

        	generatePass.addEventListener('click', function(){
        		var length = 10,
		        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*",
		        retVal = "";
			    for (var i = 0, n = charset.length; i < length; ++i) {
			        retVal += charset.charAt(Math.floor(Math.random() * n));
			    }
			    password.value        = retVal;
			    passwordConfirm.value = retVal;
			    // console.log(document.getElementById('password'));
        	});

        	//Permissions
        	let permissionName = document.querySelectorAll('.permissionName');

        	let permissionNames = document.querySelector('.permission_names');
        	var input = document.createElement("input");
			input.setAttribute('name', 'permission_name');
			input.setAttribute('type', 'hidden');
        	permissionNames.appendChild(input);
        	permissionName.forEach((per) => {
	        	//Get the Input
        		per.addEventListener('click', function(e){
        			e.target.classList.toggle('font-bold');
	        		let Attr = e.target.getAttribute('data-name');
	        		input.value += Attr + ',';    
	        		console.log(input.value);   			
	        	});
        	});

        	//Role Add
        	const roleSubmit = document.getElementById('roleSubmit');
        	const roleName   = document.getElementById('new_role');
        	const RoleTab   = document.getElementById('RoleTab');
        	const userRoles = document.getElementById('userRoles');
        	roleSubmit.addEventListener('click', function(e) {

        		let formData = new FormData();
   
                formData.append('role_name', roleName.value);
        		axios.post(`/admin/roles`,
                    formData,
                    {
                    headers: {
                        'Content-Type': 'application/json',
				        "Accept": "application/json",
        				"X-Requested-With": "XMLHttpRequest",
        				"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
                    }
                }).then((res) =>{
                    if(res.status === 201){
                        
                    	swal({
						  title: "Successful",
						  text: "You will be redirected back.",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						   	window.location = "<?php echo env('APP_URL'); ?>/admin/users/create";        		
						    
						});

                       
                    } else {
                        swal("There was some server problem.Try again later.");
                    } 

                })
                .catch((error) => {

                    let errors       = error.response.data.errors;    
                    if(errors){
                        if(errors.role_name){
                            swal(`${errors.role_name[0]}`);
                        }
                    }

                });

        	});

        	//Delete ROle
        	const roleDelBtn   = document.querySelectorAll('.roleDelBtn');
        	roleDelBtn.forEach((btn) => {
	        	//Get the Input
        		btn.addEventListener('click', function(e){
	        		let Attr = e.target.getAttribute('data-id');
	        		axios.delete(`/admin/roles/${Attr}`,
	                    {
	                    headers: {
	                        'Content-Type': 'application/json',
					        "Accept": "application/json",
	        				"X-Requested-With": "XMLHttpRequest",
	        				"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
	                    }
	                }).then((res) =>{
	                    if(res.status === 204){
	                        
	                    	swal({
							  title: "Successful",
							  text: "Role has been deleted. You will be redirected back.",
							  icon: "success",
							  buttons: true,
							  dangerMode: true,
							})
							.then((willDelete) => {
							   	window.location = "<?php echo env('APP_URL'); ?>/admin/users/create";        		
							    
							});

	                       
	                    } else {
	                        swal("There was some server problem.Try again later.");
	                    } 

	                })
	                .catch((error) => {

	                    swal('Server error! Please try again.');
	                });
		
	        	});
        	});


        	//Permission Add
        	const permissionSubmit = document.getElementById('permissionSubmit');
        	const newPermission   = document.getElementById('new_permission');
        	const PermissionTab    = document.getElementById('PermissionTab');
        	const userPermissions  = document.getElementById('userPermissions');

        	permissionSubmit.addEventListener('click', function(e) {

        		let formData = new FormData();
   
                formData.append('name', newPermission.value);
        		axios.post(`/admin/permissions`,
                    formData,
                    {
                    headers: {
                        'Content-Type': 'application/json',
				        "Accept": "application/json",
        				"X-Requested-With": "XMLHttpRequest",
        				"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
                    }
                }).then((res) =>{
                    if(res.status === 201){
                        
                    	swal({
						  title: "Successful",
						  text: "You will be redirected back.",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						   	window.location = "<?php echo env('APP_URL'); ?>/admin/users/create";        		
						    
						});

                       
                    } else {
                        swal("There was some server problem.Try again later.");
                    } 

                })
                .catch((error) => {

                    let errors       = error.response.data.errors;    
                    if(errors){
                        if(errors.name){
                            swal(`${errors.name[0]}`);
                        }
                    }

                });

        	});

        	//Delete Permission

        	const permissionDelBtn   = document.querySelectorAll('.permissionDelBtn');
        	permissionDelBtn.forEach((btn) => {
	        	//Get the Input
        		btn.addEventListener('click', function(e){
        			//Popup for Deleting Permission
        			swal({
					  title: "Are you sure?",
					  text: "Once deleted, you will not be able to recover this!",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) {
					  	//If Yes then, , delete Permission 
					  	let Attr = e.target.getAttribute('data-id');
		        		axios.delete(`/admin/permissions/${Attr}`,
		                    {
		                    headers: {
		                        'Content-Type': 'application/json',
						        "Accept": "application/json",
		        				"X-Requested-With": "XMLHttpRequest",
		        				"X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
		                    }
		                }).then((res) =>{
		                    if(res.status === 204){

		                    	swal("Poof! Permission has been deleted! You will be redirected in 3 seconds.", {
							      icon: "success",
							    });

		                    	setTimeout(() => {
									window.location = "<?php echo env('APP_URL'); ?>/admin/users/create";        		
		                    	}, 3000);
								 
		                    } else {
		                        swal("There was some server problem.Try again later.");
		                    } 

		                })
		                .catch((error) => {

		                    swal('Server error! Please try again.');
		                });
		
					  } else {
					    swal.close();
					  }
					});
	        		
	        	});
        	});

		});		
		
	</script>

@endpush