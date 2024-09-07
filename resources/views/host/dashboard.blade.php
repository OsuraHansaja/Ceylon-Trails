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
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </a>
            <h1 class="ml-4 text-xl font-semibold text-gray-900">Profile</h1>
        </div>
        <div class="flex items-center">
            <a href="{{ route('host.profile') }}" class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::guard('host')->user()->username }}</span>
                <img src="{{ asset('storage/' . Auth::guard('host')->user()->profile_picture) }}" alt="Profile Picture" class="h-10 w-10 rounded-full">
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
                    <li class="relative mb-2 group">
                        <button class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md relative">
                            Create Item
                        </button>
                        <ul class="absolute left-0 w-full bg-white shadow-lg rounded-md hidden group-hover:block z-10">
                            <li><a href="{{ route('host.items.create', ['type' => 'attraction']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Attraction</a></li>
                            <li><a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">Event</a></li>
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

        <!-- Content Area -->
        <main class="flex-1 p-6 bg-gray-50">
            <div class="container mx-auto">
                <!-- Dynamic Content Area -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Attractions</h2>

                    @if ($items->isEmpty())
                        <p class="text-gray-600">You haven't created any attractions yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($items as $item)
                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    @if ($item->thumbnail_image)
                                        <img src="{{ asset($item->thumbnail_image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover mb-4 rounded">
                                    @endif
                                    <h3 class="text-xl font-bold mb-2">{{ $item->title }}</h3>
                                    <p class="text-gray-700 mb-2">{{ $item->small_description }}</p>
                                    <p class="text-sm text-gray-500 mb-2">Location: {{ $item->location }}</p>
                                    <p class="text-sm text-gray-500 mb-2">Link: <a href="{{ $item->link }}" class="text-blue-500" target="_blank">{{ $item->link }}</a></p>
                                    <p class="text-sm text-gray-500 mb-2">Category: {{ $item->categories->pluck('name')->join(', ') }}</p>
                                    <p class="text-sm text-gray-500 mb-2">Created: {{ $item->created_at->format('d M Y') }}</p>
                                    <!-- Existing code -->
                                    <div class="flex space-x-4 mt-4">
                                        <a href="{{ route('host.items.edit', $item->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-md">Edit</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('host.items.destroy', $item->id) }}" method="POST" onsubmit="return confirmDeletion()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border border-gray-400 text-gray-700 px-4 py-2 rounded-md hover:bg-red-500 hover:text-white">
                                                Delete
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>

@livewireScripts
<script>
    function confirmDeletion() {
        return confirm('Are you sure you want to delete this item?');
    }

</script>
</body>
</html>
