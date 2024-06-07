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
        // Get the highest attempt number
        $maxAttemptNumber = max(UserResponse::where('user_id', $userId)->max('attempt_number'), RiskAnalysisResponse::where('user_id', $userId)->max('attempt_number'));

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

<div>
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
    @endforeach
    {{-- <div class="notification deactive">
        <span
            class="flex items-center justify-center flex-shrink-0 w-12 h-12 p-2 mr-4 text-white bg-black rounded-full">56%</span>
        <div class="content">
            <div class="info">
                <h3>Moderate</h3>
                <small class="text_muted">
                    15 May 2024
                </small>
            </div>
            <span class="material-icons-sharp">
                more_vert
            </span>
        </div>
    </div> --}}
</div>
