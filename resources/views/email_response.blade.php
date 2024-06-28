<!DOCTYPE html>
<html>

<head>
    <title>Audit Report Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            color: #333;
            font-size: 16px;
            padding: 24px;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .score-box {
            flex: 1;
            padding: 12px;
            background-color: #edf2f7;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 14px;
            margin-right: 12px;
            /* Adjust the margin as needed */
        }

        .score-box:last-child {
            margin-right: 0;
            /* Remove right margin from the last score box */
        }

        .score-box h4 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .score-value {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .response-list {
            margin-top: 24px;
            list-style-type: none;
            padding: 0;
        }

        .response-item {
            padding: 12px;
            margin-bottom: 12px;
            background-color: #edf2f7;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .response-item h4 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .response-answer {
            font-style: italic;
            font-weight: bold;
            color: #4a5568;
            /* Adjust the color as needed */
            margin-top: 8px;
            /* Add space between question and answer */
        }

        .footer {
            margin-top: 24px;
            line-height: 20pt;
            text-align: center;
            font-size: 14px;
            color: #4a5568;
            padding: 16px;
            border-top: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .footer a {
            color: #C8000B;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div style="max-width: 600px; margin: 0 auto;">
        <h3
            style="text-align: center; font-size: 18px; font-weight: bold; font-family: Arial, sans-serif;">
            Your Response
            Data</h3>
        <div class="score-container">
            <div class="score-box">
                <h4>Average Score</h4>
                <div class="score-value">
                    {{ $responseData['averageScore'] ?? 'N/A' }}
                    %</div>
            </div>
            <div class="score-box">
                <h4>Audit Score</h4>
                <div class="score-value">
                    {{ $responseData['auditScore'] ?? 'N/A' }}
                    %</div>
            </div>
            <div class="score-box">
                <h4>Security Score</h4>
                <div class="score-value">
                    {{ $responseData['securityScore'] ?? 'N/A' }}
                    %</div>
            </div>
            <div class="score-box">
                <h4>Risk Profile Score</h4>
                <div class="score-value">
                    {{ $responseData['riskProfileScore'] ?? 'N/A' }}
                    %</div>
            </div>
        </div>
        <h3 class="mb-4 text-xl font-semibold">Audit
            Response</h3>
        <ul class="response-list">
            @php
                $auditIndex = 1;
            @endphp
            @if (!empty($responseData['userResponses']))
                @foreach ($responseData['userResponses'] as $userResponse)
                    <li class="response-item">
                        <h4>{{ $auditIndex }}.
                            {{ $userResponse->question->text }}
                        </h4>
                        <p class="response-answer">
                            {{ $userResponse->answer }}</p>
                        <p class="response-answer"
                            style="font-style: italic;">
                            {{ 'Recommendation: ' . ($userResponse->recommendation ? $userResponse->recommendation->content : 'N/A') }}
                        </p>
                        @php
                            $auditIndex++;
                        @endphp
                    </li>
                @endforeach
            @else
                <li class="response-item">No audit response
                    available.</li>
            @endif
        </ul>

        <h3 class="mb-4 text-xl font-semibold">Risk Analysis
            Response</h3>
        <ul class="response-list">
            @php
                $riskIndex = 1;
            @endphp
            @if (!empty($responseData['riskAnalysisResponses']))
                @foreach ($responseData['riskAnalysisResponses'] as $response)
                    <li class="response-item">
                        <h4>{{ $riskIndex }}.
                            {{ $response['riskquestion']->text }}
                        </h4>
                        <p class="response-answer">
                            {{ $response['answer'] }}</p>
                        <p class="response-answer"
                            style="font-style: italic;">
                            {{ 'Recommendation: ' . ($response->riskRecommendation ? $response->riskRecommendation->text : 'N/A') }}
                        </p>
                        @php
                            $riskIndex++;
                        @endphp
                    </li>
                @endforeach
            @else
                <li class="response-item">No risk analysis
                    responses available.</li>
            @endif
        </ul>

        <h3 class="mb-4 text-xl font-semibold">Security
            Response</h3>
        <ul class="response-list">
            @php
                $securityIndex = 1;
            @endphp
            @if (!empty($responseData['securityResponse']))
                @foreach ($responseData['securityResponse'] as $securityResponse)
                    <li class="response-item">
                        <h4>{{ $securityIndex }}.
                            {{ $securityResponse->question->text }}
                        </h4>
                        <p class="response-answer">
                            {{ $securityResponse->answer }}
                        </p>
                        {{-- Uncomment the line below if recommendation needs to be displayed --}}
                        {{-- <p style="font-style: italic;">{{ $response->recommendation }}</p> --}}
                        @php
                            $securityIndex++;
                        @endphp
                    </li>
                @endforeach
            @else
                <li class="response-item">No security
                    responses available. Kindly take
                    questionnaire for security</li>
            @endif
        </ul>

        <div class="footer">
            <p>Kind Regards,</p>
            <p>IGNITE Data Protection Toolkit</p>
            <p>Website: <a
                    href="https://data-protection-toolkit.scratchandscript.com">https://data-protection-toolkit.scratchandscript.com</a>
            </p>
        </div>
    </div>
</body>

</html>
