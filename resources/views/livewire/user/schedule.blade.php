@section('title' , 'Calendar')
@section('head')

  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.js'></script>

    
  <script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '2020-08-07',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {!! $events !!}
          
      });

      calendar.render();
    });

   </script>

@endsection


<div>
  <div class="flex items-center mb-4">
    <a href="/"><h4 class="text-sm md:text-md font-light text-c-pink mr-2">Home</h4></a>
    
    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
    <h4 class="text-sm md:text-md font-bold text-c-pink opacity-75">Calender</h4>
  </div>

  <div id='calendar' class="mb-10"></div>
</div>
