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
            <div class="absolute bottom-0 left-0 w-full text-white bg-green-500">
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
                        controller/processor:
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
    <div class="flex justify-center mt-16">
        <table class="w-full bg-white border border-gray-300 divide-y divide-gray-200 rounded-md shadow-md table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Case
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
                <!-- Dummy Data -->
                <tr class="transition-colors duration-300 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">Adwoa Amponsah</td>
                    <td class="px-6 py-4 whitespace-nowrap">Case 12345</td>
                    <td class="px-6 py-4 whitespace-nowrap">The Murder of Kwame Nkrumah</td>
                    <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                            class="text-blue-500 hover:text-blue-700">Link 1</a></td>
                </tr>
                <tr class="transition-colors duration-300 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">Chinonso Eze</td>
                    <td class="px-6 py-4 whitespace-nowrap">Case 67890</td>
                    <td class="px-6 py-4 whitespace-nowrap">Fraudulent Activities in Lagos</td>
                    <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                            class="text-blue-500 hover:text-blue-700">Link 2</a></td>
                </tr>
                <!-- Adding Kenyan Cases -->
                <tr class="transition-colors duration-300 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">Wanjiku Kimani</td>
                    <td class="px-6 py-4 whitespace-nowrap">Case 24680</td>
                    <td class="px-6 py-4 whitespace-nowrap">Corruption Allegations in Nairobi</td>
                    <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                            class="text-blue-500 hover:text-blue-700">Link 3</a></td>
                </tr>
                <tr class="transition-colors duration-300 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">Omondi Odhiambo</td>
                    <td class="px-6 py-4 whitespace-nowrap">Case 35791</td>
                    <td class="px-6 py-4 whitespace-nowrap">Land Dispute in Kisumu</td>
                    <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                            class="text-blue-500 hover:text-blue-700">Link 4</a></td>
                </tr>
                <!-- Adding more dummy data -->
                <tr class="transition-colors duration-300 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">Naledi Mabena</td>
                    <td class="px-6 py-4 whitespace-nowrap">Case 98765</td>
                    <td class="px-6 py-4 whitespace-nowrap">Poaching Crisis in Kruger National Park</td>
                    <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                            class="text-blue-500 hover:text-blue-700">Link 5</a></td>
                </tr>
                <!-- Adding more dummy data -->
                <tr class="transition-colors duration-300 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">Tariro Moyo</td>
                    <td class="px-6 py-4 whitespace-nowrap">Case 15937</td>
                    <td class="px-6 py-4 whitespace-nowrap">Human Rights Violation in Zimbabwe</td>
                    <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                            class="text-blue-500 hover:text-blue-700">Link 6</a></td>
                </tr>
            </tbody>
        </table>
    </div>


    {{-- End Table --}}
</div>
