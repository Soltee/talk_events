@section('title', 'Dashboard')

@section('head')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
@endsection
<div class="">
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
            <h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 font-bold {{ Route::currentRouteName() == 'admin.dashboard' ? 'font-bold' : '' }}">Dashboard</h4>
        </div>
		
	</div>

	<div  class="my-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
		<!-- Latest Events -->
		@can('add events')
		<div  class="shadow rounded border border-blue-500 px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="flex flex-col">
					
					<strong class="mb-2 font-bold">{{ $events }}</strong>
					<span class="mb-3 font-normal">Events</span>
				</div>
				
			</div>
			<div class="flex flex-col mt-3">
				@forelse($latest_5_events as $event)
					<div class="flex items-center justify-between mb-2">
						<h3 class="font-semibold">{{ $event->title }}</h3>
						<a 
			                class="hover:font-semibold" 
			                href="/admin/events/{{ $event->id }}" >
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
			            </a>
					</div>
				@empty
					<div class="flex flex-col">
						<span>Empty!</span>
					</div>
				@endforelse
			</div>
		</div>
		@endcan

		<!-- Latest Speakers -->
		@can('add speakers')
		<div  class="shadow rounded border border-blue-500 px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="flex flex-col">
					
					<strong class="mb-2 font-bold">{{ $speakers }}</strong>
					<span class="mb-3 font-normal">Speakers</span>
				</div>
				
			</div>
			<div  class="flex flex-col mt-3">
				@forelse($latest_5_speakers as $speaker)
					<div class="flex items-center justify-between mb-2">
						<h3 class="font-semibold">{{ $speaker->first_name . ' ' . $speaker->last_name }}</h3>
						<a 
			                class="hover:font-semibold" 
			                href="/admin/speakers/{{ $speaker->id }}" >
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
			            </a>
					</div>
				@empty
					<div class="flex flex-col">
						<span>Empty!</span>
					</div>
				@endforelse
			</div>
		</div>
		@endcan

		<!-- Latest Sponsers -->
		@can('add sponsers')
		<div class="shadow rounded border border-blue-500 px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="flex flex-col">
					
					<strong class="mb-2 font-bold">{{ $sponsers }}</strong>
					<span class="mb-3 font-normal">Sponsers</span>
				</div>
				
			</div>
			<div  class="flex flex-col mt-3">
				@forelse($latest_5_sponsers as $sponser)
					<div class="flex items-center justify-between mb-2">
						<h3 class="font-semibold">{{ $sponser->full_name }}</h3>
						<a 
			                class="hover:font-semibold" 
			                href="/admin/sponsers/{{ $sponser->id }}" >
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
			            </a>
					</div>
				@empty
					<div class="flex flex-col">
						<span>Empty!</span>
					</div>
				@endforelse
			</div>
		</div>
		@endcan

		<!-- Latest User -->
		@can('add users')
		<div class="shadow rounded border border-blue-500 px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="flex flex-col">
					
					<strong class="mb-2 font-bold">{{ $users }}</strong>
					<span class="mb-3 font-normal">Users</span>
				</div>
				
			</div>
			<div class="flex flex-col mt-3">
				@forelse($latest_5_users as $user)
					<div class="flex items-center justify-between mb-2">
						<h3 class="font-semibold">{{ $user->first_name . ' ' . $user->last_name }}</h3>
						<a 
			                class="hover:font-semibold" 
			                href="/admin/users/{{ $user->id }}" >
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
			            </a>
					</div>
				@empty
					<div class="flex flex-col">
						<span>Empty!</span>
					</div>
				@endforelse
			</div>
		</div>
		@endcan

		<!-- Latest Bookings -->
		<div class="shadow rounded border border-blue-500 px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="flex flex-col">
					
					<strong class="mb-2 font-bold">{{ $bookings }}</strong>
					<span class="mb-3 font-normal">Bookings</span>
				</div>
				
			</div>
			<div class="flex flex-col mt-3">
				@forelse($latest_5_bookings as $booking)
					<div class="flex items-center justify-between mb-2">
						<h3 class="font-semibold">{{ $booking->first_name . '' . $booking->last_name}}</h3>
						<a 
			                class="hover:font-semibold" 
			                href="/admin/bookings/{{ $booking->id }}" >
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-gray-900 hover:opacity-75"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
			            </a>
					</div>
				@empty
					<div class="flex flex-col">
						<span>Empty!</span>
					</div>
				@endforelse
			</div>
		</div>

	</div>

	@role('super-admin')
	<div class="my-4">
		<canvas id="myChart" class="w-full h-74"></canvas>
	</div>
	@endrole

</div>
@push('scripts')
<script>
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [ '10 Days Ago', '2 Days Ago', 'Yesterday', 'Today'],
        datasets: [
        	{
	            label: 'Events',
	            backgroundColor: '#FFFC#E',
	            borderColor: '#000000',
	            data: [{!!  $events !!}]
	        },
	        {label: 'Users',
	            backgroundColor: '#FF3C4c',
	            borderColor: '#000000',
	            data: [{!!  $users !!}]
	        },
	        {label: 'Bookings',
	            backgroundColor: '#CC#FFC',
	            borderColor: '#000000',
	            data: [{!!  $bookings !!}]
	        }
	        ,
	        {label: 'Speakers',
	            backgroundColor: '#FFC3CC',
	            borderColor: '#FFC3#C',
	            data: [{!!  $speakers !!}]
	        }
	        ,
	        {label: 'Sponsers',
	            backgroundColor: '#CEF3CE',
	            borderColor: '#000000',
	            data: [{!!  $sponsers !!}]
	        }
        
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


@endpush