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
    <div class="flex justify-center gap-8">
        <div class="relative flex flex-col w-1/4 p-4 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-3xl text-center">Privacy Score</h2>
            <div class="flex flex-col justify-center flex-grow">
                <div class="text-center">Meter Gauge</div>
            </div>
            <div
                class="absolute bottom-0 left-0 w-full @if ($riskScore >= 70) text-white bg-green-700
                @elseif($riskScore >= 50)text-white bg-green-500
                @elseif($riskScore >= 30) text-white bg-yellow-700
                @else text-white bg-red-700 @endif">
                <p class="text-xl font-bold text-center" id="gaugeValue">Average Score:</p>
                <p class="text-xl font-extrabold text-center">{{ $riskScore }}%</p>

                <p class="text-center text-l">
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
        <div class="flex flex-col w-3/4 gap-2">

            <div class="flex gap-2">
                <div class="w-1/2 h-32 bg-green-200">
                    <h6 class="mt-2 font-semibold text-center text-l">Type of processing activity conducted by
                        controller/processor: %
                    </h6>
                </div>
                <div class="w-1/2 h-32 bg-red-300">
                    <h6 class="mt-2 font-semibold text-center text-l">Type of personal data processed by the
                        organisation: %</h6>
                </div>
            </div>
            <div class="flex gap-2">
                <div class="w-1/2 h-32 bg-gray-200">
                    <h6 class="mt-2 font-semibold text-center text-l">Processing of sensitive personal data:%</h6>
                </div>
                <div class="w-1/2 h-32 bg-orange-300">
                    <h6 class="mt-2 font-semibold text-center text-l">Commercial use of data: %</h6>
                </div>
            </div>
            <div class="flex gap-2">
                <div class="w-1/2 h-32 bg-pink-500">
                    <h6 class="mt-2 font-semibold text-center text-l">Business Operation: %</h6>
                </div>
                <div class="w-1/2 h-32 bg-gray-300">
                    <h6 class="mt-2 font-semibold text-center text-l">OnBoarding Category: %</h6>
                </div>
            </div>
            <div class="flex gap-2">
                <div
                    class="w-1/2 h-32
                    @if ($auditScore >= 70) text-white bg-green-700
                    @elseif($auditScore >= 50)text-white bg-green-500
                    @elseif($auditScore >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif">
                    <h6 class="mt-2 font-semibold text-center text-l">Audit Score: {{ $auditScore }} %</h6>
                </div>
                <div
                    class="w-1/2 h-32
                    @if ($riskValue >= 70) text-white bg-green-700
                    @elseif($riskValue >= 50)text-white bg-green-500
                    @elseif($riskValue >= 30) text-white bg-yellow-700
                    @else text-white bg-red-700 @endif">
                    <h6 class="mt-2 font-semibold text-center text-l">Risk Score: {{ $riskValue }} %</h6>
                </div>
            </div>
        </div>
    </div>
    {{-- Table --}}
    <div class="w-full mt-16">
        <h2 class="text-xl font-bold text-center">Privacy Violation Cases</h2>
    </div>
    <div class="flex justify-center mt-4">
        <div class="flex justify-center">
            <table
                class="w-full bg-white border border-gray-300 divide-y divide-gray-200 rounded-md shadow-md table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Case
                            No.
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Video
                            Title</th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Link
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Kenya Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Jane Njeri</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case KEN-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">Data Breach by Banking Institution</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="kenya-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">James Otieno</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case KEN-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">Health Records Leak by Hospital</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="kenya-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <!-- Rwanda Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Emmanuel Habimana</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case RWA-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">Government Surveillance Program Exposed</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="rwanda-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Lilian Uwamahoro</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case RWA-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">Employer Spying on Employees</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="rwanda-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <!-- Uganda Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Sandra Nakato</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case UGA-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">Social Media Data Breach</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="uganda-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Samuel Mugisha</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case UGA-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">Phone Tracking by Government</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="uganda-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <!-- Nigeria Privacy Violation Cases -->
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Chukwudi Okonkwo</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case NGA-001</td>
                        <td class="px-6 py-4 whitespace-nowrap">Illegal Phone Tapping by Government</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="nigeria-case-001-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Aisha Ibrahim</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case NGA-002</td>
                        <td class="px-6 py-4 whitespace-nowrap">Medical Records Leak by Hospital</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="nigeria-case-002-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">David Adekunle</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case NGA-003</td>
                        <td class="px-6 py-4 whitespace-nowrap">Financial Data Breach by Bank</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="nigeria-case-003-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Chinwe Okafor</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case NGA-004</td>
                        <td class="px-6 py-4 whitespace-nowrap">Email Hacking Incident</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="nigeria-case-004-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                    <tr class="transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">Olumide Adeyemi</td>
                        <td class="px-6 py-4 whitespace-nowrap">Case NGA-005</td>
                        <td class="px-6 py-4 whitespace-nowrap">Surveillance Cameras Installed Illegally</td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="nigeria-case-005-video"
                                class="text-blue-500 hover:text-blue-700">Watch Video</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- End Table --}}
</div>
