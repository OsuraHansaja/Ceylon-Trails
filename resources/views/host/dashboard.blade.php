@extends('layouts.host')

@section('content')
    <div class="container mx-auto">
        <!-- Attractions Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Attractions</h2>

            @if ($items->isEmpty())
                <p class="text-gray-600">You haven't created any attractions yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($items as $item)
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            @if ($item->thumbnail_image)
                                <img src="{{ asset($item->thumbnail_image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover mb-4 rounded">
                            @endif
                            <h3 class="text-xl font-bold mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-700 mb-2">{{ $item->small_description }}</p>
                            <p class="text-sm text-gray-500 mb-2">Location: {{ $item->location }}</p>
                            <p class="text-sm text-gray-500 mb-2">Link: <a href="{{ $item->link }}" class="text-blue-500" target="_blank">{{ $item->link }}</a></p>
                            <p class="text-sm text-gray-500 mb-2">Category: {{ $item->categories->pluck('name')->join(', ') }}</p>
                            <div class="flex space-x-4 mt-4">
                                <a href="{{ route('host.items.edit', $item->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-md">Edit</a>
                                <form action="{{ route('host.items.destroy', $item->id) }}" method="POST" onsubmit="return confirmDeletion()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border border-gray-400 text-gray-700 px-4 py-2 rounded-md hover:bg-red-500 hover:text-white">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Events Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Events</h2>

            @if ($events->isEmpty())
                <p class="text-gray-600">You haven't created any events yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($events as $event)
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            @if ($event->thumbnail_image)
                                <img src="{{ asset($event->thumbnail_image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover mb-4 rounded">
                            @endif
                            <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-700 mb-2">{{ $event->small_description }}</p>
                            <p class="text-sm text-gray-500 mb-2">Location: {{ $event->location }}</p>
                            <p class="text-sm text-gray-500 mb-2">Link: <a href="{{ $event->link }}" class="text-blue-500" target="_blank">{{ $event->link }}</a></p>
                            <p class="text-sm text-gray-500 mb-2">Category: {{ $event->categories->pluck('name')->join(', ') }}</p>
                            <p class="text-sm text-gray-500 mb-2">Start Date: {{ $event->start_date->format('d M Y') }}</p>
                            <p class="text-sm text-gray-500 mb-2">End Date: {{ $event->end_date->format('d M Y') }}</p>
                            <div class="flex space-x-4 mt-4">
                                <a href="{{ route('host.events.edit', $event->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-md">Edit</a>
                                <form action="{{ route('host.events.destroy', $event->id) }}" method="POST" onsubmit="return confirmDeletion()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border border-gray-400 text-gray-700 px-4 py-2 rounded-md hover:bg-red-500 hover:text-white">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
