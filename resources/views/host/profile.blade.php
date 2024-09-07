<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Host Profile') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100" style="font-family: 'Poppins', sans-serif;">

<div class="min-h-screen flex flex-col">
    <!-- Navigation Bar -->
    <header class="bg-white shadow flex items-center justify-between px-4 py-4 md:px-6">
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 md:h-10">
            </a>
            <h1 class="ml-4 text-lg md:text-xl font-semibold text-gray-900">Profile</h1>
        </div>
        <div class="flex items-center">
            <a href="{{ route('host.profile') }}" class="flex items-center">
                <span class="text-gray-600 mr-4 text-sm md:text-base">{{ Auth::guard('host')->user()->username }}</span>
                <img src="{{ asset('storage/' . Auth::guard('host')->user()->profile_picture) }}" alt="Profile Picture" class="h-8 w-8 md:h-10 md:w-10 rounded-full">
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex flex-1 flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-white shadow-md p-4">
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('host.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md text-sm md:text-base">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('host.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md text-sm md:text-base">Profile</a>
                    </li>
                    <li class="relative mb-2 group">
                        <button class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md relative text-sm md:text-base">
                            Create Item
                        </button>
                        <ul class="absolute left-0 w-full bg-white shadow-lg rounded-md hidden group-hover:block z-10">
                            <li><a href="{{ route('host.items.create', ['type' => 'attraction']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md text-sm md:text-base">Attraction</a></li>
                            <li><a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md text-sm md:text-base">Event</a></li>
                            <li><a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md text-sm md:text-base">Guide</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('host.logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md text-sm md:text-base"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('host.logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 p-4 md:p-6 bg-gray-50">
            <div class="container mx-auto">
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900">Manage Your Profile</h2>
                    <p class="mt-4 text-sm md:text-base text-gray-700">Update your account settings here.</p>

                    <!-- Update Profile Picture -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800">Profile Picture</h3>
                        <form method="POST" action="{{ route('host.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col items-start">
                                <!-- Profile Picture Display and Upload -->
                                <label for="profile_picture" class="relative cursor-pointer">
                                    <img id="profileImage"
                                         src="{{ asset('storage/' . Auth::guard('host')->user()->profile_picture) }}"
                                         alt="Profile Picture"
                                         class="rounded-full w-32 h-32 md:w-40 md:h-40 object-cover border-4 border-gray-300 hover:grayscale transition duration-300 ease-in-out">
                                    <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*">
                                </label>
                                <button type="submit" class="mt-4 px-4 py-2 font-semibold text-white rounded-md text-sm md:text-base" style="background-color: #FE793D;">
                                    Update Profile Picture
                                </button>
                            </div>
                        </form>
                    </div>

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
                                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md text-sm md:text-base" style="background-color: #FE793D;">Update Username</button>
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
                                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md text-sm md:text-base" style="background-color: #FE793D;">Update Website</button>
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
                                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md text-sm md:text-base" style="background-color: #FE793D;">Update Social Media Links</button>
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
                                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md text-sm md:text-base" style="background-color: #FE793D;">Update Bio</button>
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
                                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md text-sm md:text-base" style="background-color: #FE793D;">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
