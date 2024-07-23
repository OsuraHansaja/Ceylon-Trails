<x-guest-layout>
    <div class="absolute top-0 right-0 mt-4 mr-4">
        <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Sign Up</a>
    </div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-[32px] shadow-md">
            <div class="flex justify-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-20">
                </a>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900">Sign In</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <input id="email" name="email" type="email" placeholder="Enter your email" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div class="relative">
                        <input id="password" name="password" type="password" placeholder="Enter your password" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center px-2 focus:outline-none">
                            <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M15 12h.01M12 12h.01M9 12h.01M20.354 14.354a9 9 0 0 0 0-12.708M9.342 20.343a9 9 0 0 1 12.708 0M3.172 3.172a4 4 0 0 1 5.656 0M4.222 4.222a9 9 0 0 1 0 12.708M14.657 20.343a9 9 0 0 1 0-12.708" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <button type="submit" class="w-full px-3 py-2 font-semibold text-white rounded-[32px]" style="background-color: #FE793D;">Sign In</button>
                    </div>
                </div>
            </form>
            <div class="flex justify-between mt-4">
                <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">Forgot your password?</a>
            </div>
        </div>
    </div>
</x-guest-layout>
