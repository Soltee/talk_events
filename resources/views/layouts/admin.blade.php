<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('head')
    <livewire:styles />
    <style>

       

          .spinner > div {
            width: 18px;
            height: 18px;
            background-color: #fff;

            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
          }

          .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
          }

          .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
          }

          @-webkit-keyframes sk-bouncedelay {
            0%, 80%, 100% { -webkit-transform: scale(0) }
            40% { -webkit-transform: scale(1.0) }
          }

          @keyframes sk-bouncedelay {
            0%, 80%, 100% { 
              -webkit-transform: scale(0);
              transform: scale(0);
            } 40% { 
              -webkit-transform: scale(1.0);
              transform: scale(1.0);
            }
          }
    </style>

</head>
<body class="relative bg-gray-100 antialiased leading-none">
    @include('sweetalert::alert')

    <div class="w-full overflow-hidden">
        <div class="w-full flex 
            ">

            @auth
            <div id="sidebar" class="w-40 px-4 py-3 h-screen flex justify-center  ">
                @include('admin.inc.sidenav')
            </div>
          
            <div id="content" class="flex-1 lex flex-col">
                <nav class=" py-3 md:py-6 px-3 md:px-6">
                    <div class="flex items-center justify-between">
                        <div class="mr-6">
                            <svg id="hamburger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 hover:opacity-75 text-gray-900 cursor-pointer hover:opacity-75">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </div>
                        
                        <div class="flex justify-end items-center">
                            <div class="relative flex flex-row items-center text-right" 
                            x-data="{ open : false}">
                            <div class="flex items-center">
                              @if(auth()->user()->avatar)
                                <img  src="/storage/{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full object-cover object-center" onerror="this.src='https://via.placeholder.com/200'">
                                <svg
                                  x-on:click="open = !open;"
                                  class="ml-2 h-8 w-8 text-blue-600 cursor-pointer hover:text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                              @else
                                <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-blue-600 hover:text-blue-500 rounded-full object-cover object-center">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <svg
                                  x-on:click="open = !open;"
                                  class="ml-2 h-8 w-8 text-blue-600 cursor-pointer hover:text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                              @endif
                            </div>
                            <div 
                              x-show.transition.70ms="open"
                               class="absolute top-0 right-0 mt-10 px-2 py-1 rounded flex  flex-col border-gray-200 border z-20  bg-gray-100">
                                <a href="/admin/profile" class="no-underline hover:underline text-blue-600 text-sm  md:text-md hover:font-semibold p-3 {{ (Route::currentRouteName() == 'admin.profile') ? 'underline font-semibold' : ''}}">Profile</a>
                                
                                <!-- Logout Component -->
                                <livewire:admin.auth.logout />

                            </div>
                          </div>
                        </div>
                    </div>
                </nav>

                @yield('content')
            </div>
            @endauth

        </div>
    </div>
    @yield('login-content')


    <livewire:scripts />
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
