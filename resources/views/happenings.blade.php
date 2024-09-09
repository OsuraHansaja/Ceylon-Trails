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

    <!-- Month Filter Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Month and Year Selection -->
            <div class="flex justify-center items-center mb-4">
                <button class="px-3 py-1 bg-gray-200 text-gray-600 font-semibold rounded-l-lg">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="px-6 py-2 bg-white text-gray-700 font-semibold">2024</span>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 font-semibold rounded-r-lg">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="flex justify-center gap-2 mb-6">
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Jan</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Feb</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Mar</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Apr</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer selected bg-black text-white">
                    May
                </button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Jun</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Jul</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Aug</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Sep</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Oct</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Nov</button>
                <button class="month-button px-4 py-2 text-sm font-semibold border rounded-full cursor-pointer">Dec</button>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                <button class="bg-black text-white font-bold py-2 px-4 rounded">
                    View More
                </button>
            </div>
        </div>
    </section>
@endsection
