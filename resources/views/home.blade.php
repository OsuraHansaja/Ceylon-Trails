@extends('layouts.ct')

@section('content')
    <!-- Hero Section -->
    <section class="banner relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/homepagehero.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col justify-center items-center h-full text-white">
            <h1 class="text-5xl font-bold text-center">
                WELCOME TO <br> SRI LANKA
            </h1>
        </div>
    </section>

    <!-- Things You Can Do Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-6">Things You Can Do</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">Attraction Title</h3>
                    <p class="text-gray-600">Attractions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What's Going On Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-6">What's Going On</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">Event Title</h3>
                    <p class="text-gray-600">Events.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
