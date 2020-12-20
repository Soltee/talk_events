@section('title' , 'Dashboard Login')
@section('head')
@endsection

<div class="mx-auto rounded min-h-screen flex flex-col justify-center items-center px-4 py-4">
    <div class="w-full max-w-lg">

        <div class="flex flex-col break-words bg-white border border-2 rounded p-4">
            <div class="font-semibold text-gray-600 py-3 px-6 mb-0 flex items-center justify-center text-center">
                {{ __('Dashboard Login') }}
            </div>

            <form wire:submit.prevent="login" class="w-full p-6">
                @csrf

              
                @if (session()->has('error'))

                    <div class="px-2 py-3 mb-3  rounded text-red-500 bg-red-100">

                        {{ session('error') }}

                    </div>

                @endif

                <div wire:ignore class="flex flex-col mb-6">
                    <label for="email" class="block text-gray-600 text-sm font-bold mb-2">
                        {{ __('Email') }}:
                    </label>

                    <input id="email" type="email" class="form-input w-full" wire:model.defer="email" value="{{ old('email') }}"  autocomplete="email" >

	                @error('email')
	                    <p class="text-red-500 text-xs italic mt-4">
	                        {{ $message }}
	                    </p>
	                @enderror
                </div>

                <div wire:ignor class="flex flex-col mb-6">
                    <label for="password" class="block text-gray-600 text-sm font-bold mb-2">
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
                    <label class="inline-flex items-center text-sm text-gray-600" for="remember">
                        <input type="checkbox" wire:model="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center">
                    <button type="submit" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline flex justify-around items-center">

                    	<div wire:loading class="spinner">
						  <div class="bounce1"></div>
						  <div class="bounce2"></div>
						  <div class="bounce3"></div>
						</div>
                    	<span class="font-semibold">{{ __('Login') }}</span>
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>
