<nav class="sticky top-0 z-50 bg-white shadow-lg">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" wire:navigate>
                    <image src="{{ asset('images/logo-red.PNG') }}" class="h-8" alt="logo" />
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-4 md:flex">
                {{-- <a href="#" class="text-gray-800 hover:text-gray-900">Home</a>
                <a href="#" class="text-gray-800 hover:text-gray-900">About</a>
                <a href="#" class="text-gray-800 hover:text-gray-900">Services</a> --}}
                @guest
                    <button type="button"
                        class="px-4 py-2 border-2 rounded-md border-gray-500 text-gray-900 hover:text-[#C8000B] hover:border-[#C8000B]">
                        <a href="{{ route('register') }}" class="text-gray-800 no-underline">Register</a>
                    </button>
                @endguest
                @guest
                    <button type="button"
                        class="px-4 py-2 border-2 bg-[#C8000B] rounded-md border-[#C8000B] text-gray-900 hover:text-[#C8000B] hover:border-[#C8000B]">
                        <a href="{{ route('login') }}" class="text-white hover:text-black">Sign in</a>
                    </button>
                @endguest
            </div>
        </div>
    </div>
</nav>
