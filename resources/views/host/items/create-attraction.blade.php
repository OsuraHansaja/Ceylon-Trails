<x-host-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Create Attraction</h2>

        <form method="POST" action="{{ route('host.items.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded" value="{{ old('title') }}" required>
            </div>

            <!-- Small Description -->
            <div class="mb-4">
                <label for="small_description" class="block text-gray-700">Small Description</label>
                <textarea name="small_description" id="small_description" class="w-full p-2 border rounded" rows="3" required>{{ old('small_description') }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700">Location</label>
                <input type="text" name="location" id="location" class="w-full p-2 border rounded" value="{{ old('location') }}" required>
            </div>

            <!-- Link -->
            <div class="mb-4">
                <label for="link" class="block text-gray-700">Link</label>
                <input type="url" name="link" id="link" class="w-full p-2 border rounded" value="{{ old('link') }}">
            </div>

            <!-- Thumbnail Image -->
            <div class="mb-4">
                <label for="thumbnail_image" class="block text-gray-700">Thumbnail Image</label>
                <input type="file" name="thumbnail_image" id="thumbnail_image" class="w-full p-2 border rounded" required>
            </div>

            <!-- Cover Photo -->
            <div class="mb-4">
                <label for="cover_photo" class="block text-gray-700">Cover Photo</label>
                <input type="file" name="cover_photo" id="cover_photo" class="w-full p-2 border rounded">
            </div>

            <!-- Categories -->
            <div class="mb-4">
                <label for="categories" class="block text-gray-700">Categories</label>
                <div class="flex flex-wrap">
                    @foreach($categories as $category)
                        <div class="mr-4 mb-2">
                            <input type="checkbox" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}">
                            <label for="category-{{ $category->id }}" class="text-gray-700">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Large Description -->
            <div class="mb-4">
                <label for="large_description" class="block text-gray-700">Large Description</label>
                <textarea name="large_description" id="large_description" class="w-full p-2 border rounded" rows="6" required>{{ old('large_description') }}</textarea>
            </div>

            <!-- Gallery Images -->
            <div class="mb-4">
                <label for="gallery_images" class="block text-gray-700">Gallery Images (up to 6)</label>
                <input type="file" name="gallery_images[]" id="gallery_images" class="w-full p-2 border rounded" multiple>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-orange-600 text-white p-3 rounded-md hover:bg-orange-700">Create Attraction</button>
        </form>
    </div>
</x-host-layout>
