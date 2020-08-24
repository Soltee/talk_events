@extends('layouts.admin')

@section('login-content')
    <div class="mx-auto max-w-lg rounded min-h-screen flex flex-col justify-center items-center px-4 py-4">
        <div class="">
            <p class="my-2 text-red-600">{{ session('error') }}</p>
            <div class="w-full max-w-lg">
                <div class="flex flex-col break-words bg-white border border-2 rounded ">

                    <div class="font-semibold text-gray-600 py-3 px-6 mb-0">
                        {{ __('Dashboard') }}
                    </div>

                    <form class="w-full p-6" method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-600 text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email')  ?? 'admin@example.com'}}" required autocomplete="email" autofocus>

                            @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-600 text-sm font-bold mb-2">
                                {{ __('Password') }}:
                            </label>

                            <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" name="password" required value="password">

                            @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex mb-6">
                            <label class="inline-flex items-center text-sm text-gray-600" for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('Remember Me') }}</span>
                            </label>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="submit" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Login') }}
                            </button>
{{-- 
                            @if (Route::has('password.request'))
                                <a class="text-sm  w-full text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline mt-3 text-center" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif --}}

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
