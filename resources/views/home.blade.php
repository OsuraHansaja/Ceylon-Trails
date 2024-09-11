@extends('layouts.ct')

@section('content')
    <!-- Hero Section -->
    <section class="banner relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/homepagehero.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col justify-center items-center h-full text-white">
            <h1 class="text-5xl font-bold">WELCOME TO <br>SRI LANKA</h1>
        </div>
    </section>

    <!-- Things To Do Section -->
    <section class="p-6">
        <!-- Attractions Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Things To Do</h2>
            <!-- Categories Filter for Attractions -->
            <div class="mb-4">
                <div id="categories" class="flex flex-wrap gap-2">
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
            </div>
            <!-- Attractions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="attractions-grid">
                @foreach ($items as $item)
                    <a href="{{ route('item.details', $item->id) }}" class="block">
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            @if ($item->thumbnail_image)
                                <img src="{{ asset($item->thumbnail_image) }}" alt="{{ $item->title }}" class="w-full h-32 object-cover mb-4 rounded">
                            @endif
                            <h3 class="text-lg font-bold mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-700 text-sm mb-2">{{ Str::limit($item->small_description, 100) }}</p>
                            <p class="text-sm text-gray-500 mb-2">Location: {{ $item->location }}</p>
                            <p class="text-sm text-gray-500 mb-2">Category: {{ $item->categories->pluck('name')->join(', ') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- What's Going On Section -->
    <section class="p-6">
        <!-- Events Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">What's Going On</h2>
            <!-- Categories Filter for Events -->
            <div class="mb-4">
                <div id="event-categories" class="flex flex-wrap gap-2">
                    <button type="button"
                            class="event-category-button inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-pointer selected"
                            data-category-id="all"
                            style="border-color: #333; color: #fff; background-color: #333;">
                        All
                    </button>
                    @foreach ($categories as $category)
                        <button type="button"
                                class="event-category-button inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-pointer"
                                data-category-id="{{ $category->id }}"
                                style="border-color: #333; color: #333;">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="events-grid">
                @foreach ($events as $event)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <a href="{{ route('event.details', $event->id) }}">
                            @if ($event->thumbnail_image)
                                <img src="{{ asset($event->thumbnail_image) }}" alt="{{ $event->title }}" class="w-full h-32 object-cover mb-4 rounded">
                            @endif
                            <h3 class="text-lg font-bold mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-700 text-sm mb-2">{{ Str::limit($event->small_description, 100) }}</p>
                            <p class="text-sm text-gray-500 mb-2">Location: {{ $event->location }}</p>
                            <p class="text-sm text-gray-500 mb-2">Link: <a href="{{ $event->link }}" class="text-blue-500" target="_blank">{{ $event->link }}</a></p>
                            <p class="text-sm text-gray-500 mb-2">Category: {{ $event->categories->pluck('name')->join(', ') }}</p>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryButtons = document.querySelectorAll('.category-button');
        const eventCategoryButtons = document.querySelectorAll('.event-category-button');

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

                // Future logic to filter attractions based on category will go here
            });
        });

        eventCategoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                eventCategoryButtons.forEach(btn => {
                    btn.classList.remove('selected');
                    btn.style.backgroundColor = '';
                    btn.style.color = '#333';
                });

                this.classList.add('selected');
                this.style.backgroundColor = '#333';
                this.style.color = '#fff';

                // Future logic to filter events based on category will go here
            });
        });
    });
</script>
