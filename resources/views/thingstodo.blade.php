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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="items-grid">
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
                <button id="view-more-btn" class="bg-black text-white font-bold py-2 px-4 rounded">
                    View More
                </button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let offset = 8;  // Default offset to load more items
        let selectedCategory = 'all';  // Default selected category

        document.addEventListener('DOMContentLoaded', function () {
            const categoryButtons = document.querySelectorAll('.category-button');
            const viewMoreBtn = document.getElementById('view-more-btn');

            // Handle Category Filtering
            categoryButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Update button appearance
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('selected');
                        btn.style.backgroundColor = '';
                        btn.style.color = '#333';
                    });

                    this.classList.add('selected');
                    this.style.backgroundColor = '#333';
                    this.style.color = '#fff';

                    selectedCategory = this.getAttribute('data-category-id');
                    offset = 0;  // Reset the offset when changing the category
                    loadItems(selectedCategory, offset, true);  // Load new filtered items
                });
            });

            // Handle "View More" button click
            viewMoreBtn.addEventListener('click', function () {
                loadItems(selectedCategory, offset);  // Load more items of the selected category
            });

            // Function to Load Items
            function loadItems(categoryId, offset, reset = false) {
                fetch(`/filter-items-paginated?category_id=${categoryId}&offset=${offset}`)
                    .then(response => response.json())
                    .then(data => {
                        const grid = document.getElementById('items-grid');

                        if (reset) {
                            grid.innerHTML = '';  // Clear existing items when filtering by a new category
                        }

                        data.forEach(item => {
                            grid.innerHTML += `
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <img src="/${item.thumbnail_image}" alt="${item.title}" class="w-full h-32 object-cover mb-4 rounded">
                                <h3 class="text-lg font-bold mb-2">${item.title}</h3>
                                <p class="text-gray-700 text-sm mb-2">${item.small_description}</p>
                                <p class="text-sm text-gray-500 mb-2">Location: ${item.location}</p>
                                <p class="text-sm text-gray-500 mb-2">Category: ${item.categories.map(category => category.name).join(', ')}</p>
                            </div>
                        `;
                        });

                        offset += 8;  // Increment the offset for the next "View More" action
                    })
                    .catch(error => console.error('Error fetching items:', error));
            }
        });
    </script>
@endpush
