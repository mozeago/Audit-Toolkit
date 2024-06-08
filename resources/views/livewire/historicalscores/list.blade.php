<?php

use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\PrivacyCasesModel;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
new class extends Component {
    public $userId;
    public $previousScores;
    public function mount()
    {
        $this->userId = auth()->user()->id;
        $this->previousScores = $this->getPreviousScores();
    }
    public function getPreviousScores()
    {
        $userId = auth()->id();

        // Get the highest attempt number, ensure it is a valid number
        $maxUserResponseAttempt = UserResponse::where('user_id', $userId)->max('attempt_number');
        $maxRiskAnalysisAttempt = RiskAnalysisResponse::where('user_id', $userId)->max('attempt_number');

        $maxAttemptNumber = max(is_null($maxUserResponseAttempt) ? 0 : $maxUserResponseAttempt, is_null($maxRiskAnalysisAttempt) ? 0 : $maxRiskAnalysisAttempt);

        // Get unique attempt numbers from both tables excluding the highest attempt number
        $userAttemptNumbers = UserResponse::where('user_id', $userId)->where('attempt_number', '<', $maxAttemptNumber)->select('attempt_number')->distinct()->pluck('attempt_number')->toArray();

        $riskAttemptNumbers = RiskAnalysisResponse::where('user_id', $userId)->where('attempt_number', '<', $maxAttemptNumber)->select('attempt_number')->distinct()->pluck('attempt_number')->toArray();

        // Merge and get unique attempt numbers
        $attemptNumbers = array_unique(array_merge($userAttemptNumbers, $riskAttemptNumbers));
        sort($attemptNumbers);

        $previousScores = [];

        foreach ($attemptNumbers as $attemptNumber) {
            $userResponses = UserResponse::where('user_id', $userId)->where('attempt_number', $attemptNumber)->get();

            $riskAnalysisResponses = RiskAnalysisResponse::where('user_id', $userId)->where('attempt_number', $attemptNumber)->get();

            $totalResponses = $userResponses->count() + $riskAnalysisResponses->count();
            $totalScore = 0;

            foreach ($userResponses as $response) {
                if ($response->answer === 'true') {
                    $totalScore += 1.0;
                } elseif ($response->answer === 'false') {
                    $totalScore += 0.0;
                } else {
                    $totalScore += 0.5;
                }
            }

            foreach ($riskAnalysisResponses as $response) {
                if ($response->answer === 'true') {
                    $totalScore += 1.0;
                } elseif ($response->answer === 'false') {
                    $totalScore += 0.0;
                } else {
                    $totalScore += 0.5;
                }
            }

            if ($totalResponses > 0) {
                $averageScore = round(($totalScore / $totalResponses) * 100);
            } else {
                $averageScore = 0;
            }

            $previousScores[] = [
                'attempt_number' => $attemptNumber,
                'average_score' => $averageScore,
            ];
        }

        return $previousScores;
    }
}; ?>

<div class="max-w-sm">
    <div
        class="p-6 overflow-y-auto transition-transform duration-300 ease-in-out transform bg-white rounded-lg shadow-lg max-h-96 hover:scale-105 hover:shadow-2xl focus-within:shadow-2xl focus-within:bg-gray-800">

        @if (!empty($previousScores))
            @foreach ($previousScores as $previousScore)
                <div class="notification">
                    <span
                        class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full
                @if ($previousScore['average_score'] >= 75) bg-green-500
                @elseif ($previousScore['average_score'] >= 50)
                    bg-black
                @else
                    bg-[#C8000B] @endif
                p-2 text-white">{{ $previousScore['average_score'] }}%</span>
                    <div class="content">
                        <div class="info">
                            <h3>
                                @if ($previousScore['average_score'] >= 75)
                                    Low Risk
                                @elseif ($previousScore['average_score'] >= 50)
                                    Moderate Risk
                                @else
                                    High Risk
                                @endif
                            </h3>
                            <small class="text_muted">
                                31 April 2024
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>
            @endforeach
        @else
            <div class="items-center">
                {{-- <span class="material-icons-sharp">
                    warning
                </span>
                <p class="font-mono">You don't have previous attempts yet.</p>
             --}}
                <span class="material-icons-sharp">
                    notifications_none
                </span>
            </div>
        @endif
    </div>
</div>
