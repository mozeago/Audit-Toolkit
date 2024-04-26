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
        {{-- start individual score divs --}}
        <div class="flex flex-col w-full gap-2">

            <div class="flex gap-2">
                {{-- start processor controller --}}
                <div class="w-1/3 h-32 bg-white border-l-4 border-orange-500 rounded-md shadow-2xl drop-shadow-md">
                    <!-- Icon-->
                    <!-- Text -->
                    <h6 class="mt-2 font-semibold text-center text-l">Type of
                        processing activity
                        conducted by
                        controller/processor:</h6>
                    <div class="flex items-center justify-center h-1/2">
                        <!-- Text here -->
                        <span class="text-lg font-extrabold">{{ $processorController }} %</span>
                    </div>
                </div>
                {{-- end processort controller --}}
                {{-- start personal data --}}
                <div class="w-1/3 h-32 bg-white border-l-2 rounded-md shadow-2xl border-cyan-400">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Type of personal data processed by
                        the
                        organisation:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $personalDataProcessedByOrganisation }}
                        %</p>
                </div>
                {{-- end personal data --}}

                <div class="w-1/3 h-32 bg-white border-l-2 border-red-500 rounded-md shadow-2xl drop-shadow-md">
                    <h6 class="mt-2 font-semibold text-center text-l">
                        Processing of sensitive personal
                        data:</h6>
                    <p class="mt-4 font-bold text-center">
                        {{ $sensitivePersonalData }} %</p>
                </div>
            </div>
            {{-- row for risk score --}}
            <div class="flex gap-2">
                {{-- start privacy score --}}
                <div
                    class="relative flex flex-col w-1/3 p-4 border-2 border-[#C8000B] rounded-lg shadow-2xl drop-shadow-md h-70">
                    <h2 class="text-2xl font-medium text-center">Privacy Score
                    </h2>
                    <div class="flex flex-col justify-center flex-grow">
                        <div class="text-center">Meter Gauge</div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full ">
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
                {{-- end privacy score --}}
                <div class="flex flex-col w-2/3 gap-2">
                    {{-- start row 1 commercial and business operations --}}
                    <div class="flex gap-2">
                        {{-- start comercial --}}
                        <div
                            class="w-1/2 h-32 bg-white border-l-4 rounded-md shadow-2xl drop-shadow-md border-cyan-400">
                            <h6 class="mt-2 font-semibold text-center text-l">
                                Commercial use of data:</h6>
                            <p class="mt-4 font-bold text-center">
                                {{ $commercialUseOfData }} %</p>
                        </div>
                        {{-- start business operations --}}
                        <div
                            class="w-1/2 h-32 bg-white border-l-4 border-green-400 rounded-md shadow-2xl drop-shadow-md">
                            <h6 class="mt-2 font-semibold text-center text-l">
                                Business Operation:</h6>
                            <p class="mt-4 font-bold text-center">
                                {{ $businessOperation }} %</p>
                        </div>
                    </div>
                    {{-- start row 2 risk score --}}
                    <div class="flex gap-2">
                        <div
                            class="w-1/2 h-32 bg-white border-l-2 rounded-md shadow-2xl drop-shadow-md border-cyan-400">
                            <h6 class="mt-2 font-semibold text-center text-l">
                                Audit Score:</h6>
                            <p class="mt-4 font-bold text-center">
                                {{ $auditScore }} %</p>
                        </div>
                        <div class="w-1/2 h-32 bg-white border-l-2 border-red-500 rounded-md shadow-2xl drop-shadow-md">
                            <h6 class="mt-2 font-semibold text-center text-l">
                                Risk Score:</h6>
                            <p class="mt-4 font-bold text-center">
                                {{ $riskValue }} %</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- end of individual score divs --}}
    </div>
    {{-- Table --}}
    <div class="flex items-center justify-center mt-24 mb-8">
        <div class="flex-grow border-b-4 border-[#C8000B]"></div>
        <span class="px-3 text-xl font-bold text-center">Privacy
            Violation Cases</span>
        <div class="flex-grow border-b-4 border-[#C8000B]"></div>

    </div>
    <div class="flex justify-center mt-4 shadow-2xl">
        <div class="flex justify-center">
            <table class="w-full bg-white border border-gray-300 divide-y divide-gray-200 table-auto">
                <thead class="bg-[#1C4863] ">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Case
                            No.
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Video
                            Title</th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
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
                </tbody>
            </table>
        </div>
    </div>

    {{-- End Table --}}
</div>
