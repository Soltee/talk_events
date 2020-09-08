<div class="flex items-center ">
	<a href="/admin/dashboard"><h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2">Dashboard</h4></a>       
            {{-- {{$url}} --}}
    @if($link)
    	<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	    <a href="{{ $url }} ">
	    	<h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 {{ $routeName === Route::currentRouteName() ? 'font-bold' : '' }}">{{ $pageName }}</h4>
	    </a>
   
    @endif
    
</div>