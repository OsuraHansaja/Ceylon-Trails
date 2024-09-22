@extends('layouts.ct')

@section('content')
    <!-- Hero Section -->
    <section class="banner relative h-[60vh] bg-cover bg-center" style="background-image: url('{{ asset('images/happeningshero.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col justify-center items-start h-full text-white px-12">
            <h1 class="text-2xl md:text-2xl lg:text-2xl font-bold">What's Happening</h1>
            <p class="text-lg md:text-xl lg:text-2xl mt-4">Discover Sri Lanka's hidden gems with our top picks.</p>
        </div>
    </section>

    <!-- Year and Month Filter Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Year and Month Selection -->
            <div class="flex justify-center items-center mb-4">
                <button id="prev-year-btn" class="px-3 py-1 bg-gray-200 text-gray-600 font-semibold rounded-l-lg">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span id="selected-year" class="px-6 py-2 bg-white text-gray-700 font-semibold">2024</span>
                <button id="next-year-btn" class="px-3 py-1 bg-gray-200 text-gray-600 font-semibold rounded-r-lg">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="flex justify-center gap-2 mb-6" id="month-buttons">
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="1">Jan</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="2">Feb</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="3">Mar</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="4">Apr</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer selected" data-month="5">May</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="6">Jun</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="7">Jul</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="8">Aug</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="9">Sep</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="10">Oct</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="11">Nov</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer" data-month="12">Dec</button>
            </div>
        </div>
    </section>

    <!-- Categories Filter Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Categories Filter -->
            <div id="categories" class="flex flex-wrap gap-2 mb-4">
                <button type="button"
                        class="category-button inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-pointer selected"
                        data-category-id="all"
                        style="border-color: #333; color: #fff; background-color: #333;">
                    All
                </button>
                @foreach ($categories as $category)
                    <button type="button"
                            class="category-button inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-pointer"
                            data-category-id="{{ $category->id }}"
                            style="border-color: #333; color: #333;">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="events-grid">
                @foreach ($events as $event)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        @if ($event->thumbnail_image)
                            <img src="{{ asset($event->thumbnail_image) }}" alt="{{ $event->title }}" class="w-full h-32 object-cover mb-4 rounded">
                        @endif
                        <h3 class="text-lg font-bold mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-700 text-sm mb-2">{{ Str::limit($event->small_description, 100) }}</p>
                        <p class="text-sm text-gray-500 mb-2">Location: {{ $event->location }}</p>
                        <p class="text-sm text-gray-500 mb-2">Category: {{ $event->categories->pluck('name')->join(', ') }}</p>
                    </div>
                @endforeach
            </div>

            <!-- View More Button -->
            <div class="mt-6 text-center">
                <button id="view-more-btn" class="bg-black text-white font-bold py-2 px-4 rounded">
                    View More
                </button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let offset = 8;
        let selectedCategory = 'all';
        let selectedYear = 2024;
        let selectedMonth = 1;

        document.addEventListener('DOMContentLoaded', function () {
            const categoryButtons = document.querySelectorAll('.category-button');
            const monthButtons = document.querySelectorAll('.month-button');
            const viewMoreBtn = document.getElementById('view-more-btn');
            const yearSpan = document.getElementById('selected-year');
            const prevYearBtn = document.getElementById('prev-year-btn');
            const nextYearBtn = document.getElementById('next-year-btn');

            // Handle Category Filtering
            categoryButtons.forEach(button => {
                button.addEventListener('click', function () {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('selected');
                        btn.style.backgroundColor = '';
                        btn.style.color = '#333';
                    });

                    this.classList.add('selected');
                    this.style.backgroundColor = '#333';
                    this.style.color = '#fff';

                    selectedCategory = this.getAttribute('data-category-id');
                    offset = 0; // Reset offset
                    loadEvents(selectedCategory, selectedYear, selectedMonth, offset, true);
                });
            });

            // Handle Month Selection
            monthButtons.forEach(button => {
                button.addEventListener('click', function () {
                    monthButtons.forEach(btn => btn.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedMonth = this.getAttribute('data-month');
                    offset = 0; // Reset offset
                    loadEvents(selectedCategory, selectedYear, selectedMonth, offset, true);
                });
            });

            // Handle Year Selection
            prevYearBtn.addEventListener('click', function () {
                selectedYear--;
                yearSpan.textContent = selectedYear;
                offset = 0;
                loadEvents(selectedCategory, selectedYear, selectedMonth, offset, true);
            });

            nextYearBtn.addEventListener('click', function () {
                selectedYear++;
                yearSpan.textContent = selectedYear;
                offset = 0;
                loadEvents(selectedCategory, selectedYear, selectedMonth, offset, true);
            });

            // Handle "View More" button click
            viewMoreBtn.addEventListener('click', function () {
                loadEvents(selectedCategory, selectedYear, selectedMonth, offset);
            });

            // Function to Load Events
            function loadEvents(categoryId, year, month, offset, reset = false) {
                fetch(`/filter-happenings-paginated?category_id=${categoryId}&year=${year}&month=${month}&offset=${offset}`)
                    .then(response => response.json())
                    .then(data => {
                        const grid = document.getElementById('events-grid');

                        if (reset) {
                            grid.innerHTML = '';  // Clear existing events when filtering
                        }

                        data.forEach(event => {
                            grid.innerHTML += `
                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    <img src="/${event.thumbnail_image}" alt="${event.title}" class="w-full h-32 object-cover mb-4 rounded">
                                    <h3 class="text-lg font-bold mb-2">${event.title}</h3>
                                    <p class="text-gray-700 text-sm mb-2">${event.small_description}</p>
                                    <p class="text-sm text-gray-500 mb-2">Location: ${event.location}</p>
                                    <p class="text-sm text-gray-500 mb-2">Category: ${event.categories.map(category => category.name).join(', ')}</p>
                                </div>
                            `;
                        });

                        offset += 8;  // Increment the offset for "View More"
                    })
                    .catch(error => console.error('Error fetching events:', error));
            }

        });
    </script>
@endpush
