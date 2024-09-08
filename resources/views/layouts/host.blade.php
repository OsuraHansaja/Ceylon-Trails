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
    <!-- Top Navigation Bar -->
    <header class="bg-white shadow flex items-center justify-between px-6 py-4">
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </a>
            <h1 class="ml-4 text-xl font-semibold text-gray-900">Dashboard</h1>
        </div>
        <div class="flex items-center">
            <button id="sidebar-toggle" class="md:hidden text-gray-500 focus:outline-none mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <span class="text-gray-600 mr-4">{{ Auth::guard('host')->user()->username }}</span>
            <img src="{{ asset('storage/' . Auth::guard('host')->user()->profile_picture) }}" alt="Profile Picture" class="h-10 w-10 rounded-full">
        </div>
    </header>

    <!-- Main Layout Wrapper -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white shadow-md p-4 w-full md:w-64 flex-shrink-0 hidden md:block">
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('host.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('host.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Profile</a>
                    </li>
                    <li class="relative mb-2 group">
                        <button class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md relative">
                            Create Item
                        </button>
                        <ul class="absolute left-0 w-full bg-white shadow-lg rounded-md hidden group-hover:block z-10">
                            <li><a href="{{ route('host.items.create', ['type' => 'attraction']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Attraction</a></li>
                            <li><a href="{{ route('host.events.create', ['type' => 'attraction']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Event</a></li>
                            <li><a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Guide</a></li>
                        </ul>
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

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-50">
            @yield('content')
        </main>
    </div>
</div>

@livewireScripts

<!-- Script for toggling the sidebar on mobile -->
<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('block');  // Sidebar appears as a block element
    });
</script>
</body>
</html>
