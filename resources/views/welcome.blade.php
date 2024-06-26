<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <title>Data Protection Toolkit</title>
    <link rel="preload" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    </noscript><!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @keyframes slideIn {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out;
        }

        .time-unit {
            display: inline-block;
            background-color: black;
            text-align: center;
            padding: 4px;
            color: white;
            min-width: 60px;
            border-radius: 8px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);

        }

        .number {
            font-size: 2rem;
            display: block;
            font-weight: bold;
        }

        .label {
            font-size: 0.75rem;
            margin-left: 0px;
            color: #555;
        }
    </style>


</head>

<body class="antialiased">
    <livewire:common.topnav />
    <div class="bg-center bg-cover sm:max-h-16 md:max-h-32"
        style="background-image: url({{ asset('images/people-impact.webp') }}););">
        <h1 class="p-8 text-4xl font-bold text-left text-white roboto-bold">
            Our Impact</h1>
    </div>
    <div class="px-6 mb-2 text-black bg-gray-100 py-9">
        <p class="text-black roboto-regular">The IGNITE
            Youth Training Program is a dynamic initiative
            designed to
            train
            and
            empower
            1million young
            professionals in Africa. The program operates a
            quarterly cohort system, where each cohort
            comprises Youth
            who are recruited, trained, graduated, and
            linked to the industry. This approach ensures a
            steady and timely
            flow of skilled Cybersecurity and data
            protection professionals into the job market.
        </p>
    </div>
    {{-- start partners --}}

    <div class="flex flex-col items-center justify-center w-full pt-4 pb-8 bg-white border-b-2 border-gray-100 sm:pt-2">
        <h1 class="mb-4 text-2xl font-bold text-center">
            IGNITE
            <span class="inline-block border-b-2 border-[#C8000B] pb-4">Partners</span>
            Worldwide
        </h1>
        <div class="container mx-auto">
            <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-1/2 md:w-1/8">
                    <div><a class="zoom-image" href="https://isacaabuja.org/">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/isaca_abuja.webp"
                                alt="isaca Abuja chapter" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a></div>
                </div>
                <div class="w-1/2 p-2 md:w-1/8">
                    <div>
                        <a class="zoom-image" href="https://engage.isaca.org/kenyachapter/home">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/isacakenya.webp"
                                alt="isaca Kenya chapter" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 p-2 md:w-1/8">
                    <div>
                        <a class="zoom-image" href="https://engage.isaca.org/southafricachapter/home">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/ISACA_South_Africa.webp"
                                alt="isaca South Africa chapter" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 p-2 md:w-1/8">
                    <div>
                        <a class="zoom-image" href="https://engage.isaca.org/kampalachapter/home">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/kampala.webp"
                                alt="Image 1" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 p-2 md:w-1/8">
                    <div>
                        <a class="zoom-image"
                            href="https://twitter.com/DataGovProsKe?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/kenya data privacy.webp"
                                alt="kenya data privacy" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 p-2 md:w-1/8">
                    <div>
                        <a class="zoom-image" href="https://engage.isaca.org/rwandachapter/home">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/rwanda.webp"
                                alt="Image 1" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a>
                    </div>
                </div>
                <div class="w-full p-2 md:w-1/8">
                    <div>
                        <a class="zoom-image" href="https://www.scratchandscript.com/">
                            <img src="https://data-protection-toolkit.scratchandscript.com/images/scratchandscript_logo_red.webp"
                                alt="Image 1" class="w-auto h-8 sm:w-full sm:mx-2 sm:h-12">
                        </a>
                    </div>
                </div>
                <div class="w-full p-2 md:w-1/8">
                    <div>
                        <a href="https://www.scratchandscript.com/user_contact"
                            class="rounded bg-[#C8000B] text-white font-bold py-4 px-4  hover:bg-black hover:shadow-2xl flex items-center">
                            <svg class="w-10 h-4 sm:h-6 sm:w-16" fill="none" stroke="currentColor"
                                viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M64,12.78v17s-3.63.71-4.38.81-3.08.85-4.78-.78C52.22,27.25,42.93,18,42.93,18a3.54,3.54,0,0,0-4.18-.21c-2.36,1.24-5.87,3.07-7.33,3.78a3.37,3.37,0,0,1-5.06-2.64,3.44,3.44,0,0,1,2.1-3c3.33-2,10.36-6,13.29-7.52,1.78-1,3.06-1,5.51,1C50.27,12,53,14.27,53,14.27a2.75,2.75,0,0,0,2.26.43C58.63,14,64,12.78,64,12.78ZM27,41.5a3,3,0,0,0-3.55-4.09,3.07,3.07,0,0,0-.64-3,3.13,3.13,0,0,0-3-.75,3.07,3.07,0,0,0-.65-3,3.38,3.38,0,0,0-4.72.13c-1.38,1.32-2.27,3.72-1,5.14s2.64.55,3.72.3c-.3,1.07-1.2,2.07-.09,3.47s2.64.55,3.72.3c-.3,1.07-1.16,2.16-.1,3.46s2.84.61,4,.25c-.45,1.15-1.41,2.39-.18,3.79s4.08.75,5.47-.58a3.32,3.32,0,0,0,.3-4.68A3.18,3.18,0,0,0,27,41.5Zm25.35-8.82L41.62,22a3.53,3.53,0,0,0-3.77-.68c-1.5.66-3.43,1.56-4.89,2.24a8.15,8.15,0,0,1-3.29,1.1,5.59,5.59,0,0,1-3-10.34C29,12.73,34.09,10,34.09,10a6.46,6.46,0,0,0-5-2C25.67,8,18.51,12.7,18.51,12.7a5.61,5.61,0,0,1-4.93.13L8,10.89v19.4s1.59.46,3,1a6.33,6.33,0,0,1,1.56-2.47,6.17,6.17,0,0,1,8.48-.06,5.4,5.4,0,0,1,1.34,2.37,5.49,5.49,0,0,1,2.29,1.4A5.4,5.4,0,0,1,26,34.94a5.47,5.47,0,0,1,3.71,4,5.38,5.38,0,0,1,2.39,1.43,5.65,5.65,0,0,1,1.48,4.89,0,0,0,0,1,0,0s.8.9,1.29,1.39a2.46,2.46,0,0,0,3.48-3.48s2,2.48,4.28,1c2-1.4,1.69-3.06.74-4a3.19,3.19,0,0,0,4.77.13,2.45,2.45,0,0,0,.13-3.3s1.33,1.81,4,.12c1.89-1.6,1-3.43,0-4.39Z">
                                </path>
                            </svg>
                            <span class="text-nowrap">Become a Partner</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end partners --}}
    {{-- START COHORT JOIN US --}}
    <div class="flex flex-col border-b-2 border-gray-100 md:px-32 sm:px-2">
        <div class="container grid items-center justify-center grid-cols-12 pt-2 mx-auto b sm:w-full">
            <div class="hidden col-span-1 sm:block sm:col-span-4 md:block lg:block"></div>
            <span class="col-span-1"></span>
            <div class="col-span-12 text-3xl font-bold text-center sm:col-span-12">
                <span class="text-nowrap">Cohorts</span>
            </div>
            <span class="col-span-1"></span>
            <div class="hidden col-span-1 sm:block sm:col-span-4 md:block lg:block"></div>
        </div>
        <div
            class="container grid items-center justify-start grid-cols-12 mx-auto mb-2 md:text-center sm:text-start sm:p-0 sm:items-start sm:w-full">
            <p class="col-span-12 text-2xl text-pretty">We hope you apply and join us on this journey today!</p>
        </div>
        <div class="container py-8 mx-auto">
            <div class="grid grid-cols-1 gap-2 pb-2 md:grid-cols-12">
                <div class="col-span-1 md:col-span-4 sm:mb-8 md:mb-0">
                    <div class="flex flex-col w-full h-full bg-gray-200 rounded-sm">
                        <div class="flex flex-col justify-between flex-grow bg-white rounded-lg shadow-lg">
                            <!-- Title Row -->
                            <div class="px-6 py-4 text-xl font-bold text-center text-white bg-black rounded-t-lg">
                                Cohort 1
                            </div>
                            <div class="flex-grow px-6 py-4">
                                <h4 class="block text-2xl font-bold text-pretty">Application Deadline:</h4>
                                <h4 class="text-[#C8000B] block font-bold text-2xl capitalize">Closed!</h4>
                            </div>
                            <div class="flex items-center justify-center mb-4">
                                <a href="https://bit.ly/IGNITECOHORT-1">
                                    <button disabled
                                        class="flex items-center justify-center w-full px-2 py-1 text-white bg-gray-400 rounded-lg min-h-8 sm:min-h-12 sm:px-4 sm:py-2">
                                        <span class="font-bold uppercase roboto-regular">Apply</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 md:col-span-4 sm:mb-8 md:mb-0">
                    <div class="flex flex-col w-full h-full bg-gray-200 rounded-sm">
                        <div class="flex flex-col justify-between flex-grow bg-white rounded-lg shadow-lg">
                            <!-- Title Row -->
                            <div class="px-6 py-4 text-xl font-bold text-center text-white bg-black rounded-t-lg">
                                Cohort 2
                            </div>
                            <div class="flex-grow px-6 py-4">
                                <h4 class="block text-2xl font-bold text-pretty">Application Deadline:</h4>
                                <h4 class="text-[#C8000B] block font-bold text-lg">Saturday, July 20, 2024 at 11:59 p.m
                                    EAT.</h4>
                                <!-- Countdown Timer -->
                                <div id="countdown" class="mt-4 text-lg font-bold text-center text-red-600 countdown">
                                </div>
                            </div>
                            <div class="flex items-center justify-center mb-4">
                                <a href="https://bit.ly/IGNITECOHORT-2">
                                    <button
                                        class="w-full px-2 py-1 text-white bg-[#C8000B] hover:bg-black rounded-lg min-h-8 sm:min-h-12 sm:px-4 sm:py-2 flex items-center justify-center">
                                        <span class="font-bold uppercase roboto-regular">Apply</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 md:col-span-4 sm:mb-8 md:mb-0">
                    <div class="flex flex-col w-full h-full bg-gray-200 rounded-sm">
                        <div class="flex flex-col justify-between flex-grow bg-white rounded-lg shadow-lg">
                            <!-- Title Row -->
                            <div class="px-6 py-4 text-xl font-bold text-center text-white bg-black rounded-t-lg">
                                Cohort 3
                            </div>
                            <div class="flex-grow px-6 py-4">
                                <h4 class="block text-2xl font-bold text-pretty">Application Deadline:</h4>
                                <h4 class="text-[#C8000B] block font-bold text-2xl capitalize">Coming Soon!</h4>
                            </div>
                            <div class="flex items-center justify-center mb-4">
                                <a href="https://bit.ly/IGNITECOHORT-1">
                                    <button disabled
                                        class="flex items-center justify-center w-full px-2 py-1 text-white bg-gray-400 rounded-lg min-h-8 sm:min-h-12 sm:px-4 sm:py-2">
                                        <span class="font-bold uppercase roboto-regular">Apply</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END CHOHORT JOIN US --}}
    {{-- start report --}}
    <div class="flex flex-col mb-8 border-b-2 border-gray-100 shadow-sm md:px-32">
        <div class="container items-center justify-center grid-cols-12 p-4 mx-auto mb-2 md:grid sm:w-full">
            <div class="col-span-1 sm:col-span-4 md:block lg:block"></div>
            <span class="col-span-1 border-2 border-black sm:hidden md:block">
            </span>
            <div class="col-span-6 text-2xl font-bold text-center sm:col-span-2">
                <span class="text-nowrap">Skills Report</span>
            </div>
            <span class="col-span-1 border-2 border-black sm:hidden md:block">
            </span>
            <div class="col-span-1 sm:col-span-4 md:block lg:block"></div>
        </div>

        <div class="flex sm:flex-wrap md:flex-nowrap md-flex-row">
            <div class="w-full p-4 m-2 md:w-1/2 lg:w-1/2">
                <img src="{{ asset('images/Annual-report-ignite.webp') }}" alt="Skills Report"
                    class="w-full fade-left-5 rounded-bl-xl rounded-tl-xl max-h-72">

            </div>
            <div class="w-full p-4 m-2 md:w-1/2 lg:w-1/2">
                <h2 class="mb-2 text-xl font-bold leading-snug roboto-bold">
                    <span class="inline-block text-2xl pb-1 text-[#C8000B]">2024
                        SUB-SAHARA
                    </span>
                    <span class="inline-block pb-1 text-2xl">CYBERSECURITY
                        AND DATA PROTECTION
                        SKILLS REPORT
                </h2>
                <p class="mb-2 roboto-bold-18">
                    In the IGNITE 2024 Sub-Sahara Learning &
                    Skills Trends Report, we delve into
                    these three key areas
                    for
                    leaders to focus on so that they can
                    embrace them as part of their current
                    and future workplace
                    strategy.
                </p>
                <div class="mt-1">
                    <a href="{{ asset('report/IGNITE-Cohort-II-Program.pdf') }}" download>
                        <button
                            class="min-h-8 sm:min-h-12 flex items-center justify-center bg-black px-2 py-1 text-white hover:bg-[#C8000B] hover:shadow-2xl sm:px-4 sm:py-2">
                            <span class="ml-1 font-bold uppercase roboto-regular sm:ml-2">read
                                report</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                            </svg>

                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- end report --}}
    {{-- Start SDG focus --}}
    <div class="flex flex-col justify-center py-2 mt-2 mb-16 border-b-2 border-gray-100 sm:px-4 md:px-32">
        <h1 class="mb-8 text-xl font-bold roboto-bold text-start">
            Our <span class="inline-block border-b-2 border-[#C8000B] pb-1 text-[#C8000B]">SDG</span>
            Focus
        </h1>
        <div class="grid grid-cols-12 gap-2 pb-2">
            <div class="col-span-4">
                <div class="flex justify-center">
                    <div class="flex items-center justify-center">
                        <a href="https://tinyurl.com/39975atx" class="flex items-center justify-center">
                            <img src="{{ asset('images/Sustainable_Development_Goal_04QualityEducation.webp') }}"
                                alt="Sustainable_Development_Goal_4_Quality_Education"
                                class="rounded-md shadow-2xl md:h-64 sm:h-32 md:w-96">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-span-4">
                <div class="flex justify-center">
                    <div class="flex items-center justify-center">
                        <a href="https://tinyurl.com/33x8dmst">
                            <img src="{{ asset('images/Sustainable_Development_Goal_05GenderEquality.webp') }}"
                                alt="Sustainable_Development_Goal_5_Gender_Equality"
                                class="rounded-md shadow-2xl md:h-64 sm:h-32 md:w-96">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-span-4">
                <div class="flex justify-center">
                    <div class="flex items-center justify-center">
                        <a href="https://tinyurl.com/ycy9s5kn">
                            <img src="{{ asset('images/Sustainable_Development_Goal_08DecentWork.webp') }}"
                                alt="Sustainable_Development_Goal_8_DecentWork"
                                class="rounded-md shadow-2xl md:h-64 sm:h-32 md:w-96">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- end SDG focus --}}
    {{-- start partnership --}}
    <div class="px-10">
        <div class="flex items-start w-full pl-8">
            <h2 class="text-xl font-bold roboto-bold text-nowrap">
                <span class="inline-block uppercase text-[#C8000B]">We
                    want to Partner
                </span>
            </h2>
        </div>
        <div class="flex items-start w-full px-32 pl-8 mt-4 mb-2">
            <h2 class="text-xl font-bold uppercase roboto-bold">
                <span class="inline-block pb-2 border-b-2 border-black">With</span>
                You
            </h2>
        </div>
    </div>
    <div class="flex sm:flex-wrap md:flex-row md:flex-nowrap bg-[#FCF6F6] p-8">
        <div class="w-full p-4 m-2 md:w-1/2 lg:w-1/2">
            <p class="mt-2 roboto-regular">To drive forward
                our mission within the IGNITE program, we
                are actively
                seeking
                partnerships with knowledge institutions,
                private enterprises, and professional
                organizations.
                As we aim to expand our training initiatives
                in the MEA (Middle East, and Africa) region,
                we
                recognize the invaluable role that
                collaborative efforts play in achieving our
                objectives.

            </p>
            <ol class="my-4 space-y-2 list-none">
                <li class="flex items-start roboto-regular">
                    <span
                        class="mr-4 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-[#C8000B] text-white">1</span>
                    Knowledge partners:Institutions,
                    universities, and research centers
                    willing to share
                    expertise and resources.
                </li>
                <li class="flex items-start roboto-regular">
                    <span
                        class="mr-4 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-[#C8000B] text-white">2</span>
                    Private companies: Businesses eager to
                    contribute their capabilities and
                    resources to support our
                    training programs.
                </li>
                <li class="flex items-start roboto-regular">
                    <span
                        class="mr-4 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-[#C8000B] text-white">3</span>
                    Professional bodies: Organizations
                    dedicated to advancing professional
                    standards and
                    practices in relevant fields.
                </li>
            </ol>
            <p class="roboto-regular">
                By uniting with us, you'll play a pivotal
                role in empowering individuals and
                communities across the
                MEA region through education and skill
                development.
                If you're interested in becoming a partner
                and shaping the future of training in the
                MEA region,
                please reach out to us on
            <blockquote>info[at]scratchandscript.com
            </blockquote>

            </p>
            <div class="mt-4">
                <a href="https://www.scratchandscript.com/user_contact">
                    <button
                        class="min-h-8 sm:min-h-12 flex items-center text-nowrap justify-center rounded bg-[#C8000B] px-2 py-1 text-white hover:bg-black hover:shadow-2xl sm:px-4 sm:py-2">
                        <svg class="w-10 h-4 sm:h-6 sm:w-16" fill="none" stroke="currentColor"
                            viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M64,12.78v17s-3.63.71-4.38.81-3.08.85-4.78-.78C52.22,27.25,42.93,18,42.93,18a3.54,3.54,0,0,0-4.18-.21c-2.36,1.24-5.87,3.07-7.33,3.78a3.37,3.37,0,0,1-5.06-2.64,3.44,3.44,0,0,1,2.1-3c3.33-2,10.36-6,13.29-7.52,1.78-1,3.06-1,5.51,1C50.27,12,53,14.27,53,14.27a2.75,2.75,0,0,0,2.26.43C58.63,14,64,12.78,64,12.78ZM27,41.5a3,3,0,0,0-3.55-4.09,3.07,3.07,0,0,0-.64-3,3.13,3.13,0,0,0-3-.75,3.07,3.07,0,0,0-.65-3,3.38,3.38,0,0,0-4.72.13c-1.38,1.32-2.27,3.72-1,5.14s2.64.55,3.72.3c-.3,1.07-1.2,2.07-.09,3.47s2.64.55,3.72.3c-.3,1.07-1.16,2.16-.1,3.46s2.84.61,4,.25c-.45,1.15-1.41,2.39-.18,3.79s4.08.75,5.47-.58a3.32,3.32,0,0,0,.3-4.68A3.18,3.18,0,0,0,27,41.5Zm25.35-8.82L41.62,22a3.53,3.53,0,0,0-3.77-.68c-1.5.66-3.43,1.56-4.89,2.24a8.15,8.15,0,0,1-3.29,1.1,5.59,5.59,0,0,1-3-10.34C29,12.73,34.09,10,34.09,10a6.46,6.46,0,0,0-5-2C25.67,8,18.51,12.7,18.51,12.7a5.61,5.61,0,0,1-4.93.13L8,10.89v19.4s1.59.46,3,1a6.33,6.33,0,0,1,1.56-2.47,6.17,6.17,0,0,1,8.48-.06,5.4,5.4,0,0,1,1.34,2.37,5.49,5.49,0,0,1,2.29,1.4A5.4,5.4,0,0,1,26,34.94a5.47,5.47,0,0,1,3.71,4,5.38,5.38,0,0,1,2.39,1.43,5.65,5.65,0,0,1,1.48,4.89,0,0,0,0,1,0,0s.8.9,1.29,1.39a2.46,2.46,0,0,0,3.48-3.48s2,2.48,4.28,1c2-1.4,1.69-3.06.74-4a3.19,3.19,0,0,0,4.77.13,2.45,2.45,0,0,0,.13-3.3s1.33,1.81,4,.12c1.89-1.6,1-3.43,0-4.39Z">
                            </path>
                        </svg>
                        <span class="ml-1 font-bold roboto-bold-16 sm:ml-2 text-nowrap">Become
                            a Partner</span>
                    </button>
                </a>
            </div>
        </div>
        <div class="w-full p-4 m-2 md:w-1/2 lg:w-1/2">
            <img src="{{ asset('images/we_want_to_partner_with_you.webp') }}" alt="partner with us image"
                class="fade-left">
        </div>
    </div>
    {{-- end partnership --}}
    <livewire:common.footer />
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("July 20, 2024 23:59:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="countdown"
            document.getElementById("countdown").innerHTML =
                `
                <div class="time-unit"><span class="number">${days}</span><span class="label">Days</span></div>
                <div class="time-unit"><span class="number">${hours}</span><span class="label">Hours</span></div>
                <div class="time-unit"><span class="number">${minutes}</span><span class="label">Minutes</span></div>
                <div class="time-unit seconds"><span class="number animate-slideIn">${seconds}</span><span class="label">Seconds</span></div>`;

            // Add animation class to seconds
            document.querySelector('#countdown .seconds .number').classList.add('animate-slideIn');

            // Remove animation class after animation ends
            setTimeout(() => {
                document.querySelector('#countdown .seconds .number').classList.remove('animate-slideIn');
            }, 500);

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

</html>
