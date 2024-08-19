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
    <header class="bg-white shadow flex items-center justify-between px-6 py-4">
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </a>
            <h1 class="ml-4 text-xl font-semibold text-gray-900">Profile</h1>
        </div>
        <div class="flex items-center">
            <a href="{{ route('host.profile') }}" class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::guard('host')->user()->username }}</span>
                <img src="{{ asset('images/profile-placeholder.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-4">
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('host.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('host.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('host.logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md"
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
        <main class="flex-1 p-6 bg-gray-50">
            <div class="container mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900">Manage Your Profile</h2>
                    <p class="mt-4 text-gray-700">Update your account settings here.</p>

                    <!-- Update Username -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800">Change Username</h3>
                        <form method="POST" action="{{ route('host.profile.update-username') }}">
                            @csrf
                            @method('PUT')
                            <div class="mt-4">
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input id="username" name="username" type="text" value="{{ Auth::guard('host')->user()->username }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-md" style="background-color: #FE793D;">Update Username</button>
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

                    <!-- Other Profile Options (e.g., 2FA, etc.) -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800">Other Profile Settings</h3>
                        <p class="mt-2 text-gray-600"></p> <!-- Additional options like two-factor authentication can be added here.-->
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
