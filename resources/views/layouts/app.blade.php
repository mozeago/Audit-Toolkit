<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="The Data Protection Toolkit 2024 offers a cutting-edge solution for organizations aiming to enhance their data security practices. At its core,this toolkit includes an advanced online self-assessment tool. Through this tool, organizations can seamlessly evaluate their adherence to data protection laws, receiving detailed compliance reports and insightful scorecards." />
    <title>{{ config('app.name', 'Toolkit') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    @vite(['resources/css/dashboard.css'])
    @vite(['resources/css/app.css'])
    <title>Audit Tookit</title>
    <script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js"></script>
    <script src="https://unpkg.com/chartjs-gauge@0.3.0/dist/chartjs-gauge.js"></script>
    <!-- Livewire Styles -->
    <style>
        [wire\:loading][wire\:loading],
        [wire\:loading\.delay][wire\:loading\.delay],
        [wire\:loading\.inline-block][wire\:loading\.inline-block],
        [wire\:loading\.inline][wire\:loading\.inline],
        [wire\:loading\.block][wire\:loading\.block],
        [wire\:loading\.flex][wire\:loading\.flex],
        [wire\:loading\.table][wire\:loading\.table],
        [wire\:loading\.grid][wire\:loading\.grid],
        [wire\:loading\.inline-flex][wire\:loading\.inline-flex] {
            display: none;
        }

        [wire\:loading\.delay\.none][wire\:loading\.delay\.none],
        [wire\:loading\.delay\.shortest][wire\:loading\.delay\.shortest],
        [wire\:loading\.delay\.shorter][wire\:loading\.delay\.shorter],
        [wire\:loading\.delay\.short][wire\:loading\.delay\.short],
        [wire\:loading\.delay\.default][wire\:loading\.delay\.default],
        [wire\:loading\.delay\.long][wire\:loading\.delay\.long],
        [wire\:loading\.delay\.longer][wire\:loading\.delay\.longer],
        [wire\:loading\.delay\.longest][wire\:loading\.delay\.longest] {
            display: none;
        }

        [wire\:offline][wire\:offline] {
            display: none;
        }

        [wire\:dirty]:not(textarea):not(input):not(select) {
            display: none;
        }

        :root {
            --livewire-progress-bar-color: #2299dd;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>

<body x-data="{ auditOpened: false, onBoardingOpened: false, securityQuestionsOpened: false }" class="bg-[#F4F2EE]">
    <?php
    use App\Models\User;
    ?>
    <livewire:common.topnav />
    <div class="container">
        <!-- Sidebar Section -->
        <aside class="pl-2 mb-2">
            <div class="toggle">
                <div class="logo">
                    <h2 class="font-bold md:mt-3 md:text-2xl">
                        Audit <span class="text-[#C8000B]">Toolkit</span>
                    </h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>
            <div class="overflow-visible sidebar">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center active:text-[#C8000B] hover:font-semibold">
                    <span class="mr-2 text-xl material-icons-sharp">
                        dashboard
                    </span>
                    <h3 class="m-0">Dashboard</h3>
                </a>
                @if (auth()->user()->role === 'admin')
                    <a data-dropdown-toggle="auditDropdown" onclick="return false;" @click="auditOpened = !auditOpened"
                        href="#" class="active:text-[#C8000B] hover:font-semibold hover:ml-0">
                        <span class="material-icons-sharp">
                            handyman
                        </span>
                        <h3>Audit Toolkit</h3>
                        <span :class="{ 'rotate-180': auditOpened }" class="material-icons-sharp">
                            expand_more
                        </span>
                    </a>
                    <div id="auditDropdown"
                        class="z-30 hidden w-auto pr-4 font-normal bg-white border-2 border-gray-200 rounded-lg shadow-md">
                        <ul class="items-start py-2 pt-8 text-sm text-gray-700">
                            <li>
                                <a href="{{ route('sections') }}"
                                    class="flex items-start px-2 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="mr-2 material-icons-sharp">
                                        repartition
                                    </span>
                                    Sections
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('controls') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        roundabout_left
                                    </span>Controls
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('questions') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        quiz
                                    </span>Questions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('information') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        tips_and_updates
                                    </span>Information
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('recommendations') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        recommend
                                    </span>Recommendations
                                </a>
                            </li>

                        </ul>
                    </div>

                    <a href="{{ route('templates-upload') }}" class="active:text-[#C8000B] hover:font-semibold">
                        <span class="material-icons-sharp">
                            upload_file
                        </span>
                        <h3>Templates Upload</h3>
                    </a>
                @endif
                <a href="{{ route('templates-download') }}" class="active:text-[#C8000B] hover:font-semibold">
                    <span class="material-icons-sharp">
                        file_download
                    </span>
                    <h3>Templates Download</h3>
                    {{-- <span class="message-count">5 files</span> --}}
                </a>
                <a @click="window.scrollTo({ top: 0, behavior: 'smooth' })" href="{{ route('questionnaire') }}"
                    class="active:text-[#C8000B] hover:font-semibold">
                    <span class="material-icons-sharp">
                        quiz
                    </span>
                    <h3>Audit Questionnaire</h3>
                    {{-- <span class="message-count">questions count</span> --}}
                </a>
                <a @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    href="{{ route('risk-analysis-questionnaire') }}"
                    class="active:text-[#C8000B] hover:font-semibold">
                    <span class="material-icons-sharp">
                        security
                    </span>
                    <h3>Risk Pofile Questions</h3>
                </a>
                <a href="{{ route('researchers') }}" class="active:text-[#C8000B] hover:font-semibold">
                    <span class="material-icons-sharp">
                        diversity_2
                    </span>
                    <h3>Research Team</h3>
                </a>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('project-contributors') }}" class="active:text-[#C8000B] hover:font-semibold">
                        <span class="material-icons-sharp">
                            diversity_3
                        </span>
                        <h3>Research Members</h3>
                    </a>
                    <a href="{{ route('user-settings') }}" class="active:text-[#C8000B] hover:font-semibold">
                        <span class="material-icons-sharp">
                            manage_accounts
                        </span>
                        <h3>System Users</h3>
                    </a>
                    <a data-dropdown-toggle="securityQuestionsDropdown" onclick="return false;"
                        @click="securityQuestionsOpened = !securityQuestionsOpened" href="#"
                        class="active:text-[#C8000B] hover:font-semibold hover:ml-0">
                        <span class="material-icons-sharp">
                            question_mark
                        </span>
                        <h3>Security Qtns</h3>
                        <span :class="{ 'rotate-180': securityQuestionsOpened }" class="material-icons-sharp">
                            expand_more
                        </span>
                    </a>
                    <div id="securityQuestionsDropdown"
                        class="z-30 hidden w-auto pr-4 font-normal bg-white border-2 border-[#F97316]/5 rounded-lg shadow-md">
                        <ul class="items-start py-2 pt-8 text-sm text-gray-700">
                            <li>
                                <a href="{{ route('security-sections') }}"
                                    class="flex items-start px-2 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="mr-2 material-icons-sharp">
                                        repartition
                                    </span>
                                    Sections
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('security-sub-sections') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        domain
                                    </span>Sub sections
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        recommend
                                    </span>Recommendations
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        tips_and_updates
                                    </span>Information
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        quiz
                                    </span>Questions
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('privacy-cases') }}" class="active:text-[#C8000B] hover:font-semibold">
                        <span class="material-icons-sharp">
                            phonelink_lock
                        </span>
                        <h3>Privacy Cases</h3>
                    </a>
                    <a data-dropdown-toggle="onBoardingDropdown" onclick="return false;"
                        @click="onBoardingOpened = !onBoardingOpened" href="#"
                        class="active:text-[#C8000B] hover:font-semibold hover:ml-0">
                        <span class="material-icons-sharp">
                            question_mark
                        </span>
                        <h3>Risk Profile</h3>
                        <span :class="{ 'rotate-180': onBoardingOpened }" class="material-icons-sharp">
                            expand_more
                        </span>
                    </a>
                    <div id="onBoardingDropdown"
                        class="z-30 hidden w-auto pr-4 font-normal bg-white border-2 border-[#F97316]/50 rounded-lg shadow-md">
                        <ul class="items-start py-2 pt-8 text-sm text-gray-700">
                            <li>
                                <a href="{{ route('risk-analysis-section') }}"
                                    class="flex items-start px-2 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="mr-2 material-icons-sharp">
                                        repartition
                                    </span>
                                    Sections
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('risk-analysis-subsection') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        quiz
                                    </span>Questions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('risk-analysis-information') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        tips_and_updates
                                    </span>Information
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('risk-analysis-recommendation') }}"
                                    class="flex items-start px-4 py-2 hover:font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="material-icons-sharp">
                                        recommend
                                    </span>Recommendations
                                </a>
                            </li>


                        </ul>
                    </div>
                @endif
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main class="pb-6">
            {{ $slot }}
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="p-4 mr-5 right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp"> menu
                    </span>
                </button>
                {{-- <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div> --}}

                <div class="profile">
                    <div class="info">
                        <p>Hi!,
                            <b>{{ auth()->user()->name }}</b>
                        </p>
                    </div>
                    <div class="profile-photo">
                        {{-- <img src="images/profile-1.jpg" /> --}}
                    </div>
                </div>
            </div>
            <!-- End of Nav -->
            <div class="reminders">
                <div class="header">
                    <h2>Previous Attempts</h2>
                </div>
                <livewire:historicalscores.list />
            </div>
        </div>
    </div>
    @vite(['resources/js/dashboard.js', 'resources/js/app.js'])
    <livewire:common.footer />
</body>

</html>
