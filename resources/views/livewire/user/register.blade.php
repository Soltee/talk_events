@section('title' , 'Sign Up')
@section('head')
@endsection

<div class="flex px-6 py-3 md:px-0">
    <div class="hidden md:block md:w-1/2  h-screen">
    	<img src="{{ asset('/images/reg.svg') }}" class="h-full w-full p-12  object-center">
    </div>
    <div class="w-full md:w-1/2 md:p-10 relative">
    	

        <div class="flex items-center text-gray-700 py-3 px-6 ">
            <a href="/" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                <span class="ml-2 text-sm">Back to Site</span>
            </a>

            <h2 class="ml-6 font-bold">
                {{ __('Sign Up') }}
            </h2>
        </div>

        <form wire:submit.prevent="register" class="w-full p-6" >
            @csrf
            
            <div class="flex flex-wrap mb-6">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('First name') }}:
                </label>

                <input id="first_name" type="text" class="form-input w-full " wire:model="first_name" value="{{ $first_name }}"  autocomplete="first_name" >

                @error('first_name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-wrap mb-6">
                <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Last name') }}:
                </label>

                <input id="last_name" type="text" class="form-input w-full " wire:model="last_name" value="{{ $last_name }}"  autocomplete="last_name" >

                @error('last_name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-wrap mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('E-Mail Address') }}:
                </label>

                <input id="email" type="email" class="form-input w-full"  wire:model="email" value="{{ $email }}"  autocomplete="email">

                @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-wrap mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Password') }}:
                </label>

                <input id="password" type="password" class="form-input w-full"  wire:model="password"  autocomplete="new-password">

                @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-wrap mb-6">
                <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Confirm Password') }}:
                </label>

                <input id="password-confirm" type="password" class="form-input w-full" wire:model="password_confirmation"  autocomplete="new-password">
            </div>

            <div class="flex flex-wrap">
            	{{-- <div wire:loading wire:target="register">
			        Processing . ..
			    </div> --}}
                <button  wire:loading.attr="disabled" type="submit" class="inline-block w-full align-middle text-center select-none border font-bold whitespace-no-wrap py-3 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
                    {{ __('Sign Up') }}
                </button>

                <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                    {{ __('Already have an account?') }}
                    <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>


    </div>
</div>
