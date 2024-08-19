<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Host Dashboard') }}</title>

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
            <a href="">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </a>
            <h1 class="ml-4 text-xl font-semibold text-gray-900">Dashboard</h1>
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
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Create Item</a>
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
                <!-- Dynamic Content will be placed here -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900">Welcome to Your Dashboard</h2>
                    <p class="mt-4 text-gray-700">This is where you can manage your pages, events, and more.</p>
                </div>
            </div>
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
