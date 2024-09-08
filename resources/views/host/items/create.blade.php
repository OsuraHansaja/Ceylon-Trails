@extends('layouts.host')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Attraction</h1>

        <form action="{{ route('host.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" id="title" name="title" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Small Description -->
            <div class="mb-4">
                <label for="small_description" class="block text-gray-700 font-medium mb-2">Small Description</label>
                <textarea id="small_description" name="small_description" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500"></textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
                <input type="text" id="location" name="location" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Link -->
            <div class="mb-4">
                <label for="link" class="block text-gray-700 font-medium mb-2">Link</label>
                <input type="url" id="link" name="link" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Thumbnail Image -->
            <div class="mb-4">
                <label for="thumbnail_image" class="block text-gray-700 font-medium mb-2">Thumbnail Image</label>
                <input type="file" id="thumbnail_image" name="thumbnail_image" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Categories -->
            <div class="mb-4">
                <label for="categories" class="block text-gray-700 font-medium mb-2">Categories</label>
                <div class="mb-4">
                    <div id="categories" class="flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <button type="button"
                                    class="category-button inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-pointer"
                                    data-category-id="{{ $category->id }}"
                                    style="border-color: #333; color: #333;">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Hidden inputs for selected categories will be appended here -->
            <div id="category-inputs"></div>

            <!-- Large Description -->
            <div class="mb-4">
                <label for="large_description" class="block text-gray-700 font-medium mb-2">Large Description</label>
                <textarea id="large_description" name="large_description" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500"></textarea>
            </div>

            <button type="submit" class="mt-4 text-white font-bold p-3 rounded-md" style="background-color: #EA7529; opacity: 1;" onmouseover="this.style.backgroundColor='#ff8000'" onmouseout="this.style.backgroundColor='#EA7529'">Create Attraction</button>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryInputsDiv = document.getElementById('category-inputs');
        const categoryButtons = document.querySelectorAll('.category-button');
        let selectedCategories = [];

        categoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                const categoryId = this.getAttribute('data-category-id');

                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    this.style.backgroundColor = '';
                    this.style.color = '#333';
                    removeCategory(categoryId);
                } else {
                    this.classList.add('selected');
                    this.style.backgroundColor = '#333';
                    this.style.color = '#fff';
                    addCategory(categoryId);
                }
            });
        });

        function addCategory(id) {
            if (!selectedCategories.includes(id)) {
                selectedCategories.push(id);
                // Create a new hidden input for each selected category
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'category_ids[]';
                input.value = id;
                input.id = `category-input-${id}`;
                categoryInputsDiv.appendChild(input);
            }
        }

        function removeCategory(id) {
            selectedCategories = selectedCategories.filter(c => c !== id);
            const inputToRemove = document.getElementById(`category-input-${id}`);
            if (inputToRemove) {
                inputToRemove.remove();
            }
        }
    });
</script>
