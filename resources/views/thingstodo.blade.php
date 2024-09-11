@extends('layouts.ct')

@section('content')
    <!-- Hero Section -->
    <section class="banner relative h-[60vh] bg-cover bg-center" style="background-image: url('{{ asset('images/thingstodohero.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col justify-center items-start h-full text-white px-12">
            <h1 class="text-2xl md:text-2xl lg:text-2xl font-bold">Top Things To Do</h1>
            <p class="text-lg md:text-xl lg:text-2xl mt-4">Discover Sri Lanka's hidden gems with our top picks.</p>
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

            <!-- Items Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        @if ($item->thumbnail_image)
                            <img src="{{ asset($item->thumbnail_image) }}" alt="{{ $item->title }}" class="w-full h-32 object-cover mb-4 rounded">
                        @endif
                        <h3 class="text-lg font-bold mb-2">{{ $item->title }}</h3>
                        <p class="text-gray-700 text-sm mb-2">{{ Str::limit($item->small_description, 100) }}</p>
                        <p class="text-sm text-gray-500 mb-2">Location: {{ $item->location }}</p>
                        <p class="text-sm text-gray-500 mb-2">Category: {{ $item->categories->pluck('name')->join(', ') }}</p>
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
