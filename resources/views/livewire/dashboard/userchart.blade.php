<?php
use Livewire\Volt\Component;
use App\Models\UserResponse;
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

    public function mount()
    {
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
        $data = $modelClass::select(DB::raw('count(*) as total_count'), DB::raw('SUM(CASE WHEN answer = \'true\' THEN 1 WHEN answer = \'partial\' THEN 0.5 ELSE 0 END) as weighted_score'))->where('user_id', $userId)->first();

        if (!$data) {
            return 0;
        }
        $totalCount = $data->total_count ?? 0;
        $weightedScore = $data->weighted_score ?? 0;

        if ($totalCount === 0) {
            $percentage = 0;
        } else {
            $percentage = round(($weightedScore / $totalCount) * 100) ?? 0;
        }

        return $percentage;
    }
    public function calculateProcessingActivityTypePercentage(string $riskProfileCategory)
    {
        $user = auth()->user()->id;
        $data = DB::table('risk_analysis_responses AS rar')
            ->select(DB::raw('count(*) as total_count'), DB::raw('sum(answer = true) as true_count'))
            ->join('risk_sub_sections AS rss', 'rar.risk_sub_section_id', '=', 'rss.id')
            ->where(strtolower(trim('rss.subtitle')), '=', strtolower(trim($riskProfileCategory)))
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
            $percentage = round(($trueCount / $totalCount) * 100) ?? 0;
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
}; ?>
<div class="p-8">
    <div class="flex justify-center gap-8">
        <div class="relative flex flex-col w-1/4 p-4 bg-gray-200 rounded-lg shadow-2xl h-80">
            <h2 class="text-2xl font-medium text-center">Privacy Score
            </h2>
            <div class="flex flex-col justify-center flex-grow">
                <div class="text-center">Meter Gauge</div>
            </div>
            <div
                class="@if ($averageScore >= 70) text-white bg-green-700
                @elseif($averageScore >= 50)text-white bg-green-500
                @elseif($averageScore >= 30) text-white bg-yellow-700
                @else text-white bg-red-700 @endif absolute bottom-0 left-0 w-full">
                <p class="text-xl font-bold text-center" id="gaugeValue">Average Score:</p>
                <p class="text-xl font-extrabold text-center">
                    {{ $averageScore }}%</p>

                <p class="text-center text-l">
                    @if ($averageScore >= 75)
                        Low Risk
                    @elseif($averageScore >= 50)
                        Moderate Risk
                    @else
                        High Risk
                    @endif
                </p>
            </div>
        </div>
        <div class="flex flex-col w-3/4 gap-2">

            <div class="flex gap-2">
                <div
                    class="p-4 @if ($processorController >= 70) text-white bg-green-700
                    @elseif($processorController >= 50)text-white bg-green-500
                    @elseif($processorController >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl flex flex-col justify-between">
                    <div class="flex items-center justify-center h-1/2">
                        <!-- Icon-->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                            stroke="currentColor" className="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <!-- Text -->
                        <span class="mt-2 ml-2 font-semibold text-center text-l">Type of
                            processing activity
                            conducted by
                            controller/processor:</span>
                    </div>
                    <div class="flex items-center justify-center h-1/2">
                        <!-- Text here -->
                        <span class="text-lg font-extrabold">{{ $processorController }} %</span>
                    </div>
                </div>

                {{-- <div
                    class="@if ($processorController >= 70) text-white bg-green-700
                    @elseif($processorController >= 50)text-white bg-green-500
                    @elseif($processorController >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Type of processing activity
                        conducted by
                        controller/processor:
                    </h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $processorController }} %</p>
                </div> --}}
                <div
                    class="@if ($personalDataProcessedByOrganisation >= 70) text-white bg-green-700
                    @elseif($personalDataProcessedByOrganisation >= 50)text-white bg-green-500
                    @elseif($personalDataProcessedByOrganisation >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Type of personal data processed by
                        the
                        organisation:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $personalDataProcessedByOrganisation }}
                        %</p>
                </div>
            </div>
            <div class="flex gap-2">
                <div
                    class="@if ($sensitivePersonalData >= 70) text-white bg-green-700
                    @elseif($sensitivePersonalData >= 50)text-white bg-green-500
                    @elseif($sensitivePersonalData >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md bg-gray-200 shadow-2xl">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Processing of sensitive personal
                        data:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $sensitivePersonalData }} %</p>
                </div>
                <div
                    class="@if ($commercialUseOfData >= 70) text-white bg-green-700
                    @elseif($commercialUseOfData >= 50)text-white bg-green-500
                    @elseif($commercialUseOfData >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Commercial use of data:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $commercialUseOfData }} %</p>
                </div>
            </div>
            <div class="flex gap-2">
                <div
                    class="@if ($businessOperation >= 70) text-white bg-green-700
                    @elseif($businessOperation >= 50)text-white bg-green-500
                    @elseif($businessOperation >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-full rounded-md shadow-2xl">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Business Operation:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $businessOperation }} %</p>
                </div>
            </div>
            <div class="flex gap-2">
                <div
                    class="@if ($auditScore >= 70) text-white bg-green-700
                    @elseif($auditScore >= 50)text-white bg-green-500
                    @elseif($auditScore >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Audit Score:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $auditScore }} %</p>
                </div>
                <div
                    class="@if ($riskValue >= 70) text-white bg-green-700
                    @elseif($riskValue >= 50)text-white bg-green-500
                    @elseif($riskValue >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Risk Score:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $riskValue }} %</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Table --}}
    <div class="w-full mt-16">
        <h2 class="text-xl font-bold text-center">Privacy
            Violation Cases</h2>
    </div>
    <div class="flex justify-center mt-4 shadow-2xl">
        <div class="flex justify-center">
            <table class="w-full bg-white border border-gray-300 divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">
                            Case
                            No.
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">
                            Video
                            Title</th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">
                            Link
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Kenya Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Jane Njeri</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case KEN-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Data Breach by Banking
                            Institution</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="kenya-case-001-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            James Otieno</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case KEN-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Health Records Leak by Hospital
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="kenya-case-002-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <!-- Rwanda Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Emmanuel Habimana</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case RWA-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Government Surveillance Program
                            Exposed</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="rwanda-case-001-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Lilian Uwamahoro</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case RWA-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Employer Spying on Employees
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="rwanda-case-002-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <!-- Uganda Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Sandra Nakato</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case UGA-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Social Media Data Breach</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="uganda-case-001-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Samuel Mugisha</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case UGA-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Phone Tracking by Government
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="uganda-case-002-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <!-- Nigeria Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Chukwudi Okonkwo</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case NGA-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Illegal Phone Tapping by
                            Government</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="nigeria-case-001-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Aisha Ibrahim</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case NGA-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Medical Records Leak by Hospital
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="nigeria-case-002-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            David Adekunle</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case NGA-003</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Financial Data Breach by Bank
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="nigeria-case-003-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Chinwe Okafor</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case NGA-004</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Email Hacking Incident</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="nigeria-case-004-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            Olumide Adeyemi</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Case NGA-005</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Surveillance Cameras Installed
                            Illegally</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="nigeria-case-005-video" class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- End Table --}}
</div>
