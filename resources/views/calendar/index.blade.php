@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold text-pink-700 mb-6">📅 Calendrier des Deadlines</h2>

<div id="calendar"></div>

{{-- FULLCALENDAR CSS --}}
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />

{{-- FULLCALENDAR JS --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 650,
            events: @json($events),
            eventDisplay: 'block',
        });

        calendar.render();
    });
</script>

@endsection
