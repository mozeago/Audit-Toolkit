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
                @if (Route::currentRouteName() !== 'register')
                    <a href="{{ route('register') }}"
                        class="text-gray-800 hover:text-gray-900 hover:hover:text-[#C8000B]">Register</a>
                @endif
                @if (Route::currentRouteName() !== 'login')
                    <a href="{{ route('login') }}"
                        class="text-gray-800 hover:text-gray-900 hover:hover:text-[#C8000B]">Sign in</a>
                @endif
            </div>
        </div>
    </div>
</nav>
