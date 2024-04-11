<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Protection Toolkit</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <header class="py-4 text-white bg-black">
        <div class="container flex items-center justify-between px-4 mx-auto">
            <div class="logo">
                <img src="{{ asset('images/Scartch and Script Logo white.svg') }}" alt="Company Logo">
            </div>
            <nav>
                <ul class="flex space-x-8">
                    <li><a href="{{ route('login') }}" class="px-4 py-2">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="py-20 px-8 text-white bg-[#C8000B] hero">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold">Data Protection Toolkit 2024</h1>
            <p class="mt-4 text-lg">The Data Protection Toolkit 2024 offers a cutting-edge solution for organizations
                aiming to enhance their data security practices. At its core, this toolkit includes an advanced online
                self-assessment tool. Through this tool, organizations can seamlessly evaluate their adherence to data
                protection laws, receiving detailed compliance reports and insightful scorecards. With the Data
                Protection Toolkit, organizations gain access to comprehensive insights into Africa's data protection
                laws. The toolkit provides clarity on complex legal requirements, helping organizations navigate the
                intricacies of compliance effectively.</p>
            <p class="mt-4 text-lg"> Moreover, the toolkit facilitates collaboration with partners, leveraging their
                support to promote a
                culture of data protection awareness and compliance. With the support of our partners and the dedication
                of learners, we are committed to fostering a culture of data protection awareness and compliance.
                Scratch and Script Limited is proud to collaborate with partners and young professionals across Africa,
                including:
            </p>
            <a href="{{ route('questionnaire') }}"
                class="inline-block px-6 py-2 mt-8 text-white bg-black rounded btn hover:text-gray-300">Get
                Started</a>
        </div>
    </section>

    <section class="px-8 py-16 features">
        <div class="container mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Our Partners</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">
                <div class="p-4 bg-white rounded-lg shadow-md feature">
                    <img src="{{ asset('images/isacakenya.jpeg') }}" alt="Image"
                        class="object-cover w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA Kenya</h3>
                    <p class="text-sm">A leading professional association for IT governance, risk management, and
                        cybersecurity professionals in Kenya.</p>
                </div>
                <!-- Repeat similar structure for other cards -->
                <div class="p-4 bg-white rounded-lg shadow-md feature">
                    <img src="{{ asset('images/kampala.jpeg') }}" alt="Image"
                        class="object-cover w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA Kampala Chapter</h3>
                    <p class="text-sm">Dedicated to promoting IT governance, risk management, and cybersecurity
                        practices in Uganda.</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow-md feature">
                    <img src="{{ asset('images/rwanda.jpeg') }}" alt="Image"
                        class="object-cover w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">3. ISACA Rwanda Chapter</h3>
                    <p class="text-sm">Committed to advancing IT governance and cybersecurity knowledge in Rwanda.</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow-md feature">
                    <img src="{{ asset('images/sa.jpeg') }}" alt="Image"
                        class="object-cover w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA South Africa Chapter</h3>
                    <p class="text-sm">A key organization driving IT governance and cybersecurity awareness in South
                        Africa.</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow-md feature">
                    <img src="{{ asset('images/kenya.jpeg') }}" alt="Image"
                        class="object-cover w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">Data Privacy and Governance Society of Kenya</h3>
                    <p class="text-sm">An association advocating for data privacy rights and promoting best practices in
                        data governance in Kenya.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="px-8 py-16 bg-white">
        <div class="container mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Researchers</h2>
            <p class="px-4 mb-8 text-lg leading-relaxed text-gray-800 md:px-0">
                In addition to our partners, we're supported by young professionals across Africa. They're researching
                and analyzing data protection laws, providing valuable insights. They're also actively learning about
                data protection, improving their understanding of regulations and best practices. Their dedication is
                vital in our mission to make data protection accessible to all and create a safer online world.
            </p>
            <p class="px-4 mb-8 text-lg leading-relaxed text-gray-800 md:px-0">
                <strong>Program Researchers</strong>
            </p>
            <ol class="px-4 mb-8 text-lg leading-relaxed text-gray-800 list-decimal list-inside md:px-0">
                <!-- Dummy list of 20 members -->
                <li class="mb-4">
                    <span class="font-semibold text-purple-600">Beatrice Mwangi</span>
                    {{-- <span class="text-gray-600"> - Data Privacy Analyst</span> --}}
                </li>
                <li class="mb-4">
                    <span class="font-semibold text-purple-600">Yianto Letoya</span>
                    {{-- <span class="text-gray-600"> - Cybersecurity Researcher</span> --}}
                </li>
                <!-- Repeat similar structure for other list items -->
                <!-- Add more researchers if needed -->
            </ol>
            <p class="px-4 text-lg leading-relaxed text-gray-800 md:px-0">
                Together, let's work towards a safer online environment where data privacy
                rights are respected and upheld. Thank you for joining us on this journey.
            </p>
        </div>
    </section>


    <footer class="py-8 text-center text-white bg-black">
        <p>&copy; 2024 Scratch & Script Limited</p>
        <ul class="mt-4 social-links">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
    </footer>
</body>

</html>
