@extends('layouts.host')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">All Reviews for Your Items</h1>

        @if ($reviews->isEmpty())
            <p class="text-gray-600">No reviews have been posted for your items yet.</p>
        @else
            <div class="grid grid-cols-1 gap-6">
                @foreach ($reviews as $review)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold">{{ $review->item->title }}</h2>
                        <p class="text-gray-600">
                            <strong>Rating:</strong> {{ $review->rating }} Stars
                        </p>
                        <p class="text-gray-700">{{ $review->review ?? 'No written review provided.' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
