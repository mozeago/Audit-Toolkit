<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="The Data Protection Toolkit 2024 offers a cutting-edge solution for organizations aiming to enhance their data security practices. At its core,this toolkit includes an advanced online self-assessment tool. Through this tool, organizations can seamlessly evaluate their adherence to data protection laws, receiving detailed compliance reports and insightful scorecards." />
    <title>{{ config('app.name', 'Toolkit') }}</title>
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
        rel="stylesheet" />
    @vite(['resources/css/dashboard.css'])
    @vite(['resources/css/app.css'])
    <title>Audit Tookit</title>
</head>

<body>
    <?php
    use App\Models\User;
    ?>
    <livewire:common.topnav />
    <div class="container">
        <!-- Sidebar Section -->
        <aside class="pl-2">
            <div class="toggle">
                <div class="logo">
                    <h2>
                        Audit<span
                            class="danger">Toolkit</span>
                    </h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#"
                    class="inline-flex items-center">
                    <span
                        class="material-icons-sharp mr-2 text-xl">
                        dashboard
                    </span>
                    <h3 class="m-0">Dashboard</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>History</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Tickets</h3>
                    <span class="message-count">27</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Sale List</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Reports</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"> add
                    </span>
                    <h3>New Login</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section mr-5">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp"> menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span
                        class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

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
                    {{-- <span class="material-icons-sharp">
                        notifications_none
                    </span> --}}
                </div>

                <div class="notification">
                    <span
                        class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#C8000B] p-2 text-white">67%</span>
                    <div class="content">
                        <div class="info">
                            <h3>Average</h3>
                            <small class="text_muted">
                                31 April 2024
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <span
                        class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-black p-2 text-white">56%</span>
                    <div class="content">
                        <div class="info">
                            <h3>Average</h3>
                            <small class="text_muted">
                                15 May 2024
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/dashboard.js', 'resources/js/app.js'])
    <livewire:common.footer />
</body>

</html>
