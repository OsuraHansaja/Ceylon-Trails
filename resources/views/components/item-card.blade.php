<!-- resources/views/components/item-card.blade.php -->

<div class="item-card max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full h-64 object-cover" src="{{ asset($item->thumbnail_image) }}" alt="{{ $item->title }}">
    <div class="px-6 py-4">
        <h3 class="font-bold text-xl mb-2">{{ $item->title }}</h3>
        <p class="text-gray-700 text-base">
            {{ $item->small_description }}
        </p>
    </div>
</div>
