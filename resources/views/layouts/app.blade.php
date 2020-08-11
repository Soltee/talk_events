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
    <livewire:styles />
    <style>
        .swiper-slide {
          text-align: center;
          font-size: 18px;
          background: #fff;
          /* Center slide text vertically */
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-pack: center;
          -ms-flex-pack: center;
          justify-content: center;
          -webkit-box-align: center;
          -ms-flex-align: center;
          align-items: center;
        }

        img {
          max-width: 100%;
          height: auto;
        }

        .swiper-button-next, .swiper-button-prev{color:blue;}
    </style>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div>
        @if(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
        @else
            <nav class="">
                <div class="w-full  px-6 md:px-24  lg:px-40  py-8">
                    <div class="flex items-center justify-center">
                        <div class="mr-6">
                            <a href="{{ url('/') }}" class="text-lg font-semibold text-blue-900 no-underline">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                        <div class="flex-1 text-right">
                            <a class="no-underline   text-white text-sm px-4 py-3 bg-indigo-600 rounded-lg mr-3" href="{{ route('events.all') }}">{{ __('Browse') }}</a>
                            @guest
                                <a class="no-underline hover:underline text-blue-900 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                                
                            @else
                                
                                <span class=" text-blue-900 text-sm pr-4">{{ Auth::user()->name }}</span>

                                <a href="{{ route('user.logout') }}"
                                   class="no-underline hover:underline text-blue-900 text-sm p-3"
                                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </nav>
        @endif

        @yield('content')
        @yield('authentication')
    </div>

    <footer>
        <div class="bg-gray-700">

          <div class="xl:max-w-screen-lg xl:mx-auto">
             
          </div>

        </div>
    </footer>
    <livewire:scripts />
    @stack('scripts')

</body>
</html>
