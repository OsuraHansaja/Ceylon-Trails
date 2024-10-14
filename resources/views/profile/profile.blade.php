@extends('layouts.ct')

@section('content')
    <!-- Hero Section with Cover Photo -->
    <section class="relative h-96 bg-cover bg-center" style="background-image: url('{{ asset('images/place_holder_cover_image.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="relative z-10 flex justify-center items-center h-full">
            <!-- Profile Card -->
            <div class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-6">
                <!-- Profile Picture -->
                <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-300">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/placeholder_profile_pic.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
                </div>

                <!-- User Info -->
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-gray-500">{{ '@' . $user->username }}</p>

                    <!-- Categories (Preferences) -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($user->categories as $category)
                            <span class="inline-block px-3 py-1 text-sm font-semibold border rounded-full text-gray-800">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="ml-6">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-white-500 text-gray-700 rounded">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Saved Items Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Saved Items</h2>
            @if ($savedItems->isEmpty())
                <p>No saved items yet.</p>
            @else
                <!-- Saved Items Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($savedItems as $item)
                        <a href="{{ route('item.details', $item->id) }}" class="block">
                            <div class="bg-white p-4 rounded-lg shadow-md transform transition-transform hover:scale-105 hover:shadow-lg">
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
            @endif
        </div>
    </section>
@endsection
