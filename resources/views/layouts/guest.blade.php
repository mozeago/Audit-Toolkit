<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="The Data Protection Toolkit 2024 offers a cutting-edge solution for organizations aiming to enhance their data security practices. At its core,this toolkit includes an advanced online self-assessment tool. Through this tool, organizations can seamlessly evaluate their adherence to data protection laws, receiving detailed compliance reports and insightful scorecards." />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.webp') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>

<body class="font-sans antialiased text-gray-900">
    <livewire:common.topnav />

    <div class="flex flex-col items-center p-8">
        {{ $slot }}
    </div>
    <livewire:common.footer />
    @vite(['resources/js/dashboard.js', 'resources/js/app.js'])
</body>

</html>
