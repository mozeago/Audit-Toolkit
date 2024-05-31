<nav class="sticky top-0 z-50 bg-white shadow-lg">
    <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-7xl">
        <!-- Logo -->
        <div class="flex-shrink-0 w-1/3 mr-2 sm:w-auto">
            <a href="/" wire:navigate>
                <img src="{{ asset('images/scratchandscript_logo_red.webp') }}" class="h-8"
                    alt="scratch and script logo" />
            </a>
        </div>
        <!-- Navigation Links -->
        <div class="flex items-center justify-end w-2/3 space-x-2 sm:ml-auto sm:w-auto">
            @guest
                <button type="button"
                    class="md:min-w-28 flex-grow rounded-md border-2 border-gray-500 px-4 py-1 font-bold text-black hover:border-[#C8000B] hover:text-[#C8000B] sm:flex-grow-0 sm:px-1 sm:font-normal">
                    <a href="{{ route('register') }}" class="text-gray-800 no-underline hover:text-[#C8000B]">Register</a>
                </button>
            @endguest
            @guest
                <button type="button"
                    class="md:min-w-28 lg:min-w-28 xl:min-w-28 2xl:min-w-28 flex-grow rounded-md border-2 border-[#C8000B] bg-[#C8000B] px-4 py-1 font-bold font-bold text-white hover:border-[#F6FCFC] hover:bg-black hover:text-white sm:flex-grow-0 sm:px-1 sm:font-normal">
                    <a href="{{ route('login') }}" class="text-white no-underline">Sign
                        in</a>
                </button>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="inline-flex items-center">
                    <span class="mr-2 text-xl material-icons-sharp">
                        dashboard
                    </span>
                    <h3 class="m-0">Dashboard</h3>
                </a>
            @endauth
        </div>
    </div>
</nav>
