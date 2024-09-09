@extends('layouts.host')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Statboard</h1>

        <!-- Total Stats Section -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold">Total Attractions</h2>
                <p class="text-2xl">{{ $totalAttractions }}</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold">Total Events</h2>
                <p class="text-2xl">{{ $totalEvents }}</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold">Total Guides</h2>
                <p class="text-2xl">{{ $totalGuides }}</p>
            </div>
        </div>

        <!-- Total Reviews Section -->
        <div class="bg-white p-4 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold">Total Reviews</h2>
            <p class="text-2xl">{{ $totalReviews }}</p>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Upcoming Events</h2>
            <div id="calendar" style="max-width: 80%; margin: 0 auto; height: 500px;"></div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        /* Calendar Navigation Buttons (Prev, Next, Today) */
        .fc .fc-toolbar.fc-header-toolbar .fc-button {
            background-color: #EA7529 !important;  /* Orange background for system */
            color: white !important;               /* White text */
            padding: 5px 10px !important;          /* Adjust padding */
            border: none !important;               /* No border */
        }

        .fc .fc-toolbar.fc-header-toolbar .fc-button:hover {
            background-color: #ff8000 !important;  /* Lighter orange on hover */
        }

        /* Active Button */
        .fc .fc-toolbar.fc-header-toolbar .fc-button.fc-button-active {
            background-color: #ff8000 !important;  /* Lighter orange for active button */
        }

        /* Calendar View Buttons (Month, Week, Day) */
        .fc .fc-button-group .fc-button {
            background-color: #333 !important;     /* Dark background for view buttons */
            color: white !important;               /* White text */
            border: none !important;               /* Remove border */
        }

        .fc .fc-button-group .fc-button:hover {
            background-color: #EA7529 !important;  /* Orange on hover for view buttons */
        }

        .fc .fc-button-group .fc-button.fc-button-active {
            background-color: #ff8000 !important;  /* Lighter orange for active view button */
        }

        /* Event Background */
        .fc .fc-event {
            background-color: #EA7529 !important;  /* Orange for events */
            color: white !important;               /* White text */
            border: none !important;               /* No border */
        }
    </style>
@endpush


@push('scripts')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <!-- Calendar initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($upcomingEvents),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                navLinks: true,
                editable: false,
                dayMaxEvents: true // allow "more" link when too many events
            });
            calendar.render();
        });
    </script>
@endpush

