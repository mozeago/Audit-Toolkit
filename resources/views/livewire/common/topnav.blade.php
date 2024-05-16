<nav class="sticky top-0 z-50 bg-white shadow-lg">
    <div class="px-4 py-3 mx-auto max-w-7xl">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" wire:navigate>
                    <image src="{{ asset('images/scratchandscript_logo_red.webp') }}" class="h-8" alt="logo" />
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-4 md:flex">
                {{-- <a href="#" class="text-gray-800 hover:text-gray-900">Home</a>
                <a href="#" class="text-gray-800 hover:text-gray-900">About</a>
                <a href="#" class="text-gray-800 hover:text-gray-900">Services</a> --}}
                @guest
                    <button type="button"
                        class="hover:text-[#C8000B] px-4 py-1 border-2 rounded-md border-gray-500 text-black font-bold hover:border-[#C8000B]">
                        <a href="{{ route('register') }}"
                            class="text-gray-800 no-underline hover:text-[#C8000B]">Register</a>
                    </button>
                @endguest
                @guest
                    <button type="button"
                        class="px-4 py-1 border-2 bg-[#C8000B] rounded-md border-[#C8000B] hover:bg-green-700 hover:border-green-700">
                        <a href="{{ route('login') }}" class="font-semibold text-white ">Sign in</a>
                    </button>
                @endguest
                @auth
                    <button type="button"
                        class="text-center hover:text-[#C8000B] px-3 py-1 border-2 rounded-md border-gray-300 text-black font-bold hover:border-[#C8000B]">
                        <a href="{{ route('dashboard') }}" class="text-gray-800 no-underline">Dashboard</a>
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>
