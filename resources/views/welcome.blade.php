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
            background-color: #F7F6F2;
            color: #000000;
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
    <div class="bg-center bg-cover h-28" style="background-image: url('images/impact-background.jpg');">
        <h1 class="p-8 text-4xl font-bold text-left text-white">Our Impact</h1>
    </div>
    <div class="p-8 text-black">
        <p>The IGNITE Youth Training Program is a dynamic initiative designed to train and empower 1million young
            professionals in Africa. The program operates a quarterly cohort system, where each cohort comprises Youth
            who are recruited, trained, graduated, and linked to the industry. This approach ensures a steady and timely
            flow of skilled Cybersecurity and data protection professionals into the job market.</p>
    </div>
    <div class="flex flex-col items-center justify-center">
        <h1 class="mb-8 text-xl font-semibold">iGnite Partners Worlwide</h1>
        <div class="flex justify-between w-full max-w-screen-lg gap-2">
            <div class="w-1/5">
                <a href="https://engage.isaca.org/kenyachapter/home">
                    <img src="{{ asset('images/isacakenya.jpeg') }}" alt="Image 1" class="w-full h-24">
                </a>
            </div>
            <div class="w-1/5">
                <a href="https://engage.isaca.org/southafricachapter/home">
                    <img src="{{ asset('images/ISACA_South_Africa.jpeg') }}" alt="Image 1" class="w-full h-24">
                </a>
            </div>
            <div class="w-1/5">
                <a href="https://engage.isaca.org/kampalachapter/home">
                    <img src="{{ asset('images/kampala.jpg') }}" alt="Image 1" class="w-full h-24">
                </a>
            </div>
            <div class="w-1/5">
                <a href="https://twitter.com/DataGovProsKe?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
                    <img src="{{ asset('images/kenya data privacy.jpeg') }}" alt="Image 1" class="w-full h-24">
                </a>
            </div>
            <div class="w-1/5">
                <a href="https://engage.isaca.org/rwandachapter/home">
                    <img src="{{ asset('images/rwanda.jpg') }}" alt="Image 1" class="w-full h-24">
                </a>
            </div>
            <div class="w-1/5 text-center">
                <a href="https://www.scratchandscript.com/">
                    <img src="{{ asset('images/scratchandscript_logo_red.png') }}" alt="Image 1" class="w-full">
                </a>
            </div>
            <div class="w-1/5 text-center">
                <button class="flex items-center text-white bg-[#C8000B] rounded hover:shadow-2xl hover:bg-green-800">
                    <svg class="w-16 h-6" fill="none" stroke="currentColor" viewBox="0 0 52 52"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M64,12.78v17s-3.63.71-4.38.81-3.08.85-4.78-.78C52.22,27.25,42.93,18,42.93,18a3.54,3.54,0,0,0-4.18-.21c-2.36,1.24-5.87,3.07-7.33,3.78a3.37,3.37,0,0,1-5.06-2.64,3.44,3.44,0,0,1,2.1-3c3.33-2,10.36-6,13.29-7.52,1.78-1,3.06-1,5.51,1C50.27,12,53,14.27,53,14.27a2.75,2.75,0,0,0,2.26.43C58.63,14,64,12.78,64,12.78ZM27,41.5a3,3,0,0,0-3.55-4.09,3.07,3.07,0,0,0-.64-3,3.13,3.13,0,0,0-3-.75,3.07,3.07,0,0,0-.65-3,3.38,3.38,0,0,0-4.72.13c-1.38,1.32-2.27,3.72-1,5.14s2.64.55,3.72.3c-.3,1.07-1.2,2.07-.09,3.47s2.64.55,3.72.3c-.3,1.07-1.16,2.16-.1,3.46s2.84.61,4,.25c-.45,1.15-1.41,2.39-.18,3.79s4.08.75,5.47-.58a3.32,3.32,0,0,0,.3-4.68A3.18,3.18,0,0,0,27,41.5Zm25.35-8.82L41.62,22a3.53,3.53,0,0,0-3.77-.68c-1.5.66-3.43,1.56-4.89,2.24a8.15,8.15,0,0,1-3.29,1.1,5.59,5.59,0,0,1-3-10.34C29,12.73,34.09,10,34.09,10a6.46,6.46,0,0,0-5-2C25.67,8,18.51,12.7,18.51,12.7a5.61,5.61,0,0,1-4.93.13L8,10.89v19.4s1.59.46,3,1a6.33,6.33,0,0,1,1.56-2.47,6.17,6.17,0,0,1,8.48-.06,5.4,5.4,0,0,1,1.34,2.37,5.49,5.49,0,0,1,2.29,1.4A5.4,5.4,0,0,1,26,34.94a5.47,5.47,0,0,1,3.71,4,5.38,5.38,0,0,1,2.39,1.43,5.65,5.65,0,0,1,1.48,4.89,0,0,0,0,1,0,0s.8.9,1.29,1.39a2.46,2.46,0,0,0,3.48-3.48s2,2.48,4.28,1c2-1.4,1.69-3.06.74-4a3.19,3.19,0,0,0,4.77.13,2.45,2.45,0,0,0,.13-3.3s1.33,1.81,4,.12c1.89-1.6,1-3.43,0-4.39Z">
                        </path>
                    </svg>
                    Become a Partner
                </button>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center mt-8">
        <h1 class="items-start mb-2 text-2xl font-semibold">Our SDG Focus</h1>
        <div class="flex justify-between w-full max-w-screen-lg gap-4">
            <div class="w-32 h-32">
                <a href="https://en.wikipedia.org/wiki/Sustainable_Development_Goal_4" class="w-1/5">
                    <img src="{{ asset('images/SDG_Goal_04QualityEducation.svg.png') }}" alt="Image 1"
                        class="w-full h-auto">
                </a>
            </div>
            <div class="1/3">
                <div class="w-32 h-32">
                    <a href="https://en.wikipedia.org/wiki/Sustainable_Development_Goal_5" class="w-1/5">
                        <img src="{{ asset('images/SDG_Goal_05GenderEquality.svg.png') }}" alt="Image 1"
                            class="w-full h-auto">
                    </a>
                </div>
            </div>
            <div class="w-32 h-32">
                <a href="https://en.wikipedia.org/wiki/Sustainable_Development_Goal_8" class="w-1/5">
                    <img src="{{ asset('images/SDG_Goal_08DecentWork.svg.png') }}" alt="Image 1" class="w-full h-auto">
                </a>
            </div>
        </div>
        <div class="flex p-8">
            <div class="flex-col flex-grow w-1/2">
                <h2 class="text-xl font-bold">We want to Partner With You</h2>
                <p class="mt-2">To drive forward our mission within the IGNITE program, we are actively seeking
                    partnerships with knowledge institutions, private enterprises, and professional organizations.
                    As we aim to expand our training initiatives in the MEA (Middle East, and Africa) region, we
                    recognize the invaluable role that collaborative efforts play in achieving our objectives.
                <ul class="pl-8 list-disc">
                    <li>Knowledge partners: Institutions, universities, and research centers willing to share
                        expertise and resources.</li>
                    <li>Knowledge partners: Institutions, universities, and research centers willing to share
                        expertise and resources.</li>
                    <li>Professional bodies: Organizations dedicated to advancing professional standards and
                        practices in relevant fields.</li>
                </ul>
                By uniting with us, you'll play a pivotal role in empowering individuals and communities across the
                MEA region through education and skill development.
                If you're interested in becoming a partner and shaping the future of training in the MEA region,
                please reach out to us on info[at]scratchandscript.com

                </p>
                <div class="mt-4">
                    <button
                        class="flex items-center px-4 py-2 text-white bg-[#C8000B] rounded hover:shadow-2xl hover:bg-green-800">
                        <svg class="w-16 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 52 52"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M64,12.78v17s-3.63.71-4.38.81-3.08.85-4.78-.78C52.22,27.25,42.93,18,42.93,18a3.54,3.54,0,0,0-4.18-.21c-2.36,1.24-5.87,3.07-7.33,3.78a3.37,3.37,0,0,1-5.06-2.64,3.44,3.44,0,0,1,2.1-3c3.33-2,10.36-6,13.29-7.52,1.78-1,3.06-1,5.51,1C50.27,12,53,14.27,53,14.27a2.75,2.75,0,0,0,2.26.43C58.63,14,64,12.78,64,12.78ZM27,41.5a3,3,0,0,0-3.55-4.09,3.07,3.07,0,0,0-.64-3,3.13,3.13,0,0,0-3-.75,3.07,3.07,0,0,0-.65-3,3.38,3.38,0,0,0-4.72.13c-1.38,1.32-2.27,3.72-1,5.14s2.64.55,3.72.3c-.3,1.07-1.2,2.07-.09,3.47s2.64.55,3.72.3c-.3,1.07-1.16,2.16-.1,3.46s2.84.61,4,.25c-.45,1.15-1.41,2.39-.18,3.79s4.08.75,5.47-.58a3.32,3.32,0,0,0,.3-4.68A3.18,3.18,0,0,0,27,41.5Zm25.35-8.82L41.62,22a3.53,3.53,0,0,0-3.77-.68c-1.5.66-3.43,1.56-4.89,2.24a8.15,8.15,0,0,1-3.29,1.1,5.59,5.59,0,0,1-3-10.34C29,12.73,34.09,10,34.09,10a6.46,6.46,0,0,0-5-2C25.67,8,18.51,12.7,18.51,12.7a5.61,5.61,0,0,1-4.93.13L8,10.89v19.4s1.59.46,3,1a6.33,6.33,0,0,1,1.56-2.47,6.17,6.17,0,0,1,8.48-.06,5.4,5.4,0,0,1,1.34,2.37,5.49,5.49,0,0,1,2.29,1.4A5.4,5.4,0,0,1,26,34.94a5.47,5.47,0,0,1,3.71,4,5.38,5.38,0,0,1,2.39,1.43,5.65,5.65,0,0,1,1.48,4.89,0,0,0,0,1,0,0s.8.9,1.29,1.39a2.46,2.46,0,0,0,3.48-3.48s2,2.48,4.28,1c2-1.4,1.69-3.06.74-4a3.19,3.19,0,0,0,4.77.13,2.45,2.45,0,0,0,.13-3.3s1.33,1.81,4,.12c1.89-1.6,1-3.43,0-4.39Z">
                            </path>
                        </svg>
                        Become a Partner
                    </button>
                </div>
            </div>
            <div class="flex-col flex-grow w-1/2">
                <img src="{{ asset('images/background.svg') }}" alt="Image" class="object-cover w-full h-full">
            </div>
        </div>
    </div>


    <livewire:common.footer />
</body>

</html>
