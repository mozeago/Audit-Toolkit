<?php
use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
new class extends Component {
    public $riskScore;
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
        $data = DB::table('risk_analysis_responses AS rar')
            ->select(DB::raw('count(*) as total_count'), DB::raw('sum(answer = true) as true_count'))
            ->join('risk_sub_sections AS rss', 'rar.risk_sub_section_id', '=', 'rss.id')
            ->where(strtolower(trim('rss.subtitle')), '=', strtolower(trim($riskProfileCategory)))
            ->where('rar.answer', true)
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
}; ?>
<div>
    <div class="flex justify-center gap-8">
        <div
            class="relative flex h-80 w-1/4 flex-col rounded-lg bg-gray-300 p-4 shadow-2xl">
            <h2 class="text-center text-3xl">Privacy Score
            </h2>
            <div
                class="flex flex-grow flex-col justify-center">
                <div class="text-center">Meter Gauge</div>
            </div>
            <div
                class="@if ($riskScore >= 70) text-white bg-green-700
                @elseif($riskScore >= 50)text-white bg-green-500
                @elseif($riskScore >= 30) text-white bg-yellow-700
                @else text-white bg-red-700 @endif absolute bottom-0 left-0 w-full">
                <p class="text-center text-xl font-bold"
                    id="gaugeValue">Average Score:</p>
                <p
                    class="text-center text-xl font-extrabold">
                    {{ $riskScore }}%</p>

                <p class="text-l text-center">
                    @if ($riskScore >= 75)
                        Low Risk
                    @elseif($riskScore >= 50)
                        Moderate Risk
                    @else
                        High Risk
                    @endif
                </p>
            </div>
        </div>
        <div class="flex w-3/4 flex-col gap-2">

            <div class="flex gap-2">
                <div
                    class="@if ($processorController >= 70) text-white bg-green-700
                    @elseif($processorController >= 50)text-white bg-green-500
                    @elseif($processorController >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl">
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Type of processing activity
                        conducted by
                        controller/processor:
                    </h6>
                    <p class="mt-4 text-center font-bold">
                        {{ $processorController }} %</p>
                </div>
                <div
                    class="@if ($personalDataProcessedByOrganisation >= 70) text-white bg-green-700
                    @elseif($personalDataProcessedByOrganisation >= 50)text-white bg-green-500
                    @elseif($personalDataProcessedByOrganisation >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl">
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Type of personal data processed by
                        the
                        organisation:</h6>
                    <p class="mt-4 text-center font-bold">
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
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Processing of sensitive personal
                        data:</h6>
                    <p class="mt-4 text-center font-bold">
                        {{ $sensitivePersonalData }} %</p>
                </div>
                <div
                    class="@if ($commercialUseOfData >= 70) text-white bg-green-700
                    @elseif($commercialUseOfData >= 50)text-white bg-green-500
                    @elseif($commercialUseOfData >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2 rounded-md shadow-2xl">
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Commercial use of data:</h6>
                    <p class="mt-4 text-center font-bold">
                        {{ $commercialUseOfData }} %</p>
                </div>
            </div>
            <div class="flex gap-2">
                <div
                    class="@if ($businessOperation >= 70) text-white bg-green-700
                    @elseif($businessOperation >= 50)text-white bg-green-500
                    @elseif($businessOperation >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-full rounded-md shadow-2xl">
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Business Operation:</h6>
                    <p class="mt-4 text-center font-bold">
                        {{ $businessOperation }} %</p>
                </div>
            </div>
            <div class="flex gap-2">
                <div
                    class="@if ($auditScore >= 70) text-white bg-green-700
                    @elseif($auditScore >= 50)text-white bg-green-500
                    @elseif($auditScore >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2">
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Audit Score:</h6>
                    <p class="mt-4 text-center font-bold">
                        {{ $auditScore }} %</p>
                </div>
                <div
                    class="@if ($riskValue >= 70) text-white bg-green-700
                    @elseif($riskValue >= 50)text-white bg-green-500
                    @elseif($riskValue >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif h-32 w-1/2">
                    <h6
                        class="text-l mt-2 text-center font-semibold">
                        Risk Score:</h6>
                    <p class="mt-4 text-center font-bold">
                        {{ $riskValue }} %</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Table --}}
    <div class="mt-16 w-full">
        <h2 class="text-center text-xl font-bold">Privacy
            Violation Cases</h2>
    </div>
    <div class="mt-4 flex justify-center">
        <div class="flex justify-center">
            <table
                class="w-full table-auto divide-y divide-gray-200 rounded-md border border-gray-300 bg-white shadow-2xl">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-700">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-700">
                            Case
                            No.
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-700">
                            Video
                            Title</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-700">
                            Link
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Kenya Privacy Violation Cases -->
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Jane Njeri</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case KEN-001</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Data Breach by Banking
                            Institution</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="kenya-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            James Otieno</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case KEN-002</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Health Records Leak by Hospital
                        </td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="kenya-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <!-- Rwanda Privacy Violation Cases -->
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Emmanuel Habimana</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case RWA-001</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Government Surveillance Program
                            Exposed</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="rwanda-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Lilian Uwamahoro</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case RWA-002</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Employer Spying on Employees
                        </td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="rwanda-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <!-- Uganda Privacy Violation Cases -->
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Sandra Nakato</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case UGA-001</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Social Media Data Breach</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="uganda-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Samuel Mugisha</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case UGA-002</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Phone Tracking by Government
                        </td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="uganda-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <!-- Nigeria Privacy Violation Cases -->
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Chukwudi Okonkwo</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case NGA-001</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Illegal Phone Tapping by
                            Government</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="nigeria-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Aisha Ibrahim</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case NGA-002</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Medical Records Leak by Hospital
                        </td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="nigeria-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            David Adekunle</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case NGA-003</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Financial Data Breach by Bank
                        </td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="nigeria-case-003-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Chinwe Okafor</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case NGA-004</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Email Hacking Incident</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="nigeria-case-004-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                    <tr
                        class="transition-colors duration-300 hover:bg-gray-100">
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Olumide Adeyemi</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Case NGA-005</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            Surveillance Cameras Installed
                            Illegally</td>
                        <td
                            class="whitespace-nowrap px-6 py-4">
                            <a href="nigeria-case-005-video"
                                class="text-blue-500 hover:text-blue-700">Watch
                                Video</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- End Table --}}
</div>
