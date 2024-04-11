<?php
use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
new class extends Component {
    public $data = [];
    public $riskScore;

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

        return $score->score;
    }

    public function getUserRiskAnswers()
    {
        $score = RiskAnalysisResponse::where('user_id', auth()->user()->id)
            ->selectRaw('round( (sum(case when answer = \'true\' then 1 else 0 end) / count(*)) * 100) as score')
            ->first();

        return $score->score;
    }
}; ?>
<div>
    <div class="flex">
        <!-- Left column -->
        <div class="w-1/3 mr-4 border rounded-lg">
            <h1 class="py-4 text-3xl font-bold text-center text-gray-800">Risk Profile Score</h1>
            <div style="display: flex;">
                <div id="gaugeChartContainer" style="width: 250px; height: 250px;"></div>
                <!-- Change div id to 'gaugeChartContainer' -->
            </div>
            <div class="h-24 mt-5 bg-orange-500">
                <p class="text-xl" id="gaugeValue">{{ $riskScore }}%</p>
            </div>
        </div>

        <!-- Right column -->
        <div class="w-1/4">
            <div class="grid grid-cols-2 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                <div class="h-24 bg-green-500"></div>
                <div class="h-24 bg-orange-500"></div>
                <div class="h-24 bg-red-500"></div>
                <div class="h-24 bg-yellow-400"></div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            var gaugeValue = {{ $riskScore }};

            FusionCharts.ready(function() {
                var chart = new FusionCharts({
                    type: 'angulargauge',
                    renderAt: 'gaugeChartContainer',
                    width: '100%',
                    height: '250',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Risk Profile Score",
                            "lowerLimit": "0",
                            "upperLimit": "100",
                            "showValue": "1",
                            "numberSuffix": "%",
                            "theme": "fusion"
                        },
                        "colorRange": {
                            "color": [{
                                "minValue": "0",
                                "maxValue": "50",
                                "code": "#1aaf5d"
                            }, {
                                "minValue": "50",
                                "maxValue": "75",
                                "code": "#f2c500"
                            }, {
                                "minValue": "75",
                                "maxValue": "100",
                                "code": "#c02d00"
                            }]
                        },
                        "dials": {
                            "dial": [{
                                "value": gaugeValue
                            }]
                        }
                    }
                }).render();
            });
        });
    </script>
@endpush
