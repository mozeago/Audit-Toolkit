<nav class="sticky top-0 z-50 bg-white shadow-lg">
    <div class="flex items-center justify-between px-4 py-3 mx-auto max-w-7xl">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="/" wire:navigate>
                <img src="{{ asset('images/scratchandscript_logo_red.webp') }}" class="h-8"
                    alt="scratch and script logo" />
            </a>
        </div>
        <!-- Navigation Links -->
        <div class="flex items-center space-x-2">
            @guest
                <button type="button"
                    class="hover:text-[#C8000B] sm:px-1 px-4 py-1 border-2 rounded-md border-gray-500 text-black font-bold sm:font-normal hover:border-[#C8000B]">
                    <a href="{{ route('register') }}" class="text-gray-800 no-underline hover:text-[#C8000B]">Register</a>
                </button>
            @endguest
            @guest
                <button type="button"
                    class="hover:text-white hover:bg-green-700 hover:border-green-700 sm:px-1 px-4 py-1 border-2 rounded-md border-[#C8000B] bg-[#C8000B] text-white font-bold sm:font-normal">
                    <a href="{{ route('login') }}" class="text-white no-underline">Sign in</a>
                </button>
            @endguest
            @auth
                <button type="button"
                    class="hover:text-[#C8000B] px-4 py-1 border-2 rounded-md border-gray-300 text-black font-bold hover:border-[#C8000B]">
                    <a href="{{ route('dashboard') }}" class="text-gray-800 no-underline">Dashboard</a>
                </button>
            @endauth
        </div>
    </div>

</nav>
