@extends('layouts.host')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Event</h1>

        <form action="{{ route('host.events.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="location" class="block text-gray-700 font-medium mb-2">Location (District)</label>
                <select id="location" name="location" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
                    <option value="">Select a district</option>
                    <option value="Ampara">Ampara</option>
                    <option value="Anuradhapura">Anuradhapura</option>
                    <option value="Badulla">Badulla</option>
                    <option value="Batticaloa">Batticaloa</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Galle">Galle</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Hambantota">Hambantota</option>
                    <option value="Jaffna">Jaffna</option>
                    <option value="Kalutara">Kalutara</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Kegalle">Kegalle</option>
                    <option value="Kilinochchi">Kilinochchi</option>
                    <option value="Kurunegala">Kurunegala</option>
                    <option value="Mannar">Mannar</option>
                    <option value="Matale">Matale</option>
                    <option value="Matara">Matara</option>
                    <option value="Monaragala">Monaragala</option>
                    <option value="Mullaitivu">Mullaitivu</option>
                    <option value="Nuwara Eliya">Nuwara Eliya</option>
                    <option value="Polonnaruwa">Polonnaruwa</option>
                    <option value="Puttalam">Puttalam</option>
                    <option value="Ratnapura">Ratnapura</option>
                    <option value="Trincomalee">Trincomalee</option>
                    <option value="Vavuniya">Vavuniya</option>
                </select>
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

            <!-- Gallery Image 1 -->
            <div class="mb-4">
                <label for="gallery_image_1" class="block text-gray-700 font-medium mb-2">Gallery Image 1</label>
                <input type="file" id="gallery_image_1" name="gallery_image_1" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Gallery Image 2 -->
            <div class="mb-4">
                <label for="gallery_image_2" class="block text-gray-700 font-medium mb-2">Gallery Image 2</label>
                <input type="file" id="gallery_image_2" name="gallery_image_2" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Gallery Image 3 -->
            <div class="mb-4">
                <label for="gallery_image_3" class="block text-gray-700 font-medium mb-2">Gallery Image 3</label>
                <input type="file" id="gallery_image_3" name="gallery_image_3" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Gallery Image 4 -->
            <div class="mb-4">
                <label for="gallery_image_4" class="block text-gray-700 font-medium mb-2">Gallery Image 4</label>
                <input type="file" id="gallery_image_4" name="gallery_image_4" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Start Date -->
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                <input type="date" id="start_date" name="start_date" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 font-medium mb-2">End Date</label>
                <input type="date" id="end_date" name="end_date" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
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

            <button type="submit" class="mt-4 text-white font-bold p-3 rounded-md" style="background-color: #EA7529; opacity: 1;" onmouseover="this.style.backgroundColor='#ff8000'" onmouseout="this.style.backgroundColor='#EA7529'">Create Event</button>

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
