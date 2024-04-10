<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="font-sans antialiased">
    <livewire:layout.navigation />
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-auto h-screen py-20 mb-20 overflow-y-auto transition-transform -translate-x-full bg-white border-r sm:translate-x-0"
        aria-label="Sidebar">
        <div x-data="{ open: false, isOpen: false }">
            <ul>
                <li class="py-5 border-b border-gray-400">
                    <x-nav-link class="w-full ml-4 mr-4 text-black" :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 hover:hover:text-[#C8000B]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                        <span
                            class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>
                @if (auth()->user()->role === 'admin')
                    <li class="py-5 border-b border-gray-400">
                        <button @click="open = !open"
                            class="ml-4 mr-4 flex w-full px-1 py-2 text-gray-500  hover:hover:text-[#C8000B] focus:outline-none focus:bg-gray-600">

                            <svg class="w-6 h-6 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="[#C8000B]" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.5 11.5 11 13l4-3.5M12 20a16.405 16.405 0 0 1-5.092-5.804A16.694 16.694 0 0 1 5 6.666L12 4l7 2.667a16.695 16.695 0 0 1-1.908 7.529A16.406 16.406 0 0 1 12 20Z" />
                            </svg>
                            <span class="ml-2 text-xl text-black roboto-medium hover:hover:text-[#C8000B]">Audit
                                TooKit</span>
                            <svg :class="{ 'rotate-180': open }" class="w-5 h-5" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                            class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:hover:text-[#C8000B]">
                            <ul>
                                <li class=" w-ful">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                                        {{ __('Sections') }}
                                    </x-nav-link>
                                </li>
                                <li class="">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('controls')" :active="request()->routeIs('controls')" wire:navigate>
                                        {{ __('Controls') }}
                                    </x-nav-link>
                                </li>
                                <li class="">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('questions')" :active="request()->routeIs('questions')" wire:navigate>
                                        {{ __('Questions') }}
                                    </x-nav-link>
                                </li>
                                <li class="">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                                        {{ __('Questions Info.') }}
                                    </x-nav-link>
                                </li>
                                <li class="">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('recommendations')" :active="request()->routeIs('recommendations')" wire:navigate>
                                        {{ __('Recommendations') }}
                                    </x-nav-link>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link class="ml-4 mr-4 block w-full py-2 text-black  hover:hover:text-[#C8000B]"
                            :href="route('templates-upload')" :active="request()->routeIs('templates-upload')" wire:navigate>
                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span
                                class="text-xl roboto-medium hover:hover:text-[#C8000B]">{{ __('Templates Upload') }}</span>
                        </x-nav-link>
                    </li>
                @endif
                <li class="py-5 border-b border-gray-400">
                    <x-nav-link class="block w-full py-2 text-gray-300 ml-4 mr-4   hover:hover:text-[#C8000B]"
                        :href="route('templates-download')" :active="request()->routeIs('templates-download')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span
                            class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Templates Download') }}</span>
                    </x-nav-link>
                </li>
                <li class="py-5 border-b border-gray-400">
                    <x-nav-link class=" ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                        :href="route('questionnaire')" :active="request()->routeIs('questionnaire')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <span
                            class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Audit Questionnaire') }}</span>
                    </x-nav-link>
                </li>
                @if (auth()->user()->role === 'admin')
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link class=" ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                            :href="route('risk-profile-dashboard')" :active="request()->routeIs('risk-profile-dashboard')" wire:navigate>
                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                            </svg>

                            <span
                                class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Risk Profile Dashboard') }}</span>
                        </x-nav-link>
                    </li>

                    <li class="py-5 border-b border-gray-400">
                        <button @click="isOpen = !isOpen"
                            class=" ml-4 mr-4 flex w-full px-1 py-2 text-gray-500  hover:hover:text-[#C8000B] focus:outline-none focus:bg-gray-600">
                            <svg class="w-6 h-6 text-xl text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
                            </svg>
                            <span
                                class="ml-2 text-xl text-black roboto-medium  hover:hover:text-[#C8000B]">{{ __('Risk Analysis') }}</span>
                            <svg :class="{ 'rotate-180': open }" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="isOpen"
                            class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:hover:text-[#C8000B]">
                            <ul>
                                <li class="w-full">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-section')" :active="request()->routeIs('risk-analysis-section')" wire:navigate>
                                        {{ __('Risk Section') }}
                                    </x-nav-link>
                                </li>
                                <li class="w-full">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-subsection')" :active="request()->routeIs('risk-analysis-subsection')" wire:navigate>
                                        {{ __('Risk Analysis Questions') }}
                                    </x-nav-link>
                                </li>
                                <li class="w-full">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-information')" :active="request()->routeIs('risk-analysis-information')" wire:navigate>
                                        {{ __('Risk Information') }}
                                    </x-nav-link>
                                </li>
                                <li class="w-full">
                                    <x-nav-link class="block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-recommendation')" :active="request()->routeIs('risk-analysis-recommendation')" wire:navigate>
                                        {{ __('Risk Recommendation') }}
                                    </x-nav-link>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="py-5 border-b border-gray-400">
                    <x-nav-link class=" ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                        :href="route('risk-analysis-questionnaire')" :active="request()->routeIs('risk-analysis-questionnaire')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z" />
                        </svg>


                        <span
                            class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Risk Questionnaire') }}</span>
                    </x-nav-link>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
