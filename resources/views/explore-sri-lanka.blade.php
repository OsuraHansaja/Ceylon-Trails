@extends('layouts.ct')

@section('content')
    <section class="p-6">
        <!-- Container for map and cards -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- SVG Map Column -->
            <div class="w-full lg:w-1/2 relative">
                <!-- Embed the SVG map with hover and tooltip effects using Alpine.js -->
                <div class="map-container" x-data="{ tooltip: '', showTooltip: false, x: 0, y: 0 }">
                    <div @mousemove="x = $event.clientX; y = $event.clientY">
                        {!! file_get_contents(public_path('images/sri_lanka_svg.svg')) !!}

                        <!-- Tooltip Display -->
                        <div x-show="showTooltip" x-text="tooltip"
                             class="absolute bg-white text-black p-2 rounded shadow-md pointer-events-none"
                             :style="{ top: `${y + 10}px`, left: `${x + 10}px` }">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards Column -->
            <div class="w-full lg:w-1/2">
                <!-- Section to load items dynamically -->
                <div id="district-items">
                    <!-- District Name Title -->
                    <h2 id="district-title" class="text-2xl font-bold mb-4">Colombo</h2>

                    <!-- District Description -->
                    <p id="district-description" class="text-gray-700 mb-4">Colombo is the commercial capital and the largest city of Sri Lanka, bustling with activity and cultural landmarks.</p>

                    <!-- Items Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="items-grid">
                        <!-- Default items will be loaded here (e.g., Colombo) -->
                        @foreach ($items as $item)
                            <a href="{{ route('item.details', $item->id) }}" class="block transform transition-transform hover:scale-105 hover:shadow-lg">
                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    @if ($item->thumbnail_image)
                                        <img src="{{ asset($item->thumbnail_image) }}" alt="{{ $item->title }}" class="w-full h-32 object-cover mb-4 rounded">
                                    @endif
                                    <h3 class="text-lg font-bold mb-2">{{ $item->title }}</h3>
                                    <p class="text-gray-700 text-sm mb-2">{{ Str::limit($item->small_description, 100) }}</p>
                                    <p class="text-sm text-gray-500 mb-2">Location: {{ $item->location }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const svgDistricts = document.querySelectorAll('svg [title]');
            const tooltip = document.querySelector('.map-container [x-data]');

            // Object to hold district descriptions
            const districtDescriptions = {
                'Ampara': 'Ampara is known for its scenic beauty, rich paddy fields, and serene coastal areas.',
                'Anuradhapura': 'Anuradhapura is a UNESCO World Heritage site, famous for its ancient ruins and stupas.',
                'Badulla': 'Badulla is surrounded by tea plantations and waterfalls, offering breathtaking scenery.',
                'Batticaloa': 'Batticaloa is known for its beautiful lagoons and historical fort, along with a rich cultural heritage.',
                'Colombo': 'Colombo is the commercial capital and the largest city of Sri Lanka, bustling with activity and cultural landmarks.',
                'Galle': 'Galle is famous for its well-preserved colonial architecture, including the iconic Galle Fort.',
                'Gampaha': 'Gampaha is known for its vibrant suburban life, botanical gardens, and rich agricultural areas.',
                'Hambantota': 'Hambantota features beautiful beaches, national parks, and modern development projects.',
                'Jaffna': 'Jaffna is rich in Tamil culture, historical landmarks, and unique cuisine, with stunning coastal areas.',
                'Kalutara': 'Kalutara is known for its golden beaches, rich Buddhist heritage, and iconic Kalutara Bodhiya.',
                'Kandy': 'Kandy is a cultural and historical center, famous for the Temple of the Sacred Tooth Relic.',
                'Kegalle': 'Kegalle is known for its lush greenery, rubber plantations, and the Pinnawala Elephant Orphanage.',
                'Kilinochchi': 'Kilinochchi has a rich agricultural base and is known for its historical significance.',
                'Kurunegala': 'Kurunegala is surrounded by rock formations and is a key agricultural hub.',
                'Mannar': 'Mannar is known for its rich history, unique landscapes, and vibrant fishing communities.',
                'Matale': 'Matale is known for its spice gardens and the stunning Knuckles Mountain Range.',
                'Matara': 'Matara is a coastal city known for its picturesque beaches, forts, and cultural landmarks.',
                'Monaragala': 'Monaragala is famous for its natural beauty, waterfalls, and ancient ruins.',
                'Mullaitivu': 'Mullaitivu is known for its scenic beaches, forests, and historical significance.',
                'Nuwara Eliya': 'Nuwara Eliya is a hill country town known for its tea plantations and cool climate.',
                'Polonnaruwa': 'Polonnaruwa is an ancient city with well-preserved ruins, temples, and stupas.',
                'Puttalam': 'Puttalam is famous for its lagoons, salt production, and the Wilpattu National Park.',
                'Ratnapura': 'Ratnapura is known as the "City of Gems" and is surrounded by lush rainforests and waterfalls.',
                'Trincomalee': 'Trincomalee boasts pristine beaches, natural harbors, and rich cultural diversity.',
                'Vavuniya': 'Vavuniya serves as a gateway to the Northern Province, known for its agricultural landscapes.',
            };


            svgDistricts.forEach(district => {
                // Add hover effects
                district.classList.add('hover:fill-green-300', 'cursor-pointer', 'transition', 'duration-300');

                // Handle district click
                district.addEventListener('click', function () {
                    const districtTitle = this.getAttribute('title');
                    loadDistrictItems(districtTitle);

                    // Update the district description
                    const description = districtDescriptions[districtTitle] || 'Description not available.';
                    document.getElementById('district-description').textContent = description;
                });

                // Handle district hover (tooltip)
                district.addEventListener('mouseenter', function () {
                    const districtTitle = this.getAttribute('title');
                    tooltip.__x.$data.tooltip = districtTitle;
                    tooltip.__x.$data.showTooltip = true;
                });

                district.addEventListener('mouseleave', function () {
                    tooltip.__x.$data.showTooltip = false;
                });
            });
        });

        function loadDistrictItems(districtTitle) {
            // Update the district name title
            document.getElementById('district-title').textContent = districtTitle;

            fetch(`/explore-sri-lanka/items/${districtTitle}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const itemsContainer = document.getElementById('items-grid');
                    itemsContainer.innerHTML = ''; // Clear current items

                    data.forEach(item => {
                        itemsContainer.innerHTML += `
                            <a href="/item/${item.id}" class="block transform transition-transform hover:scale-105 hover:shadow-lg">
                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    <img src="${item.thumbnail_image}" alt="${item.title}" class="w-full h-32 object-cover mb-4 rounded">
                                    <h3 class="text-lg font-bold mb-2">${item.title}</h3>
                                    <p class="text-gray-700 text-sm mb-2">${item.small_description}</p>
                                    <p class="text-sm text-gray-500 mb-2">Location: ${item.location}</p>
                                </div>
                            </a>`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching items:', error);
                });
        }
    </script>
@endpush
