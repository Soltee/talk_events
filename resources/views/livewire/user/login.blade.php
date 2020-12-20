@section('title' , 'Login')
@section('head')
@endsection

<div class="flex px-6 py-3 md:px-0 items-center">
    <div class="hidden md:block md:w-1/2  h-screen">
        <img src="{{ asset('/images/wel.svg') }}" class="h-full w-full p-12  object-center">
    </div>
    <div class="w-full md:w-1/2 md:p-10 relative">
        

        <div class="flex items-center text-gray-700 py-3 px-6 ">
            <a href="/" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                <span class="ml-2 text-sm">Back to Site</span>
            </a>

            <h2 class="ml-6 font-bold">
                {{ __('Welcome Back') }}
            </h2>
        </div>

        

        <form wire:submit.prevent="login" class="w-full p-6 mt-3" method="POST" >
            @csrf

            
            @if (session()->has('error'))

                <div class="px-2 py-3 mb-6 rounded text-red-500 bg-red-100">

                    {{ session('error') }}

                </div>

            @endif

            <div class="flex flex-wrap mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('E-Mail') }}:
                </label>

                <input id="email" type="email" class="form-input w-full" wire:model.defer="email" value="{{ old('email') }}"  autocomplete="email" >

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

                <input id="password" type="password" class="form-input w-full " wire:model.defer="password" >

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
                <button type="submit" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline flex justify-around items-center">

                    <div wire:loading class="spinner">
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                    </div>
                    <span wire:loading.remove class="font-semibold">{{ __('Login') }}</span>
                </button>

                @if (Route::has('register'))
                    <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                        {{ __("Don't have an account?") }}
                        <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                            {{ __('Sign Up') }}
                        </a>
                    </p>
                @endif
            </div>
        </form>

    </div>
</div>
