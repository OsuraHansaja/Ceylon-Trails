<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-[32px] shadow-md">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-20">
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900">Sign Up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="space-y-4">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <input id="first_name" name="first_name" type="text" placeholder="First Name" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                        </div>
                        <div class="flex-1">
                            <input id="last_name" name="last_name" type="text" placeholder="Last Name" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                        </div>
                    </div>
                    <div>
                        <input id="email" name="email" type="email" placeholder="Email Address" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <input id="username" name="username" type="text" placeholder="Username" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <input id="password" name="password" type="password" placeholder="Password" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <input id="dob" name="dob" type="date" placeholder="Date of Birth" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    <div>
                        <select id="gender" name="gender" required class="w-full px-3 py-2 border border-gray-300 rounded-[32px] focus:outline-none focus:ring-2 focus:ring-orange-400">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Custom">Custom</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full px-3 py-2 font-semibold text-white rounded-[32px]" style="background-color: #FE793D;">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
