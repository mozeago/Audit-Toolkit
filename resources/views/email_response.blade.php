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
    <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-4 text-2xl font-semibold">Your Response Data</h1>
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
            <div>
                <p class="font-medium">Average Score:</p>
                <p>{{ $responseData['averageScore'] }} %</p>
            </div>
            <div>
                <p class="font-medium">Audit Score:</p>
                <p>{{ $responseData['auditScore'] }} %</p>
            </div>
            <div>
                <p class="font-medium">Processor Controller:</p>
                <p>{{ $responseData['processorController'] }} %</p>
            </div>
            <div>
                <p class="font-medium">Personal Data Processed By Organisation:</p>
                <p>{{ $responseData['personalDataProcessedByOrganisation'] }} %</p>
            </div>
            <div>
                <p class="font-medium">Sensitive Personal Data:</p>
                <p>{{ $responseData['sensitivePersonalData'] }} %</p>
            </div>
            <div>
                <p class="font-medium">Commercial Use Of Data:</p>
                <p>{{ $responseData['commercialUseOfData'] }} %</p>
            </div>
            <div>
                <p class="font-medium">Business Operation:</p>
                <p>{{ $responseData['businessOperation'] }} %</p>
            </div>
        </div>

        <h2 class="mb-4 text-xl font-semibold">Your Response</h2>
        <ul class="mb-6">
            @foreach ($responseData['userResponses'] as $response)
                <li class="p-3 mb-2 rounded bg-gray-50">
                    <p class="font-medium">{{ $response->question }}</p>
                    <p>{{ $response->answer }}</p>
                </li>
            @endforeach
        </ul>

        <h2 class="mb-4 text-xl font-semibold">Risk Analysis Responses</h2>
        <ul>
            @foreach ($responseData['riskAnalysisResponses'] as $response)
                <li class="p-3 mb-2 rounded bg-gray-50">
                    <p class="font-medium">{{ $response->question }}</p>
                    <p>{{ $response->answer }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
