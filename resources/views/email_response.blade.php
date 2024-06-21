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
        <h3 class="mb-4 text-2xl font-semibold">Your Response Data</h3>
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
            <div>
                <p class="font-medium" style="display: block">Average Score:</p>
                <p>{{ $responseData['averageScore'] }} %</p>
            </div>
            <div>
                <p class="font-medium" style="display: block">Audit Score:</p>
                <p>{{ $responseData['auditScore'] }} %</p>
            </div>
        </div>

        <h3 class="mb-4 text-xl font-semibold">Audit Response</h3>
        <ul class="mb-6">
            @foreach ($responseData['userResponses'] as $response)
                <li class="p-3 mb-2 rounded bg-gray-50">
                    <p class="font-medium">{{ $response->question->text }}</p>
                    <p style="font-weight: bold;font-style: italic;">{{ $response->answer }}</p>

                    <p style="font-style: italic;">{{ $response->recommendation }}</p>
                </li>
            @endforeach
        </ul>

        <h3 class="mb-4 text-xl font-semibold">Risk Analysis Responses</h3>
        <ul>
            @foreach ($responseData['riskAnalysisResponses'] as $response)
                <li class="p-3 mb-2 rounded bg-gray-50">
                    <p class="font-medium">{{ $response->riskquestion->text }}</p>
                    <p style="font-weight: bold;font-style: italic;">{{ $response->answer }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
