<div class="flex px-6 py-3 md:px-0">
    <div class="hidden md:block md:w-1/2">
    	<img src="{{ asset('/images/auth.svg') }}" class="h-full w-full p-12  object-center">
    </div>
    <div class="w-full md:w-1/2 md:p-10 relative">
    	

        <div class="font-semibold text-gray-700 py-3 px-6 mb-0">
            {{ __('Register') }}
        </div>

        <form wire:submit.prevent="register" class="w-full p-6" >
            @csrf
            
            <div class="flex flex-wrap mb-6">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('First name') }}:
                </label>

                <input id="first_name" type="text" class="form-input w-full @error('first_name')  border-red-500 @enderror" wire:model="first_name" value="{{ $first_name }}" required autocomplete="first_name" autofocus>

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

                <input id="last_name" type="text" class="form-input w-full @error('last_name')  border-red-500 @enderror" wire:model="last_name" value="{{ $last_name }}" required autocomplete="last_name" autofocus>

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

                <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror"  wire:model="email" value="{{ $email }}" required autocomplete="email">

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

                <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror"  wire:model="password" required autocomplete="new-password">

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

                <input id="password-confirm" type="password" class="form-input w-full" wire:model="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="flex flex-wrap">
            	{{-- <div wire:loading wire:target="register">
			        Processing . ..
			    </div> --}}
                <button  wire:loading.attr="disabled" type="submit" class="inline-block w-full align-middle text-center select-none border font-bold whitespace-no-wrap py-3 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
                    {{ __('Register') }}
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
