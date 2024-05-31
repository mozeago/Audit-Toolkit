<?php
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserResponseMail;
use App\Models\UserResponse;
use App\Models\PrivacyCasesModel;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
new class extends Component {
    public $averageScore;
    public $userId;
    public $auditScore;
    public $riskValue;
    public $processorController;
    public $personalDataProcessedByOrganisation;
    public $sensitivePersonalData;
    public $commercialUseOfData;
    public $businessOperation;
    public $privacyCases;

    public function mount()
    {
        $this->privacyCases = $this->getPrivacyViolationCases();
        $this->calculateAverageScore();
        $this->userId = auth()->user()->id;
        $this->auditScore = $this->calculateAuditPercentage(UserResponse::class, $this->userId) ?? 0;
        $automatedDecisionProfiling = $this->calculateProcessingActivityTypePercentage('Automated Decision and Profiling');
        $largeScaleProcessing = $this->calculateProcessingActivityTypePercentage('Large Scale Processing');
        $systematicMonitoring = $this->calculateProcessingActivityTypePercentage('Systematic monitoring');
        $sensitiveDataProcessing = $this->calculateProcessingActivityTypePercentage('Sensitive data processing');
        $businessInnovationTechnology = $this->calculateProcessingActivityTypePercentage('Business innovation, expansion, and use of technology');
        $this->processorController = round(($automatedDecisionProfiling + $largeScaleProcessing + $systematicMonitoring + $sensitiveDataProcessing + $businessInnovationTechnology) / 5);
        $pinPasswordSecretKeys = $this->calculateProcessingActivityTypePercentage('PIN/Password/Secret keys');
        $incomeRemuneration = $this->calculateProcessingActivityTypePercentage('Income, remuneration, and net worth');
        $cardData = $this->calculateProcessingActivityTypePercentage('Card Data');
        $healthData = $this->calculateProcessingActivityTypePercentage('Health Data');
        $dataRelatingToVulnerableGroup = $this->calculateProcessingActivityTypePercentage('Data relating to the vulnerable group');
        $this->personalDataProcessedByOrganisation = round(($pinPasswordSecretKeys + $incomeRemuneration + $cardData + $healthData + $dataRelatingToVulnerableGroup) / 5);
        $this->sensitivePersonalData = $this->calculateProcessingActivityTypePercentage('Processing of sensitive personal data');
        $this->commercialUseOfData = $this->calculateProcessingActivityTypePercentage('Commercial use of data');
        $this->businessOperation = $this->calculateProcessingActivityTypePercentage('Business Operation');
    }

    public function calculateAuditPercentage($modelClass, $userId)
    {
        // Subquery to get the maximum attempt number for the given user
        $subQuery = $modelClass::select(DB::raw('MAX(attempt_number) AS max_attempt'))->where('user_id', $userId)->groupBy('user_id')->limit(1);

        // Main query to get the total count and weighted score for the highest attempt number
        $data = $modelClass::select(DB::raw('count(*) as total_count'), DB::raw('SUM(CASE WHEN answer = \'true\' THEN 1 WHEN answer = \'partial\' THEN 0.5 ELSE 0 END) as weighted_score'))->where('user_id', $userId)->where('attempt_number', $subQuery)->first();

        if (!$data) {
            return 0;
        }

        $totalCount = $data->total_count ?? 0;
        $weightedScore = $data->weighted_score ?? 0;

        if ($totalCount === 0) {
            $percentage = 0;
        } else {
            $percentage = round(($weightedScore / $totalCount) * 100);
        }

        return $percentage;
    }
    public function calculateProcessingActivityTypePercentage(string $riskProfileCategory)
    {
        $user = auth()->user()->id;

        $subQuery = DB::table('risk_analysis_responses AS rar')->select('rar.risk_sub_section_id', DB::raw('MAX(rar.attempt_number) AS max_attempt'))->groupBy('rar.risk_sub_section_id', 'rar.user_id');

        $data = DB::table('risk_analysis_responses AS rar')
            ->joinSub($subQuery, 'latest_attempts', function ($join) {
                $join->on('rar.risk_sub_section_id', '=', 'latest_attempts.risk_sub_section_id')->on('rar.attempt_number', '=', 'latest_attempts.max_attempt');
            })
            ->join('risk_sub_sections AS rss', 'rar.risk_sub_section_id', '=', 'rss.id')
            ->select(DB::raw('count(*) as total_count'), DB::raw('sum(rar.answer = true) as true_count'))
            ->where('rss.subtitle', '=', strtolower(trim($riskProfileCategory)))
            ->where('rar.answer', true)
            ->where('rar.user_id', $user)
            ->first();

        if (!$data) {
            return 0;
        }

        $totalCount = $data->total_count ?? 0;
        $trueCount = $data->true_count ?? 0;

        if ($totalCount === 0) {
            $percentage = 0;
        } else {
            $percentage = round(($trueCount / $totalCount) * 100);
        }

        return $percentage;
    }

    public function calculateAverageScore()
    {
        $userId = Auth::id();

        $userResponses = UserResponse::where('user_id', $userId)->get();
        $riskAnalysisResponses = RiskAnalysisResponse::where('user_id', $userId)->get();

        $totalResponses = $userResponses->count() + $riskAnalysisResponses->count();
        $totalScore = 0;

        // Loop through user responses
        foreach ($userResponses as $response) {
            if ($response->answer === 'true') {
                $totalScore += 1.0;
            } elseif ($response->answer === 'false') {
                $totalScore += 0.0;
            } else {
                $totalScore += 0.5;
            }
        }

        // Loop through risk analysis responses
        foreach ($riskAnalysisResponses as $response) {
            if ($response->answer === 'true') {
                $totalScore += 1.0;
            } elseif ($response->answer === 'false') {
                $totalScore += 0.0;
            } else {
                $totalScore += 0.5;
            }
        }

        // Calculate the average score if total responses is not zero
        if ($totalResponses > 0) {
            $this->averageScore = round(($totalScore / $totalResponses) * 100);
        } else {
            $this->averageScore = 0;
        }

        return $this->averageScore;
    }
    public function getPrivacyViolationCases()
    {
        return PrivacyCasesModel::orderBy('created_at', 'desc')->get();
    }
    public function emailCopy()
    {
        $user = auth()->user();
        $userId = $user->id;

        // Gather user responses
        $userResponses = UserResponse::where('user_id', $userId)->get();
        $riskAnalysisResponses = RiskAnalysisResponse::where('user_id', $userId)->get();

        // Formatting data for emailing
        $responseData = [
            'userResponses' => $userResponses,
            'riskAnalysisResponses' => $riskAnalysisResponses,
            'averageScore' => $this->calculateAverageScore(),
            'auditScore' => $this->calculateAuditPercentage(UserResponse::class, $userId),
            'processorController' => $this->processorController,
            'personalDataProcessedByOrganisation' => $this->personalDataProcessedByOrganisation,
            'sensitivePersonalData' => $this->sensitivePersonalData,
            'commercialUseOfData' => $this->commercialUseOfData,
            'businessOperation' => $this->businessOperation,
        ];

        // Send the email
        Mail::to($user->email)->send(new UserResponseMail($responseData));
    }
}; ?>
<div class="pr-2 border-2 border-red-500">
    <h1>Analytics</h1>
    <!-- Analyses -->
    <div class="analyse">
        <div class="sales">
            <div class="status">
                <div class="info">
                    <h3>Total Sales</h3>
                    <h1>$65,024</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38"
                            r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>+81%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="visits">
            <div class="status">
                <div class="info">
                    <h3>Site Visit</h3>
                    <h1>24,981</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38"
                            cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>-48%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="searches">
            <div class="status">
                <div class="info">
                    <h3>Searches</h3>
                    <h1>14,147</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38"
                            cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>+21%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Analyses -->

    <!-- New Users Section -->
    <div class="new-users">
        <h2>New Users</h2>
        <div class="user-list">
            <div class="user">
                <img src="images/profile-2.jpg" />
                <h2>Jack</h2>
                <p>54 Min Ago</p>
            </div>
            <div class="user">
                <img src="images/profile-3.jpg" />
                <h2>Amir</h2>
                <p>3 Hours Ago</p>
            </div>
            <div class="user">
                <img src="images/profile-4.jpg" />
                <h2>Ember</h2>
                <p>6 Hours Ago</p>
            </div>
            <div class="user">
                <img src="images/plus.png" />
                <h2>More</h2>
                <p>New User</p>
            </div>
        </div>
    </div>
    <!-- End of New Users Section -->

    <!-- Recent Orders Table -->
    <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Course Number</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <a href="#">Show All</a>
    </div>
    <!-- End of Recent Orders -->
</div>
<script type="text/javascript">
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var randomData = function() {
        return [
            25,
            15,
            10,
            50
        ];
    };

    var averageValue = function() {
        return {{ $averageScore }};
    };
    var valueToAngle = function(value) {
        var maxAngle = 180;
        var angle = (value / 100) * maxAngle;
        return angle;
    };
    var data = randomData();
    var value = averageValue();
    var angle = valueToAngle({{ $averageScore }});

    var config = {
        type: 'gauge',
        data: {
            datasets: [{
                data: data,
                value: value,
                backgroundColor: ['red',
                    'orange', 'yellow',
                    'green'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    bottom: 30
                }
            },
            needle: {
                // Needle circle radius as the percentage of the chart area width
                radiusPercentage: 3,
                // Needle width as the percentage of the chart area width
                widthPercentage: 3.2,
                // Needle length as the percentage of the interval between inner radius (0%) and outer radius (100%) of the arc
                lengthPercentage: 80,
                // The color of the needle
                color: 'rgba(0, 0, 0, 1)'
            },
            valueLabel: {
                formatter: Math.round
            },
            animation: {
                onComplete: function(animation) {
                    var needleAngle = valueToAngle(
                        {{ $averageScore }});
                    window.myGauge.config.options
                        .needle.rotation =
                        needleAngle;
                    window.myGauge.update();
                }
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('chart')
            .getContext('2d');
        window.myGauge = new Chart(ctx, config);
    };
</script>
