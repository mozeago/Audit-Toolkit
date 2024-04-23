<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <nav class="sticky top-0 z-50 bg-white shadow-lg">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/favicon.png.PNG') }}" alt="Logo" class="h-8">
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-4 md:flex">
                    {{-- <a href="#" class="text-gray-800 hover:text-gray-900">Home</a>
                    <a href="#" class="text-gray-800 hover:text-gray-900">About</a>
                    <a href="#" class="text-gray-800 hover:text-gray-900">Services</a> --}}
                    <a href="{{ route('register') }}"
                        class="text-gray-800 hover:text-gray-900 hover:hover:text-[#C8000B]">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0">
        {{ $slot }}
    </div>
    <footer class="py-8 text-white bg-black">
        <div class="container grid items-center grid-cols-2 gap-4 mx-auto">
            <!-- First Column: Company Logo -->
            <div class="text-center">
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <!-- Second Column: About Text -->
            <div>
                <p class="font-bold">About Toolkit</p>
                <p>The Data Protection Toolkit 2024 offers a cutting-edge solution for organizations aiming to enhance
                    their data security practices. At its core, this toolkit includes an advanced online self-assessment
                    tool. Through this tool, organizations can seamlessly evaluate their adherence to data protection
                    laws, receiving detailed compliance reports and insightful scorecards.</p>
            </div>
        </div>
    </footer>

</body>

</html>
