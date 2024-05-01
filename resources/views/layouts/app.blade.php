<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Toolkit') }}</title>

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js"></script>
    <script src="https://unpkg.com/chartjs-gauge@0.3.0/dist/chartjs-gauge.js"></script>
</head>

<body class="font-sans antialiased bg-[#F5F5F5]">
    <livewire:layout.navigation />
    <?php
    use App\Models\User;
    ?>
    @if (User::find(auth()->id())->qa_analysis_complete === 'true' || auth()->user()->role === 'admin')
        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-auto h-screen py-20 mb-20 overflow-y-auto transition-transform -translate-x-full bg-white border-r sm:translate-x-0"
            aria-label="Sidebar">
            <div x-data="{ open: false, isOpen: false, infOpen: false, isOnboarding: false }">
                <ul>
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link class="no-border-bottom hover:text-[#C8000B] w-full ml-4 mr-4 " :href="route('dashboard')"
                            :active="request()->routeIs('dashboard')" wire:navigate>
                            <svg class="w-6 h-6 mr-2 hover:text-[#C8000B] text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>
                            <span
                                class="text-xl roboto-medium text-black hover:text-[#C8000B]">{{ __('Dashboard') }}</span>
                        </x-nav-link>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li class="py-5 border-b border-gray-400">
                            <button @click="open = !open"
                                class="ml-4 mr-4 flex justify-between items-center w-full pl-1 pr-8 py-2 hover:text-[#C8000B] focus:outline-none">

                                <div class="flex items-center flex-grow"> <!-- Added flex-grow to make it expand -->
                                    <svg class="w-6 h-6 hover:text-[#C8000B]" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path stroke-width="2" fill-rule="evenodd" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                    </svg>
                                    <span class="ml-2 text-xl text-black roboto-medium hover:text-[#C8000B]">Audit
                                        Toolkit</span>
                                </div>

                                <svg :class="{ 'rotate-180': open }" class="w-6 h-6 ml-4 hover:text-[#C8000B]"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                    <path stroke-width="2" fill-rule="evenodd" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>


                            <div x-show="open"
                                class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:hover:text-[#C8000B]">
                                <ul>
                                    <li class="">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                            :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Sections') }}<span>
                                        </x-nav-link>
                                    </li>
                                    <li class="">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                            :href="route('controls')" :active="request()->routeIs('controls')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Controls') }}</span>
                                        </x-nav-link>
                                    </li>
                                    <li class="">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                            :href="route('questions')" :active="request()->routeIs('questions')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Questions') }}</span>
                                        </x-nav-link>
                                    </li>
                                    <li class="">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                            :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Questions Info.') }}</span>
                                        </x-nav-link>
                                    </li>
                                    <li class="">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                                            :href="route('recommendations')" :active="request()->routeIs('recommendations')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Recommendations') }}</span>
                                        </x-nav-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="py-5 border-b border-gray-400">
                            <x-nav-link
                                class="no-border-bottom ml-4 mr-4 block w-full py-2 text-black  hover:hover:text-[#C8000B]"
                                :href="route('templates-upload')" :active="request()->routeIs('templates-upload')" wire:navigate>
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span
                                    class="text-xl roboto-medium text-black hover:hover:text-[#C8000B]">{{ __('Templates Upload') }}</span>
                            </x-nav-link>
                        </li>
                    @endif
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link
                            class="no-border-bottom block w-full py-2 text-gray-300 ml-4 mr-4   hover:hover:text-[#C8000B]"
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
                        <x-nav-link
                            class="no-border-bottom  ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
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
                            <x-nav-link
                                class="no-border-bottom  ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
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
                                class="ml-4 mr-4 flex justify-between items-center w-full pl-1 pr-8 py-2 hover:text-[#C8000B] focus:outline-none">

                                <div class="flex items-center flex-grow"> <!-- Added flex-grow to make it expand -->
                                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z" />
                                    </svg>
                                    <span
                                        class="ml-2 text-xl text-black roboto-medium hover:text-[#C8000B]">{{ __('Security Analysis') }}</span>
                                </div>

                                <svg :class="{ 'rotate-180': isOpen }" class="w-6 h-6 hover:text-[#C8000B]"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                    <path stroke-width="2" fill-rule="evenodd" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-show="isOpen"
                                class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:hover:text-[#C8000B]">
                                <ul>
                                    <li class="w-full">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                            :href="route('risk-analysis-section')" :active="request()->routeIs('risk-analysis-section')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Risk Section') }}</span>
                                        </x-nav-link>
                                    </li>
                                    <li class="w-full">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                            :href="route('risk-analysis-subsection')" :active="request()->routeIs('risk-analysis-subsection')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Onboarding Risk Questions') }}</span>
                                        </x-nav-link>
                                    </li>
                                    <li class="w-full">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                            :href="route('risk-analysis-information')" :active="request()->routeIs('risk-analysis-information')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Risk Information') }}</span>
                                        </x-nav-link>
                                    </li>
                                    <li class="w-full">
                                        <x-nav-link
                                            class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                            :href="route('risk-analysis-recommendation')" :active="request()->routeIs('risk-analysis-recommendation')" wire:navigate>
                                            <span
                                                class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Risk Recommendation') }}</span>
                                        </x-nav-link>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    @endif
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link
                            class="no-border-bottom  ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                            :href="route('risk-analysis-questionnaire')" :active="request()->routeIs('risk-analysis-questionnaire')" wire:navigate>
                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z" />
                            </svg>
                            <span
                                class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Security Questionnaire') }}</span>
                        </x-nav-link>
                    </li>
                    <li class="py-5 border-b border-gray-400">
                        <button @click="isOnboarding = !isOnboarding"
                            class="ml-4 mr-4 flex justify-between items-center w-full pl-1 pr-8 py-2 hover:text-[#C8000B] focus:outline-none">

                            <div class="flex items-center flex-grow"> <!-- Added flex-grow to make it expand -->
                                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                                </svg>
                                <span
                                    class="ml-2 text-xl text-black roboto-medium hover:text-[#C8000B]">{{ __('Onboarding Qs') }}</span>
                            </div>

                            <svg :class="{ 'rotate-180': isOpen }" class="w-6 h-6 hover:text-[#C8000B]"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                <path stroke-width="2" fill-rule="evenodd" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="isOnboarding"
                            class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:hover:text-[#C8000B]">
                            <ul>
                                <li class="w-full">
                                    <x-nav-link
                                        class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-section')" :active="request()->routeIs('risk-analysis-section')" wire:navigate>
                                        <span
                                            class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Question Section') }}</span>
                                    </x-nav-link>
                                </li>
                                <li class="w-full">
                                    <x-nav-link
                                        class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-subsection')" :active="request()->routeIs('risk-analysis-subsection')" wire:navigate>
                                        <span
                                            class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Question Sub-Section') }}</span>
                                    </x-nav-link>
                                </li>
                                <li class="w-full">
                                    <x-nav-link
                                        class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-recommendation')" :active="request()->routeIs('risk-analysis-recommendation')" wire:navigate>
                                        <span
                                            class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Question Text') }}</span>
                                    </x-nav-link>
                                </li>
                                <li class="w-full">
                                    <x-nav-link
                                        class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-information')" :active="request()->routeIs('risk-analysis-information')" wire:navigate>
                                        <span
                                            class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Question More Information') }}</span>
                                    </x-nav-link>
                                </li>

                                <li class="w-full">
                                    <x-nav-link
                                        class="no-border-bottom block w-full py-2 text-black hover:hover:text-[#C8000B]"
                                        :href="route('risk-analysis-recommendation')" :active="request()->routeIs('risk-analysis-recommendation')" wire:navigate>
                                        <span
                                            class="text-xl roboto-medium hover:hover:text-[#C8000B] ml-8">{{ __('Question Recommendation') }}</span>
                                    </x-nav-link>
                                </li>
                            </ul>

                        </div>
                    </li>
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link
                            class="no-border-bottom  ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                            :href="route('risk-analysis-questionnaire')" :active="request()->routeIs('risk-analysis-questionnaire')" wire:navigate>
                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                            <span
                                class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Contributors') }}</span>
                        </x-nav-link>
                    </li>
                    <li class="py-5 border-b border-gray-400">
                        <x-nav-link
                            class="no-border-bottom  ml-4 mr-4 block w-full py-2 text-gray-300  hover:hover:text-[#C8000B]"
                            :href="route('user-settings')" :active="request()->routeIs('user-settings')" wire:navigate>
                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:hover:text-[#C8000B]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <span
                                class="text-xl text-black roboto-medium hover:hover:text-[#C8000B]">{{ __('Users') }}</span>
                        </x-nav-link>
                    </li>
                </ul>
            </div>
        </aside>
    @endif

    <div class="p-4 @if (User::find(auth()->id())->qa_analysis_complete === 'true' || auth()->user()->role === 'admin') sm:ml-72 @endif">
        <div
            style="background-image: url({{ asset('images/bg-questionnaire.jpeg') }});
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;"class="rounded-lg">
            <div class="rounded-lg shadow-2xl dark:border-gray-700 mt-14">
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    {{-- footer --}}
    {{-- end footer --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
