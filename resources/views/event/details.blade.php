@extends('layouts.ct')

@section('content')
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Title -->
            <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>

            <!-- Location -->
            <p class="text-lg text-gray-600 mb-4"><strong>Location:</strong> {{ $event->location }}</p>

            <!-- Categories -->
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($event->categories as $category)
                    <span class="inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-default"
                          style="border-color: #333; color: #333;">
                    {{ $category->name }}
                </span>
                @endforeach
            </div>

            <!-- Link -->
            @if($event->link)
                <p class="text-lg text-blue-500 mb-4">
                    <strong>Link:</strong>
                    <a href="{{ $event->link }}" target="_blank">{{ $event->link }}</a>
                </p>
            @endif

            <!-- Large Description -->
            <div class="mb-6">
                <h2 class="text-xl font-bold mb-2">Description</h2>
                <p class="text-gray-700">{{ $event->large_description }}</p>
            </div>

            <!-- Gallery Images -->
            <div class="grid grid-cols-4 gap-6">
                @if($event->gallery_image_1)
                    <div class="flex justify-center items-center bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $event->gallery_image_1) }}" alt="Gallery Image 1" class="h-64 object-cover rounded">
                    </div>
                @endif

                @if($event->gallery_image_2)
                    <div class="flex justify-center items-center bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $event->gallery_image_2) }}" alt="Gallery Image 2" class="h-64 object-cover rounded">
                    </div>
                @endif

                @if($event->gallery_image_3)
                    <div class="flex justify-center items-center bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $event->gallery_image_3) }}" alt="Gallery Image 3" class="h-64 object-cover rounded">
                    </div>
                @endif

                @if($event->gallery_image_4)
                    <div class="flex justify-center items-center bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $event->gallery_image_4) }}" alt="Gallery Image 4" class="h-64 object-cover rounded">
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
