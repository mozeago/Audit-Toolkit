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
<div class="relative">
    <div class="flex justify-center">
        <!-- Left column -->
        <div class="w-1/3 mr-4 border rounded-lg">
            <h1 class="py-4 text-3xl font-bold text-center text-gray-800">Risk Profile Score</h1>
            <div style="display: flex;">
                <div id="gaugeChartContainer" style="width: 250px; height: 250px;"></div>
                <!-- Change div id to 'gaugeChartContainer' -->
            </div>
            <div
                class="h-24 mt-5
                    @if ($riskScore >= 75) bg-green-500 text-white
                    @elseif ($riskScore >= 50)
                        bg-yellow-500 text-black
                    @else
                        bg-red-700 text-white @endif
                    flex flex-col justify-center items-center">
                <p class="text-xl font-bold text-center" id="gaugeValue">Average Score: {{ $riskScore }}%</p>
                <p class="text-xl text-center text-black">
                    @if ($riskScore >= 75)
                        Low Risk
                    @elseif ($riskScore >= 50)
                        Moderate Risk
                    @else
                        High Risk
                    @endif
                </p>
            </div>
        </div>

        <!-- Right column -->
        <div class="w-1/4">
            <div class="grid grid-cols-2 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                @if ($auditScore >= 70)
                    <div class="flex items-center justify-center h-24 text-center text-white bg-green-700">
                        Audit Score: {{ $auditScore }} %
                    </div>
                @elseif($auditScore >= 50)
                    <div class="flex items-center justify-center h-24 text-center text-white bg-green-500">
                        Audit Score: {{ $auditScore }} %
                    </div>
                @elseif($auditScore >= 30)
                    <div class="flex items-center justify-center h-24 text-center text-white bg-yellow-700">
                        Audit Score: {{ $auditScore }} %
                    </div>
                @else
                    <div class="flex items-center justify-center h-24 text-center text-white bg-red-700">
                        Audit Score: {{ $auditScore }} %
                    </div>
                @endif

                @if ($riskValue >= 75)
                    <div class="flex items-center justify-center h-24 text-center text-white bg-green-700">
                        Risk Score: {{ $riskValue }} %
                    </div>
                @elseif($riskValue >= 50)
                    <div class="flex items-center justify-center h-24 text-center text-white bg-green-500">
                        Risk Score: {{ $riskValue }} %
                    </div>
                @elseif($riskValue >= 30)
                    <div class="flex items-center justify-center h-24 text-center text-white bg-red-700">
                        Risk Score: {{ $riskValue }} %
                    </div>
                @else
                    <div class="flex items-center justify-center h-24 text-center text-white bg-yellow-500">
                        Risk Score: {{ $riskValue }} %
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
