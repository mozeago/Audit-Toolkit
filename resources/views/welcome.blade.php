<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="{{ asset('images/background.svg') }}" />
        <nav class="absolute top-0 right-0 mt-2 mr-16">
            @if (Route::has('login'))
                @guest <!-- Checking if the user is a guest (not logged in) -->
                    <button
                        class="mr-2 hover:hover:bg-white hover:text-black px-8 py-2 font-bold text-white bg-[#C8000B] rounded"
                        onclick="window.location.href='{{ route('login') }}'">
                        Login
                    </button>
                @endguest
            @endif
            <!-- Add other navigation items here if needed -->
        </nav>


        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-20"> <!-- Adjust the margin top to create space for the navigation -->
                    <!-- Main content goes here -->
                    <h2>Introduction</h2>
                    <p>The Data Protection Toolkit 2024 offers a cutting-edge solution for organizations aiming to
                        enhance their data security practices. At its core, this toolkit includes an advanced online
                        self-assessment tool. Through this tool, organizations can seamlessly evaluate their adherence
                        to data protection laws, receiving detailed compliance reports and insightful scorecards. With
                        the Data Protection Toolkit, organizations gain access to comprehensive insights into Africa's
                        data protection laws. The toolkit provides clarity on complex legal requirements, helping
                        organizations navigate the intricacies of compliance effectively.
                        Moreover, the toolkit facilitates collaboration with partners, leveraging their support to
                        promote a culture of data protection awareness and compliance. With the support of our partners
                        and the dedication of learners, we are committed to fostering a culture of data protection
                        awareness and compliance.
                        Scratch and Script Limited is proud to collaborate with partners and young professionals across
                        Africa, including:
                    </p>
                </main>
            </div>
        </div>
    </div>
    <footer class="py-16 text-sm text-center text-black">
        scartch & script
    </footer>
</body>

</html>
