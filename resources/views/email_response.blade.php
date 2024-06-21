<!DOCTYPE html>
<html>
<link rel="preload" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
</noscript>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
<script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js"></script>
<script src="https://unpkg.com/chartjs-gauge@0.3.0/dist/chartjs-gauge.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<head>
    <title>Audit Report Data</title>
    <style>
        /* Tailwind CSS CDN Link for demonstration purposes */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');

        body,
        p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        body {
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-header {
            background-color: #f0f0f0;
            padding: 10px 20px;
            border-radius: 4px 4px 0 0;
            margin-bottom: 15px;
        }

        .content {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 0 0 4px 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .score {
            display: inline-block;
            width: calc(100% / 3 - 20px);
            /* Adjust width for three columns */
            margin-right: 20px;
            vertical-align: top;
        }

        .score:last-child {
            margin-right: 0;
        }

        .score-header {
            background-color: #f0f0f0;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .score-content {
            padding: 15px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .score-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .score-value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .font-size-16 {
            font-size: 16px;
        }
    </style>
</head>

<body class="p-6 bg-[#EDF2F7]">
    <?php
    use App\Models\User;
    ?>

    <div class="container">
        <h3 class="font-size-16">Hello {{ auth()->user()->name }} !</h3>
        <h3 class="font-size-16">Here is your Audit Report Copy</h3>

        <!-- Summary Scores Section -->
        <div class="section">
            <div class="section-header">
                <h2>Summary Scores</h2>
            </div>
            <div class="content">
                <div class="grid">
                    <div class="p-6 rounded-lg shadow-md bg-gray-50">
                        <p class="text-lg font-medium text-gray-600">Average Score</p>
                        <p class="text-xl font-bold text-gray-900">80%</p>
                    </div>
                    <!-- Add other score blocks here -->
                </div>
            </div>
        </div>

        <!-- User Responses Section -->
        <div class="section">
            <div class="section-header">
                <h2>Your Responses</h2>
            </div>
            <div class="content">
                <!-- Iterate through user responses -->
                <div class="p-6 rounded-lg shadow-md bg-gray-50">
                    <p class="question">Question 1</p>
                    <p class="answer">Answer 1</p>
                </div>
                <!-- Add more response blocks here -->
            </div>
        </div>

        <!-- Risk Analysis Responses Section -->
        <div class="section">
            <div class="section-header">
                <h2>Risk Analysis Responses</h2>
            </div>
            <div class="content">
                <!-- Iterate through risk analysis responses -->
                <div class="p-6 rounded-lg shadow-md bg-gray-50">
                    <p class="question">Question 1</p>
                    <p class="answer">Answer 1</p>
                </div>
                <!-- Add more risk analysis response blocks here -->
            </div>
        </div>

    </div>
</body>

</html>
