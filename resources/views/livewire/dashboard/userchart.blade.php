<?php
use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
new class extends Component {
    public $data = [];
    public $riskScore;
    public $auditScore;
    public $riskValue;

    public function mount()
    {
        $this->riskScore = $this->calculateRiskScore();
    }

    public function calculateRiskScore()
    {
        $userRiskAnswers = $this->getUserRiskAnswers();
        $userAuditAnswers = $this->getUserAuditAnswers();

        return round(($userRiskAnswers + $userAuditAnswers) / 2, 0);
    }

    public function getUserAuditAnswers()
    {
        $score = UserResponse::where('user_id', auth()->user()->id)
            ->selectRaw('round( (sum(case when answer = \'true\' then 1 else 0 end) / count(*)) * 100) as score')
            ->first();
        $this->auditScore = $score->score;
        return $score->score;
    }

    public function getUserRiskAnswers()
    {
        $score = RiskAnalysisResponse::where('user_id', auth()->user()->id)
            ->selectRaw('round( (sum(case when answer = \'true\' then 1 else 0 end) / count(*)) * 100) as score')
            ->first();
        $this->riskValue = $score->score;
        return $score->score;
    }
}; ?>
<div>
    <div class="flex justify-center">
        <div class="relative flex flex-col w-1/4">
            <h2 class="text-center">Subtitle</h2>
            <p class="text-center">Centered Text</p>
            <div class="absolute bottom-0 w-full h-24 bg-gray-400"></div>
        </div>
        <div class="flex flex-col w-3/4">
            <div class="flex">
                <div class="w-1/2 h-32 bg-gray-200"></div>
                <div class="w-1/2 h-32 bg-gray-300"></div>
            </div>
            <div class="flex">
                <div class="w-1/2 h-32 bg-gray-200"></div>
                <div class="w-1/2 h-32 bg-gray-300"></div>
            </div>
            <div class="flex">
                <div class="w-1/2 h-32 bg-gray-200"></div>
                <div class="w-1/2 h-32 bg-gray-300"></div>
            </div>
        </div>
    </div>
</div>
