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

<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div id='calendar'></div>
</div>
