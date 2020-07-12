<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div class="flex w-screen 
        {{-- xl:max-w-6xl --}}
        ">

        <div class="w-40 ">
            @include('admin.inc.sidenav')
        </div>

        <div class="flex-1 flex flex-col">
            @auth
            <nav class="bg-blue-900 shadow py-3">
                <div class="w-full">
                    <div class="flex items-center justify-center">
                        <div class="mr-6">
                            
                        </div>
                        <div class="flex-1 text-right">
                            <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                            <a href="{{ route('admin.logout') }}"
                               class="no-underline hover:underline text-gray-300 text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            @endauth

            @yield('content')
            @yield('login-content')
        </div>

    </div>

    @yield('scripts')

</body>
</html>
