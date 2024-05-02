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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #333;
        }

        .hero {
            background-color: #C8000B;
            color: #fff;
        }

        .feature {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <livewire:common.topnav />

    <section class="px-8 py-20 hero">
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
            <a href="{{ route('questionnaire') }}" class="mt-8 btn">Get Started</a>
        </div>
    </section>

    <section class="px-8 py-16 features">
        <div class="container mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Our Partners</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">
                <div class="p-4 feature">
                    <img src="{{ asset('images/isacakenya.jpeg') }}" alt="ISACA Kenya"
                        class="w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA Kenya</h3>
                    <p class="text-sm">A leading professional association for IT governance, risk management, and
                        cybersecurity professionals in Kenya.</p>
                </div>
                <div class="p-4 feature">
                    <img src="{{ asset('images/kampala.jpg') }}" alt="ISACA Kenya" class="w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA Kampala</h3>
                    <p class="text-sm">Dedicated to promoting IT governance, risk management, and cybersecurity
                        practices in Uganda.</p>
                </div>
                <div class="p-4 feature">
                    <img src="{{ asset('images/rwanda.jpg') }}" alt="ISACA Kenya" class="w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA Rwanda</h3>
                    <p class="text-sm">Committed to advancing IT governance and cybersecurity knowledge in Rwanda.</p>
                </div>
                <div class="p-4 feature">
                    <img src="{{ asset('images/ISACA_South_Africa.jpeg') }}" alt="ISACA Kenya"
                        class="w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">ISACA South Africa</h3>
                    <p class="text-sm">A key organization driving IT governance and cybersecurity awareness in South
                        Africa.</p>
                </div>
                <div class="p-4 feature">
                    <img src="{{ asset('images/kenya data privacy.jpeg') }}" alt="ISACA Kenya"
                        class="w-full h-24 mb-2 rounded-lg">
                    <h3 class="mb-2 text-lg font-bold">Data Privacy and Governance Society of Kenya</h3>
                    <p class="text-sm">An association advocating for data privacy rights and promoting best
                        practices in
                        data governance in Kenya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-8 py-16 bg-white researchers">
        <div class="container mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">Researchers</h2>
            <p class="px-4 mb-8 text-lg leading-relaxed text-gray-800">
                In addition to our partners, we're supported by young professionals across Africa. They're researching
                and analyzing data protection laws, providing valuable insights. They're also actively learning about
                data protection, improving their understanding of regulations and best practices. Their dedication is
                vital in our mission to make data protection accessible to all and create a safer online world.
            </p>
            <p class="px-4 mb-8 text-lg leading-relaxed text-gray-800">
                <strong>Program Researchers</strong>
            </p>
            <ol class="px-4 mb-8 text-lg leading-relaxed text-gray-800 list-decimal list-inside">
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
            <p class="px-4 text-lg leading-relaxed text-gray-800">
                Together, let's work towards a safer online environment where data privacy
                rights are respected and upheld. Thank you for joining us on this journey.
            </p>
        </div>
    </section>

    <livewire:common.footer />
</body>

</html>
