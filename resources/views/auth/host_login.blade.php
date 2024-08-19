<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-[32px] shadow-md">
            <div class="flex justify-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-20">
                </a>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900">Sign In</h2>
            <form method="POST" action="{{ route('host.login') }}">
                @csrf

                <div class="space-y-4">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <input id="email" name="email" type="email" placeholder="Email Address" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <input id="password" name="password" type="password" placeholder="Password" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <button type="submit" class="w-full px-4 py-2 font-semibold text-white rounded-[32px]" style="background-color: #FE793D;">Sign In</button>
                    </div>
                </div>
            </form>

            <div class="mt-4 text-center">
                <a href="" class="text-sm text-gray-600 hover:text-gray-900">Forgot your password?</a>
            </div>
            <div class="mt-2 text-center">
                <a href="{{ route('host.register') }}" class="text-sm text-gray-600 hover:text-gray-900">Don't have an account? Sign Up</a>
            </div>
        </div>
    </div>

    <div class="absolute top-0 right-0 mt-4 mr-4">
        <a href="{{ route('host.register') }}" class="text-sm text-gray-600 hover:text-gray-900">Sign Up</a>
    </div>
</x-guest-layout>
