<x-host-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Attraction</h1>

        <form action="{{ route('host.items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ $item->title }}" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Small Description -->
            <div class="mb-4">
                <label for="small_description" class="block text-gray-700 font-medium mb-2">Small Description</label>
                <textarea id="small_description" name="small_description" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">{{ $item->small_description }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
                <input type="text" id="location" name="location" value="{{ $item->location }}" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Link -->
            <div class="mb-4">
                <label for="link" class="block text-gray-700 font-medium mb-2">Link</label>
                <input type="url" id="link" name="link" value="{{ $item->link }}" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Categories -->
            <div class="mb-4">
                <label for="categories" class="block text-gray-700 font-medium mb-2">Categories</label>
                <div id="categories" class="flex flex-wrap gap-2">
                    @foreach ($categories as $category)
                        <button type="button"
                                class="category-button inline-block px-3 py-1 text-sm font-semibold border rounded-full cursor-pointer"
                                data-category-id="{{ $category->id }}"
                                style="border-color: {{ in_array($category->id, $item->categories->pluck('id')->toArray()) ? '#333' : '#ccc' }};
                                       color: {{ in_array($category->id, $item->categories->pluck('id')->toArray()) ? '#fff' : '#333' }};
                                       background-color: {{ in_array($category->id, $item->categories->pluck('id')->toArray()) ? '#333' : 'transparent' }};">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="category_ids" id="selected-categories" value="{{ implode(',', $item->categories->pluck('id')->toArray()) }}">
            </div>

            <!-- Large Description -->
            <div class="mb-4">
                <label for="large_description" class="block text-gray-700 font-medium mb-2">Large Description</label>
                <textarea id="large_description" name="large_description" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">{{ $item->large_description }}</textarea>
            </div>

            <button type="submit" class="mt-4 text-white font-bold p-3 rounded-md" style="background-color: #EA7529; opacity: 1;" onmouseover="this.style.backgroundColor='#ff8000'" onmouseout="this.style.backgroundColor='#EA7529'">Save Changes</button>
        </form>
    </div>
</x-host-layout>
//script for selecting category
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectedCategoriesInput = document.getElementById('selected-categories');
        const categoryButtons = document.querySelectorAll('.category-button');

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
            let selectedCategories = selectedCategoriesInput.value.split(',').filter(c => c);
            selectedCategories.push(id);
            selectedCategoriesInput.value = selectedCategories.join(',');
        }

        function removeCategory(id) {
            let selectedCategories = selectedCategoriesInput.value.split(',').filter(c => c);
            selectedCategories = selectedCategories.filter(c => c !== id);
            selectedCategoriesInput.value = selectedCategories.join(',');
        }
    });
</script>
