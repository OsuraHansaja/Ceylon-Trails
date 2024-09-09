@extends('layouts.host')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Event</h1>

        <form action="{{ route('host.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ $event->title }}" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Small Description -->
            <div class="mb-4">
                <label for="small_description" class="block text-gray-700 font-medium mb-2">Small Description</label>
                <textarea id="small_description" name="small_description" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">{{ $event->small_description }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium mb-2">Location (District)</label>
                <select id="location" name="location" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
                    <option value="">Select a district</option>
                    <option value="Ampara" {{ $event->location == 'Ampara' ? 'selected' : '' }}>Ampara</option>
                    <option value="Anuradhapura" {{ $event->location == 'Anuradhapura' ? 'selected' : '' }}>Anuradhapura</option>
                    <option value="Badulla" {{ $event->location == 'Badulla' ? 'selected' : '' }}>Badulla</option>
                    <option value="Batticaloa" {{ $event->location == 'Batticaloa' ? 'selected' : '' }}>Batticaloa</option>
                    <option value="Colombo" {{ $event->location == 'Colombo' ? 'selected' : '' }}>Colombo</option>
                    <option value="Galle" {{ $event->location == 'Galle' ? 'selected' : '' }}>Galle</option>
                    <option value="Gampaha" {{ $event->location == 'Gampaha' ? 'selected' : '' }}>Gampaha</option>
                    <option value="Hambantota" {{ $event->location == 'Hambantota' ? 'selected' : '' }}>Hambantota</option>
                    <option value="Jaffna" {{ $event->location == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                    <option value="Kalutara" {{ $event->location == 'Kalutara' ? 'selected' : '' }}>Kalutara</option>
                    <option value="Kandy" {{ $event->location == 'Kandy' ? 'selected' : '' }}>Kandy</option>
                    <option value="Kegalle" {{ $event->location == 'Kegalle' ? 'selected' : '' }}>Kegalle</option>
                    <option value="Kilinochchi" {{ $event->location == 'Kilinochchi' ? 'selected' : '' }}>Kilinochchi</option>
                    <option value="Kurunegala" {{ $event->location == 'Kurunegala' ? 'selected' : '' }}>Kurunegala</option>
                    <option value="Mannar" {{ $event->location == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                    <option value="Matale" {{ $event->location == 'Matale' ? 'selected' : '' }}>Matale</option>
                    <option value="Matara" {{ $event->location == 'Matara' ? 'selected' : '' }}>Matara</option>
                    <option value="Monaragala" {{ $event->location == 'Monaragala' ? 'selected' : '' }}>Monaragala</option>
                    <option value="Mullaitivu" {{ $event->location == 'Mullaitivu' ? 'selected' : '' }}>Mullaitivu</option>
                    <option value="Nuwara Eliya" {{ $event->location == 'Nuwara Eliya' ? 'selected' : '' }}>Nuwara Eliya</option>
                    <option value="Polonnaruwa" {{ $event->location == 'Polonnaruwa' ? 'selected' : '' }}>Polonnaruwa</option>
                    <option value="Puttalam" {{ $event->location == 'Puttalam' ? 'selected' : '' }}>Puttalam</option>
                    <option value="Ratnapura" {{ $event->location == 'Ratnapura' ? 'selected' : '' }}>Ratnapura</option>
                    <option value="Trincomalee" {{ $event->location == 'Trincomalee' ? 'selected' : '' }}>Trincomalee</option>
                    <option value="Vavuniya" {{ $event->location == 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
                </select>
            </div>

            <!-- Link -->
            <div class="mb-4">
                <label for="link" class="block text-gray-700 font-medium mb-2">Link</label>
                <input type="url" id="link" name="link" value="{{ $event->link }}" class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- Start Date -->
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ $event->start_date->format('Y-m-d') }}" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 font-medium mb-2">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ $event->end_date->format('Y-m-d') }}" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">
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
                <textarea id="large_description" name="large_description" required class="w-full p-3 border rounded-md focus:ring focus:ring-orange-500">{{ $event->large_description }}</textarea>
            </div>

            <button type="submit" class="mt-4 text-white font-bold p-3 rounded-md" style="background-color: #EA7529; opacity: 1;" onmouseover="this.style.backgroundColor='#ff8000'" onmouseout="this.style.backgroundColor='#EA7529'">Save Changes</button>
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

