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
            </div>
        </div>
    </section>

    <!-- Saved Items Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Saved Items</h2>
            <p>Saved items feature coming soon...</p>
        </div>
    </section>
@endsection
