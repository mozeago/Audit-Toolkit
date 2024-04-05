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
</head>

<body class="font-sans antialiased">
    <livewire:layout.navigation />
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        {{-- <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-nav-link :href="route('dashboard')" wire:navigate
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="ms-3">Dashboard</span>
                    </x-nav-link>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-300"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">Audit ToolKit</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                                {{ __('Sections') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('controls')" :active="request()->routeIs('controls')" wire:navigate>
                                {{ __('Controls') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('questions')" :active="request()->routeIs('questions')" wire:navigate>
                                {{ __('Questions') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                                {{ __('Questions Info.') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('recommendations')" :active="request()->routeIs('recommendations')" wire:navigate>
                                {{ __('Qns. Recommendations') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                <li>
                    <x-nav-link :href="route('questionnaire')" wire:navigate
                        class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group">

                        <span class="ms-3">Questionnaire</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('templates')" :active="request()->routeIs('templates')" wire:navigate>
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01" />
                        </svg>

                        <span class="ms-3">{{ __('Templates Upload') }}</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('templates-download')" wire:navigate
                        class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Templates Download</span>
                    </x-nav-link>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-300"
                        aria-controls="dropdown-risk-analysis" data-collapse-toggle="dropdown-risk-analysis">
                        <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">Risk Analysis</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-risk-analysis" class="hidden py-2 space-y-2">
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('risk-analysis-section')" :active="request()->routeIs('risk-analysis-section')" wire:navigate>
                                {{ __('Risk Section') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('risk-analysis-subsection')" :active="request()->routeIs('risk-analysis-subsection')" wire:navigate>
                                {{ __('Risk Sub-Section') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('risk-analysis-information')" :active="request()->routeIs('risk-analysis-information')" wire:navigate>
                                {{ __('Risk Information') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                class="flex items-center p-2 text-gray-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group"
                                :href="route('risk-analysis-recommendation')" :active="request()->routeIs('risk-analysis-recommendation')" wire:navigate>
                                {{ __('Risk Recommendation') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                <li>
                    <x-nav-link :href="route('risk-profile-dashboard')" wire:navigate
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300 group">

                        <span class="ms-3">Risk Profile Dashboard</span>
                    </x-nav-link>
                </li>
            </ul>
        </div> --}}
        <div x-data="{ open: false }">
            <ul>
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-2 text-gray-500 hover:bg-gray-600 hover:text-white focus:outline-none focus:bg-gray-600">

                    <span class="ml-5">Audit TooKit</span>
                    <svg :class="{ 'rotate-180': open }" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="open" class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:text-white">
                    <ul>
                        <li class="w-full border-l-fuchsia-950">
                            <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                                :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M3 3h18v18H3V3zm2 2h14v14H5V5zM10 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zM10 17a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                                </svg>{{ __('Sections') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                                :href="route('controls')" :active="request()->routeIs('controls')" wire:navigate>
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M10 2v4h4V2zm-4 6h8v4H6zm6 4a2 2 0 1 1-2-2 2 2 0 0 1 2 2zm4-10v8a2 2 0 1 1-2-2h-4zm-6 0v8a2 2 0 1 1-2-2H4z" />
                                    <circle cx="12" cy="12" r="1" />
                                </svg>{{ __('Controls') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                                :href="route('questions')" :active="request()->routeIs('questions')" wire:navigate>
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M10.5 16.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm7 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
                                </svg>{{ __('Questions') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                                :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M10 14.5a1.5 1.5 0 0 1 0-3h4a1.5 1.5 0 0 1 0 3zM12 8v10z" />
                                </svg>{{ __('Questions Info.') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                                :href="route('recommendations')" :active="request()->routeIs('recommendations')" wire:navigate>
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M10 10v4a8 8 0 1 0 8-8V2M3 21h18v-2H3zM12 17a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                                </svg>{{ __('Recommendations') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </div>
                <li>
                    <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                        :href="route('templates')" :active="request()->routeIs('templates')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>{{ __('Templates Upload') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-300 hover:text-white"
                        :href="route('templates')" :active="request()->routeIs('templates')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>{{ __('Templates Upload') }}
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
