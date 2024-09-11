@extends('layouts.ct')

@section('content')
    <section class="p-6">
        <h1 class="text-3xl font-bold mb-6">Explore Sri Lanka</h1>

        <!-- Embed the SVG map -->
        <div class="map-container">
            {!! file_get_contents(public_path('images/sri_lanka_svg.svg')) !!}
        </div>

        <!-- Section to load items dynamically -->
        <div id="district-items" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
            <!-- Default items will be loaded here (Colombo) -->
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
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM fully loaded and parsed');

            const svgDistricts = document.querySelectorAll('svg [title]');
            console.log(`SVG Districts found:`, svgDistricts);

            svgDistricts.forEach((district, index) => {
                console.log(`${index}: ${district.tagName}${district.id}`);
                district.addEventListener('click', function() {
                    const districtTitle = this.getAttribute('title'); // Get the title of the clicked district
                    console.log(`Clicked district: ${districtTitle}`);
                    loadDistrictItems(districtTitle); // Call function to load items for the selected district
                });
            });
        });

        function loadDistrictItems(districtTitle) {
            console.log(`Fetching items for district: ${districtTitle}`);

            fetch(`/explore-sri-lanka/items/${districtTitle}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const itemsContainer = document.getElementById('district-items');
                    itemsContainer.innerHTML = ''; // Clear current items

                    data.forEach(item => {
                        itemsContainer.innerHTML += `
                    <a href="/item/${item.id}" class="block">
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <img src="${item.thumbnail_image}" alt="${item.title}" class="w-full h-32 object-cover mb-4 rounded">
                            <h3 class="text-lg font-bold mb-2">${item.title}</h3>
                            <p class="text-gray-700 text-sm mb-2">${item.small_description}</p>
                            <p class="text-sm text-gray-500 mb-2">Location: ${item.location}</p>
                            <p class="text-sm text-gray-500 mb-2">Category: ${item.category}</p>
                        </div>
                    </a>
                `;
                    });
                })
                .catch(error => {
                    console.error('Error fetching items:', error);
                });
        }
    </script>
@endpush

