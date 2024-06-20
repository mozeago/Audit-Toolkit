<?php
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserResponseMail;
use App\Models\UserResponse;
use App\Models\PrivacyCasesModel;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
use App\Models\SecurityResponses;
use Livewire\Attributes\On;
use App\Models\ResearchContributorsModel;
new class extends Component {
    public $successMessage;
    public $averageScore;
    public $userId;
    public $auditScore;
    public $securityScore;
    public $riskValue;
    public $processorController;
    public $personalDataProcessedByOrganisation;
    public $sensitivePersonalData;
    public $commercialUseOfData;
    public $businessOperation;
    public $privacyCases;
    public $contributors;

    public function mount()
    {
        $this->getContributors();
        $this->privacyCases = $this->getPrivacyViolationCases();
        $this->calculateAverageScore();
        $this->userId = auth()->user()->id;
        $this->auditScore = $this->calculateAuditPercentage(UserResponse::class, $this->userId) ?? 0;
        $this->securityScore = $this->calculateAuditPercentage(SecurityResponses::class, $this->userId) ?? 0;
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
    #[On('contributor-created')]
    public function getContributors()
    {
        return $this->contributors = ResearchContributorsModel::orderBy('created_at', 'desc')->get();
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
        $securityResponse = SecurityResponses::where('user_id', $userId)->get();
        $totalResponses = $userResponses->count() + $riskAnalysisResponses->count() + $securityResponse->count();
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
        foreach ($securityResponse as $securityRes) {
            if ($securityRes->answer === 'true') {
                $totalScore += 1.0;
            } elseif ($securityRes->answer === 'false') {
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
        try {
            Mail::to($user->email)->send(new UserResponseMail($responseData));
            $this->successMessage = 'Email sent successfully!';
        } catch (\Exception $e) {
            $this->successMessage = 'Failed to send email.';
        }
    }
}; ?>
<div class="mb-4" x-data="{ successMessage: true }">

    <div class="w-full mt-0 mb-4">
        <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-sm min-h-8 hover:shadow-none">
            <!-- Fixed column at the start -->
            <div class="flex-shrink-0">
                <h1 class="text-xl font-extrabold sm:text-2xl">
                    Dashboard</h1>
            </div>
            <!-- Fixed column at the end -->
            <div class="flex-shrink-0">
                <button wire:click="emailCopy"
                    class="flex items-center rounded-full bg-black px-2 py-2 font-semibold text-white hover:bg-[#C8000B] md:rounded md:px-4 md:py-2">
                    <i class="mr-1 fas fa-envelope sm:mr-2"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#FFFFFF" class="mr-1 sm:mr-2">
                        <g>
                            <rect fill="none" height="24" width="24" />
                        </g>
                        <g>
                            <g>
                                <path d="M21,10V2H1v16h13v-5c0-1.66,1.34-3,3-3H21z M11,11L3,6V4l8,5l8-5v2L11,11z" />
                                <path
                                    d="M21,14v4c0,1.1-0.9,2-2,2s-2-0.9-2-2v-4.5c0-0.28,0.22-0.5,0.5-0.5s0.5,0.22,0.5,0.5V18h2v-4.5c0-1.38-1.12-2.5-2.5-2.5 S15,12.12,15,13.5V18c0,2.21,1.79,4,4,4s4-1.79,4-4v-4H21z" />
                            </g>
                        </g>
                    </svg>
                    <span class="hidden text-xs md:inline md:text-base">Email
                        me a copy</span></button>
            </div>
        </div>
    </div>
    @if ($successMessage)
        <div x-show="successMessage"
            class="px-4 py-3 mb-4 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md"
            role="alert">
            <div class="flex">
                <div class="py-1"><svg class="w-6 h-6 mr-4 text-teal-500 fill-current"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    <p class="font-bold">Email Sending...</p>
                    <p class="text-sm">we have sent you a copy of your scores !</p>
                </div>
                <div class="py-1 ml-auto" @click="successMessage = !successMessage">
                    <svg class="w-6 h-6 text-teal-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor"
                        onclick="document.getElementById('alert-box').style.display='none'">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    @endif
    <div class="w-full mb-8">
        <div
            class="flex flex-col items-center justify-between p-4 bg-white rounded-lg shadow-sm min-h-8 hover:shadow-none sm:flex-row">
            <!-- Fixed column at the start -->
            <div class="flex-shrink-0 mb-4 sm:mb-0">
                <p class="sm:text-base md:text-base md:font-medium">
                    A quick glance at your performance</h1>
            </div>
        </div>
    </div>
    <!-- First 3 Categories -->
    <div class="w-full mt-2 mb-4">
        <div class="grid w-full gap-4 transition-all duration-300 ease sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3">
            <div class="relative p-4 bg-white border-l-4 border-orange-500 shadow-xl rounded-3xl hover:shadow-none">
                <div class="flex flex-col">
                    <!-- Heading -->
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="40px"
                            viewBox="0 0 24 24" width="40px" fill="#C8000B">
                            <g>
                                <rect fill="none" height="24" width="24" />
                            </g>
                            <polygon
                                points="22,11 22,3 15,3 15,6 9,6 9,3 2,3 2,11 9,11 9,8 11,8 11,18 15,18 15,21 22,21 22,13 15,13 15,16 13,16 13,8 15,8 15,11" />
                        </svg>
                        <h3 class="ml-3 text-sm text-left text-wrap">
                            Activity
                            conducted by
                            controller/processor.</h3>
                    </div>
                    <!-- Score Percentage -->
                    <div class="flex items-center justify-end p-0 m-0">
                        <svg viewBox="0 0 36 36" class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]"
                            width="24" height="24">
                            <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="{{ $processorController }}, 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="font-bold percentage">{{ $processorController }}
                                %</text>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="relative p-4 bg-white border-l-4 shadow-xl rounded-3xl border-cyan-500 hover:shadow-none">
                <div class="flex flex-col">
                    <!-- Heading -->
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px"
                            fill="#C8000B">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M17.81 4.47c-.08 0-.16-.02-.23-.06C15.66 3.42 14 3 12.01 3c-1.98 0-3.86.47-5.57 1.41-.24.13-.54.04-.68-.2-.13-.24-.04-.55.2-.68C7.82 2.52 9.86 2 12.01 2c2.13 0 3.99.47 6.03 1.52.25.13.34.43.21.67-.09.18-.26.28-.44.28zM3.5 9.72c-.1 0-.2-.03-.29-.09-.23-.16-.28-.47-.12-.7.99-1.4 2.25-2.5 3.75-3.27C9.98 4.04 14 4.03 17.15 5.65c1.5.77 2.76 1.86 3.75 3.25.16.22.11.54-.12.7-.23.16-.54.11-.7-.12-.9-1.26-2.04-2.25-3.39-2.94-2.87-1.47-6.54-1.47-9.4.01-1.36.7-2.5 1.7-3.4 2.96-.08.14-.23.21-.39.21zm6.25 12.07c-.13 0-.26-.05-.35-.15-.87-.87-1.34-1.43-2.01-2.64-.69-1.23-1.05-2.73-1.05-4.34 0-2.97 2.54-5.39 5.66-5.39s5.66 2.42 5.66 5.39c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-2.42-2.09-4.39-4.66-4.39s-4.66 1.97-4.66 4.39c0 1.44.32 2.77.93 3.85.64 1.15 1.08 1.64 1.85 2.42.19.2.19.51 0 .71-.11.1-.24.15-.37.15zm7.17-1.85c-1.19 0-2.24-.3-3.1-.89-1.49-1.01-2.38-2.65-2.38-4.39 0-.28.22-.5.5-.5s.5.22.5.5c0 1.41.72 2.74 1.94 3.56.71.48 1.54.71 2.54.71.24 0 .64-.03 1.04-.1.27-.05.53.13.58.41.05.27-.13.53-.41.58-.57.11-1.07.12-1.21.12zM14.91 22c-.04 0-.09-.01-.13-.02-1.59-.44-2.63-1.03-3.72-2.1-1.4-1.39-2.17-3.24-2.17-5.22 0-1.62 1.38-2.94 3.08-2.94s3.08 1.32 3.08 2.94c0 1.07.93 1.94 2.08 1.94s2.08-.87 2.08-1.94c0-3.77-3.25-6.83-7.25-6.83-2.84 0-5.44 1.58-6.61 4.03-.39.81-.59 1.76-.59 2.8 0 .78.07 2.01.67 3.61.1.26-.03.55-.29.64-.26.1-.55-.04-.64-.29-.49-1.31-.73-2.61-.73-3.96 0-1.2.23-2.29.68-3.24 1.33-2.79 4.28-4.6 7.51-4.6 4.55 0 8.25 3.51 8.25 7.83 0 1.62-1.38 2.94-3.08 2.94s-3.08-1.32-3.08-2.94c0-1.07-.93-1.94-2.08-1.94s-2.08.87-2.08 1.94c0 1.71.66 3.31 1.87 4.51.95.94 1.86 1.46 3.27 1.85.27.07.42.35.35.61-.05.23-.26.38-.47.38z" />
                        </svg>
                        <h3 class="ml-3 text-sm text-left text-wrap">
                            Personal data processed
                            by the organisation.</h3>
                    </div>
                    <!-- Score Percentage -->
                    <div class="flex items-center justify-end p-0 m-0">
                        <svg viewBox="0 0 36 36" class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]"
                            width="24" height="24">
                            <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="{{ $personalDataProcessedByOrganisation }}, 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35"
                                class="font-bold percentage">{{ $personalDataProcessedByOrganisation }}
                                %</text>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="relative p-4 bg-white border-l-4 border-red-500 shadow-xl rounded-3xl hover:shadow-none">
                <div class="flex flex-col">
                    <!-- Heading -->
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 20 20" height="48px"
                            viewBox="0 0 20 20" width="48px" fill="#C8000B">
                            <g>
                                <rect fill="none" height="20" width="20" />
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M13,9c0.35,0,0.68,0.06,1,0.14V6.18L9,4L4,6.18v3.27c0,3.03,2.13,5.86,5,6.55c0.35-0.08,0.7-0.2,1.02-0.35 C9.39,14.94,9,14.02,9,13C9,10.79,10.79,9,13,9z" />
                                    <path
                                        d="M13,10c-1.66,0-3,1.34-3,3c0,1.66,1.34,3,3,3s3-1.34,3-3C16,11.34,14.66,10,13,10z M13,11.03c0.47,0,0.84,0.38,0.84,0.84 c0,0.46-0.38,0.84-0.84,0.84s-0.84-0.38-0.84-0.84C12.16,11.41,12.53,11.03,13,11.03z M13,15.06c-0.7,0-1.31-0.35-1.68-0.87 c0.04-0.54,1.13-0.81,1.68-0.81s1.64,0.27,1.68,0.81C14.31,14.72,13.7,15.06,13,15.06z" />
                                </g>
                            </g>
                        </svg>
                        <h3 class="ml-3 text-sm text-left text-wrap">
                            Processing of sensitive personal
                            data.</h3>
                    </div>
                    <!-- Score Percentage -->
                    <div class="flex items-center justify-end p-0 m-0">
                        <svg viewBox="0 0 36 36" class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]"
                            width="24" height="24">
                            <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="{{ $sensitivePersonalData }} , 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="font-bold percentage">{{ $sensitivePersonalData }}
                                %</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of First 3 categories -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <!-- First Column -->
        <div class="flex flex-col md:col-span-1">
            <!-- First column, 1/3 width -->
            <!-- Card -->
            <div class="flex-grow max-w-sm overflow-hidden bg-white shadow-xl rounded-3xl hover:shadow-none">
                <div class="px-4 py-2">
                    <div class="mb-2 text-xl font-bold text-center">
                        Privacy Score</div>
                </div>
                <div class="flex flex-col justify-center flex-grow">

                    <canvas id="chart"></canvas>
                    <p class="items-center text-base font-medium text-center text-cyan-500" id="gaugeValue">
                        Average Score:</p>
                    <div class="flex items-center w-full px-4">
                        <div class="flex items-center w-1/2">
                            <svg viewBox="0 0 36 36" class="w-20 h-20 circular-chart green">
                                <path class="circle-bg" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" stroke-dasharray="{{ $averageScore }}, 100" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <text x="18" y="20.35" class="percentage">{{ $averageScore }}
                                    %</text>
                            </svg>
                        </div>
                        <div class="flex items-end justify-end w-1/2">
                            <p class="items-end text-lg font-bold">
                                @if ($averageScore >= 75)
                                    <span style="color: green;">Low
                                        Risk</span>
                                @elseif($averageScore >= 50)
                                    <span style="color: orange;">Moderate
                                        Risk</span>
                                @else
                                    <span style="color: red;">High
                                        Risk</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End  Card -->
        </div>
        <!-- Second Column -->
        <div class="flex flex-col gap-5 md:col-span-2">
            <!-- Second column, 2/3 width -->
            <!-- First Row -->
            <div class="grid flex-grow grid-cols-1 gap-4 md:grid-cols-2">
                <div class="flex flex-col h-full md:col-span-1">
                    <div
                        class="relative p-4 bg-white border-l-4 shadow-xl rounded-3xl border-cyan-500 hover:shadow-none">
                        <div class="flex flex-col">
                            <!-- Heading -->
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#C8000B">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M21 18v3H3V3h18v3H10v12h11zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                                </svg>
                                <h3 class="ml-3 text-sm text-left text-wrap">
                                    Commercial use of Data.
                                </h3>
                            </div>
                            <!-- Score Percentage -->
                            <div class="flex items-center justify-end p-0 m-0">
                                <svg viewBox="0 0 36 36"
                                    class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]" width="24"
                                    height="24">
                                    <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="{{ $commercialUseOfData }} , 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="20.35" class="font-bold percentage">{{ $commercialUseOfData }}
                                        %</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col h-full md:col-span-1">
                    <div
                        class="relative p-4 bg-white border-l-4 border-green-500 shadow-xl rounded-3xl hover:shadow-none">
                        <div class="flex flex-col">
                            <!-- Heading -->
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#C8000B">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                        <path
                                            d="M20 6h-4c0-2.21-1.79-4-4-4S8 3.79 8 6H4v16h16V6zm-10 5H8V8h2v3zm2-7c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm4 7h-2V8h2v3z" />
                                    </g>
                                </svg>

                                <h3 class="ml-3 text-sm text-left text-wrap">
                                    Business Operations</h3>
                            </div>
                            <!-- Score Percentage -->
                            <div class="flex items-center justify-end p-0 m-0">
                                <svg viewBox="0 0 36 36"
                                    class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]" width="24"
                                    height="24">
                                    <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="{{ $businessOperation }}, 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="20.35" class="font-bold percentage">{{ $businessOperation }}
                                        %</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Second Row -->
            <div class="grid flex-grow grid-cols-1 gap-4 md:grid-cols-2">

                <div class="flex flex-col h-full md:col-span-1">
                    <div
                        class="relative p-4 bg-white border-l-4 shadow-xl rounded-3xl border-cyan-500 hover:shadow-none">
                        <div class="flex flex-col">
                            <!-- Heading -->
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 20 20"
                                    height="24px" viewBox="0 0 20 20" width="24px" fill="#C8000B">
                                    <g>
                                        <g>
                                            <rect fill="none" height="20" width="20" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M12.52,9.7c1.25-0.34,2.44-0.23,3.48,0.18V7h-2l0-1.83c0-2.09-1.53-3.95-3.61-4.15C8.01,0.79,6,2.66,6,5v2H4v11h5.4 c-0.77-1.18-1.1-2.66-0.76-4.22C9.06,11.82,10.59,10.23,12.52,9.7z M7.5,5c0-1.38,1.12-2.5,2.5-2.5s2.5,1.12,2.5,2.5v2h-5V5z" />
                                            <path
                                                d="M14,11c-2.21,0-4,1.79-4,4c0,2.21,1.79,4,4,4s4-1.79,4-4C18,12.79,16.21,11,14,11z M13.5,13h1v1.79l1.35,1.35l-0.71,0.71 l-1.65-1.65V13z" />
                                        </g>
                                    </g>
                                </svg>
                                <h3 class="ml-3 text-sm text-left text-wrap">
                                    Audit Score.</h3>
                            </div>
                            <!-- Score Percentage -->
                            <div class="flex items-center justify-end p-0 m-0">
                                <svg viewBox="0 0 36 36"
                                    class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]" width="24"
                                    height="24">
                                    <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="{{ $auditScore }}, 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="20.35" class="font-bold percentage">{{ $auditScore }}
                                        %</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col h-full md:col-span-1">
                    <div
                        class="relative p-4 bg-white border-l-4 border-green-500 shadow-xl rounded-3xl hover:shadow-none">
                        <div class="flex flex-col">
                            <!-- Heading -->
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 20 20"
                                    height="24px" viewBox="0 0 20 20" width="24px" fill="#C8000B">
                                    <rect fill="none" height="20" width="20" />
                                    <polygon
                                        points="16.81,7.8 15.31,5.2 11.5,7.4 11.5,3 8.5,3 8.5,7.4 4.69,5.2 3.19,7.8 7,10 3.19,12.2 4.69,14.8 8.5,12.6 8.5,17 11.5,17 11.5,12.6 15.31,14.8 16.81,12.2 13,10" />
                                </svg>

                                <h3 class="ml-3 text-sm text-left text-wrap">
                                    Security Score</h3>
                            </div>
                            <!-- Score Percentage -->
                            <div class="flex items-center justify-end p-0 m-0">
                                <svg viewBox="0 0 36 36"
                                    class="circular-chart green h-16 max-h-[92px] w-16 max-w-[92px]" width="24"
                                    height="24">
                                    <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="{{ $auditScore }}, 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="20.35" class="font-bold percentage">{{ $securityScore }}
                                        %</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($privacyCases->isNotEmpty())
        <div class="flex items-center justify-center mt-8 mb-8">
            <div class="flex-grow border-b-4 border-[#1C4863]">
            </div>
            <span class="px-3 text-xl font-bold text-center">Privacy
                Cases</span>
            <div class="flex-grow border-b-4 border-[#1C4863]">
            </div>

        </div>
        <div class="bg-white shadow-2xl hover:shadow-none">
            <div class="flex flex-row rounded-t-lg bg-[#1C4863] text-white">
                <!-- Header Row -->
                <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                    Name</div>
                <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                    Case No.</div>
                <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                    Title</div>
                <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                    Link</div>
            </div>
            @foreach ($privacyCases as $privacyCase)
                <div class="flex flex-row bg-white rounded-b-lg">
                    <!-- Data Row -->
                    <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                        style="flex-basis: 25%;">
                        {{ $privacyCase->casename }}
                    </div>
                    <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                        style="flex-basis: 25%;">
                        {{ $privacyCase->casenumber }}
                    </div>
                    <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                        style="flex-basis: 25%;">
                        {{ $privacyCase->casetitle }}
                    </div>
                    <div class="flex items-center justify-center flex-none sm:p-1 md:p-4" style="flex-basis: 25%;">
                        <a target="_blank" href="{{ $privacyCase->caselink }}"
                            class="inline-block rounded-full bg-gray-900 text-white shadow-lg hover:bg-[#C8000B] focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-75 sm:px-2 sm:py-2 sm:text-xs md:px-6 md:py-2">
                            Watch
                        </a>
                    </div>
                </div>
                <div class="flex-grow border-b border-gray-300">
                </div>
            @endforeach
        </div>
    @endif
</div>
<script type="text/javascript">
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var randomData = function() {
        return [25, 15, 10, 50];
    };

    var averageValue = function() {
        return {{ $averageScore }};
    };

    var valueToAngle = function() {
        return Math.round(({{ $averageScore }} / 100) *
            180);
    };

    var data = randomData();
    var value = averageValue();
    var angle = (valueToAngle() / 180) * 50;

    var config = {
        type: 'gauge',
        data: {
            datasets: [{
                data: data,
                value: angle, // Replace with actual average score value if available
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
                formatter: function() {
                    return value; // Empty string to remove the value display
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
