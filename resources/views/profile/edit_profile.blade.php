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
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Profile Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <!-- First Name -->
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" class="block w-full border rounded mt-1">
                </div>

                <!-- Last Name -->
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" class="block w-full border rounded mt-1">
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="block w-full border rounded mt-1">
                </div>

                <!-- Date of Birth -->
                <div class="mb-4">
                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="{{ $user->dob }}" class="block w-full border rounded mt-1">
                </div>

                <!-- Gender -->
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" class="block w-full border rounded mt-1">
                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Categories (Preferences) -->
                <div class="mb-4">
                    <label for="categories" class="block text-sm font-medium text-gray-700">Preferences (Select at least one)</label>
                    <div class="mt-2">
                        @foreach ($categories as $category)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       {{ $user->categories->contains($category->id) ? 'checked' : '' }} class="form-checkbox">
                                <span class="ml-2">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Delete Account Section -->
    <section class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Delete Account</h2>
            <form action="{{ route('profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')

                <!-- Password Input for Deletion Confirmation -->
                <div class="mb-4">
                    <label for="delete_password" class="block text-sm font-medium text-gray-700">Enter Password to Confirm:</label>
                    <input type="password" name="delete_password" id="delete_password" class="mt-1 block w-full border rounded py-2 px-3">
                </div>

                <!-- Delete Account Button -->
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete Account</button>
            </form>
        </div>
    </section>

    <!-- Add JavaScript for popup message -->
    @if ($errors->has('delete_password'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                alert('{{ $errors->first('delete_password') }}');
            });
        </script>
    @endif

@endsection
