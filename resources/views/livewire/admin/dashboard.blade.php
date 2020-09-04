@section('title', 'Dashboard')

@section('head')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
@endsection
<div class="px-3 md:px-6 pb-6">
	<div class="flex justify-between items-center  mb-6">

        <div class="flex items-center">
            <h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 font-bold {{ Route::currentRouteName() == 'admin.dashboard' ? 'font-bold' : '' }}">Dashboard</h4>
        </div>
		
	</div>

	<div class="my-4">
		<canvas id="myChart" class="w-full h-64"></canvas>
	</div>

</div>
@push('scripts')
<script>
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Events'],
        datasets: [
        	{
	            label: '# of Events',
		        data: [{!! $events !!}],
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.2)',
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)',
	                'rgba(75, 192, 192, 0.2)',
	                'rgba(153, 102, 255, 0.2)',
	                'rgba(255, 159, 64, 0.2)'
	            ],
	            borderColor: [
	                'rgba(255, 99, 132, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
		    },
		    {
	            label: '# of Users',
		        data: [{!! $users !!}],
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.2)',
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)',
	                'rgba(75, 192, 192, 0.2)',
	                'rgba(153, 102, 255, 0.2)',
	                'rgba(255, 159, 64, 0.2)'
	            ],
	            borderColor: [
	                'rgba(255, 99, 132, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
		    },
		    
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