@extends('layouts.host') <!-- Extend from the host layout -->

@section('content')
    <div class="container mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900">Manage Your Profile</h2>
            <p class="mt-4 text-gray-700">Update your account settings here.</p>

            <!-- Update Profile Picture -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Profile Picture</h3>
                <form method="POST" action="{{ route('host.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col items-start"> <!-- Aligned items to the left -->
                        <!-- Profile Picture Display and Upload -->
                        <label for="profile_picture" class="relative cursor-pointer">
                            <img id="profileImage"
                                 src="{{ asset('storage/' . Auth::guard('host')->user()->profile_picture) }}"
                                 alt="Profile Picture"
                                 class="rounded-full w-40 h-40 object-cover border-4 border-gray-300 hover:grayscale transition duration-300 ease-in-out">
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*">
                        </label>
                        <button type="submit" class="mt-4 px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">
                            Update Profile Picture
                        </button>
                    </div>
                </form>
            </div>

            <!-- Script to Preview Image -->
            <script>
                document.getElementById('profile_picture').onchange = function (event) {
                    const [file] = event.target.files;
                    if (file) {
                        document.getElementById('profileImage').src = URL.createObjectURL(file);
                    }
                };
            </script>

            <!-- Update Username -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Change Username</h3>
                <form method="POST" action="{{ route('host.profile.update-username') }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <input id="username" name="username" type="text" value="{{ auth()->user()->username }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">Update Username</button>
                    </div>
                </form>
            </div>

            <!-- Update Website URL -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Website</h3>
                <form method="POST" action="{{ route('host.profile.update') }}">
                    @csrf
                    <div class="mt-4">
                        <input type="url" name="website_url" id="website_url" value="{{ old('website_url', auth()->user()->website_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">Update Website</button>
                    </div>
                </form>
            </div>

            <!-- Update Social Media Links -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Social Media Links</h3>
                <form method="POST" action="{{ route('host.profile.update') }}">
                    @csrf
                    <div class="mt-4">
                        <label for="instagram_url" class="block text-sm font-medium text-gray-700">Instagram</label>
                        <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', auth()->user()->instagram_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <label for="facebook_url" class="block text-sm font-medium text-gray-700">Facebook</label>
                        <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', auth()->user()->facebook_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">Update Social Media Links</button>
                    </div>
                </form>
            </div>

            <!-- Update Bio -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Bio</h3>
                <form method="POST" action="{{ route('host.profile.update') }}">
                    @csrf
                    <div class="mt-4">
                        <textarea name="bio" id="bio" maxlength="250" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('bio', auth()->user()->bio) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">Update Bio</button>
                    </div>
                </form>
            </div>

            <!-- Update Password -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Change Password</h3>
                <form method="POST" action="{{ route('host.profile.update-password') }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input id="current_password" name="current_password" type="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input id="new_password" name="new_password" type="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
