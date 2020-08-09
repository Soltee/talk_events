<div class="flex px-6 py-3 md:px-0">
    <div class="hidden md:block md:w-1/2">
        <img src="{{ asset('/images/auth.svg') }}" class="h-full w-full p-12 object-cover object-center">
    </div>
    <div class="w-full md:w-1/2 md:p-12">

        <div class="font-semibold text-gray-700 py-3 px-6 mb-0">
            {{ __('Login') }}
        </div>

        <form wire:submit.prevent="login" class="w-full p-6" method="POST" >
            @csrf

            <div class="flex flex-wrap mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('E-Mail Address') }}:
                </label>

                <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" wire:model="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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

                <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" wire:model="password" required>

                @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex mb-6">
                <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                    <input type="checkbox" wire:model="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Remember Me') }}</span>
                </label>
            </div>

            <div class="flex flex-wrap items-center">
                <button type="submit" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Login') }}
                </button>

                @if (Route::has('register'))
                    <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                        {{ __("Don't have an account?") }}
                        <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </p>
                @endif
            </div>
        </form>

    </div>
</div>
