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
        <div x-data="{ open: false, isOpen: false }">
            <ul>
                <li>
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-2 text-gray-500 hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-600">

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
                            <li class="w-ful">
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                                    {{ __('Sections') }}
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('controls')" :active="request()->routeIs('controls')" wire:navigate>
                                    {{ __('Controls') }}
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('questions')" :active="request()->routeIs('questions')" wire:navigate>
                                    {{ __('Questions') }}
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                                    {{ __('Questions Info.') }}
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('recommendations')" :active="request()->routeIs('recommendations')" wire:navigate>
                                    {{ __('Recommendations') }}
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                        :href="route('templates')" :active="request()->routeIs('templates')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ __('Templates Upload') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                        :href="route('templates-download')" :active="request()->routeIs('templates-download')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>

                        {{ __('Templates Download') }}
                    </x-nav-link>
                </li>
                <li>
                <li>
                    <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                        :href="route('questionnaire')" :active="request()->routeIs('questionnaire')" wire:navigate>
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        {{ __('Audit Questionnaire') }}
                    </x-nav-link>
                </li>
                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                    :href="route('risk-profile-dashboard')" :active="request()->routeIs('risk-profile-dashboard')" wire:navigate>
                    <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                    </svg>

                    {{ __('Risk Profile Dashboard') }}
                </x-nav-link>
                </li>
                <li>
                    <button @click="isOpen = !isOpen"
                        class="flex items-center justify-between w-full px-4 py-2 text-gray-500 hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-600">
                        <span class="ml-5">{{ __('Risk Analysis') }}</span>
                        <svg :class="{ 'rotate-180': open }" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="isOpen" class="block px-8 py-2 text-gray-300 hover:bg-gray-200 hover:text-white">
                        <ul>
                            <li class="w-full">
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('risk-analysis-section')" :active="request()->routeIs('risk-analysis-section')" wire:navigate>
                                    {{ __('Risk Section') }}
                                </x-nav-link>
                            </li>
                            <li class="w-full">
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('risk-analysis-subsection')" :active="request()->routeIs('risk-analysis-subsection')" wire:navigate>
                                    {{ __('Risk Sub-Section') }}
                                </x-nav-link>
                            </li>
                            <li class="w-full">
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('risk-analysis-information')" :active="request()->routeIs('risk-analysis-information')" wire:navigate>
                                    {{ __('Risk Information') }}
                                </x-nav-link>
                            </li>
                            <li class="w-full">
                                <x-nav-link class="block w-full py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                                    :href="route('risk-analysis-recommendation')" :active="request()->routeIs('risk-analysis-recommendation')" wire:navigate>
                                    {{ __('Risk Recommendation') }}
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>
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
