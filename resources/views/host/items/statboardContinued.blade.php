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

        <!-- Average Rating Section -->
        <div class="bg-white p-4 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold">Average Rating</h2>
            <p class="text-2xl">{{ $averageRating }}</p>
        </div>

        <!-- Rating Breakdown Section -->
        <div class="bg-white p-4 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold">Rating Breakdown</h2>
            <canvas id="ratingBreakdownChart"></canvas>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Upcoming Events</h2>
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart for Rating Breakdown
        const ctx = document.getElementById('ratingBreakdownChart').getContext('2d');
        const ratingBreakdownChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'],
                datasets: [{
                    label: '# of Ratings',
                    data: @json($ratingsBreakdown),
                    backgroundColor: [
                        '#FF0000',
                        '#FFA500',
                        '#FFFF00',
                        '#008000',
                        '#0000FF'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Calendar initialization logic (e.g., using a library like FullCalendar)
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($upcomingEvents)
            });
            calendar.render();
        });
    </script>
@endpush
