<!DOCTYPE html>
<html>

<head>
    <title>Audit Report Data</title>
    <style>
        /* Tailwind CSS CDN Link for demonstration purposes */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            color: #333;
        }
    </style>
</head>

<body class="p-6 bg-gray-100">
    <div class="max-w-4xl p-8 mx-auto bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Survey Results</h1>

        <!-- Summary Scores Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Summary Scores</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Average Score</p>
                    <p class="text-xl font-bold text-gray-900">{{ $responseData['averageScore'] }} %</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Audit Score</p>
                    <p class="text-xl font-bold text-gray-900">{{ $responseData['auditScore'] }} %</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Processor Controller</p>
                    <p class="text-xl font-bold text-gray-900">{{ $responseData['processorController'] }} %</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Personal Data Processed By Organisation</p>
                    <p class="text-xl font-bold text-gray-900">
                        {{ $responseData['personalDataProcessedByOrganisation'] }} %</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Sensitive Personal Data</p>
                    <p class="text-xl font-bold text-gray-900">{{ $responseData['sensitivePersonalData'] }} %</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Commercial Use Of Data</p>
                    <p class="text-xl font-bold text-gray-900">{{ $responseData['commercialUseOfData'] }} %</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-lg font-medium text-gray-600">Business Operation</p>
                    <p class="text-xl font-bold text-gray-900">{{ $responseData['businessOperation'] }} %</p>
                </div>
            </div>
        </div>

        <!-- User Responses Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your Responses</h2>
            <div class="space-y-4">
                @foreach ($responseData['userResponses'] as $response)
                    <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                        <p class="text-lg font-medium text-gray-600">{{ $response->question }}</p>
                        <p class="text-md text-gray-800">{{ $response->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Risk Analysis Responses Section -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Risk Analysis Responses</h2>
            <div class="space-y-4">
                @foreach ($responseData['riskAnalysisResponses'] as $response)
                    <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                        <p class="text-lg font-medium text-gray-600">{{ $response->question }}</p>
                        <p class="text-md text-gray-800">{{ $response->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</body>

</html>
