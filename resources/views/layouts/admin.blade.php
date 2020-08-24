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
<body class="relative bg-gray-100 antialiased leading-none">
    
    <div class="mt-6 overflow-x-scroll md:overflow-x-auto min-w-full">
        <div class="min-w-full flex 
            ">

            @auth
            <div id="sidebar" class="w-40 px-4 py-3 h-screen flex justify-center items-center ">
                @include('admin.inc.sidenav')
            </div>
           {{--  <div class="w-40 px-4 py-3 md:hidden bg-white">
                @include('admin.inc.sidenav')
            </div> --}}

            <div id="content" class="flex-1 lex flex-col">
                <nav class=" py-3 md:py-6 px-3 md:px-6">
                    <div class="flex items-center justify-center">
                        <div class="mr-6">
                            <svg id="hamburger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 hover:opacity-75 text-gray-900 cursor-pointer hover:opacity-75">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </div>
                        <div class="flex-1 text-right">
                            <span class="text-gray-900 text-sm pr-4">{{ Auth::user()->name }}</span>

                            <a href="{{ route('admin.logout') }}"
                               class="no-underline hover:underline text-gray-900 text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </nav>

                @yield('content')
            </div>
            @endauth

        </div>
    </div>
    @yield('login-content')

    @stack('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function(){
          
        let hamburger = document.getElementById('hamburger');
        let sidebar = document.getElementById('sidebar');
        let content = document.getElementById('content');

        hamburger.addEventListener("click", function(){
            if(sidebar.classList.contains('hidden')){
              sidebar.classList.remove('hidden');
            } else {
              sidebar.classList.add('hidden');
            }
        });
     
      });
    </script>

</body>
</html>
