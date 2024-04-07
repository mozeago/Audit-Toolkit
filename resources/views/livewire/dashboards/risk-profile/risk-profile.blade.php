<?php

use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\User;
new class extends Component {
    public $data = [];
    public $chartColors = [];

    public function mount()
    {
        $this->data = [
            'Labels' => ['Poor', 'Average', 'Good', 'Excellent'], // Updated labels
            'Values' => [0, 0, 0, 0], // Initialize all values to 0
            'tableData' => $this->getUserAnswers(),
        ];
        // Calculate the distribution of scores
        foreach ($this->data['tableData'] as $row) {
            if ($row['score'] < 50) {
                $this->data['Values'][0]++; // Poor
            } elseif ($row['score'] < 60) {
                $this->data['Values'][1]++; // Average
            } elseif ($row['score'] < 80) {
                $this->data['Values'][2]++; // Good
            } else {
                $this->data['Values'][3]++; // Excellent
            }
        }

        $this->chartColors = ['#FF5733', '#FFA500', '#BAB86C', '#22C55E'];
    }
    public function getUserAnswers()
    {
        $groupedAnswers = User::select('users.name', 'users.email', 'user_responses.organization', 'user_responses.department')
            ->leftJoin('user_responses', 'users.id', '=', 'user_responses.user_id')
            ->groupBy('users.id', 'users.name', 'users.email', 'user_responses.organization', 'user_responses.department')
            ->havingRaw('count(user_responses.id) > 0') // This line ensures users with data
            ->selectRaw('sum(case when user_responses.answer = \'false\' then 1 else 0 end) as false_count')
            ->selectRaw('sum(case when user_responses.answer = \'true\' then 1 else 0 end) as true_count')
            ->selectRaw('round( (sum(case when user_responses.answer = \'true\' then 1 else 0 end) / count(*)) * 100) as score')
            ->get();

        return $groupedAnswers->toArray();
    }
}; ?>
<div>
    <h1 class="py-4 text-3xl font-bold text-center text-gray-800">
        Risk Profile Score
    </h1>

    <!-- Add canvas element for the pie chart -->
    <div style="display: flex;">
        <canvas id="pieChart" width="250" height="250"></canvas>
    </div>

    <div class="mt-4">
        <table class="table w-full overflow-hidden rounded-lg shadow-md">
            <thead>
                <tr class="font-medium text-left text-white bg-gray-500">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Organization</th>
                    <th class="px-4 py-2">Department</th>
                    <th class="px-4 py-2">Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['tableData'] as $row)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['name'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['email'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['organization'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['department'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs">
                                {{ $row['score'] }}
                                @if ($row['score'] >= 70)
                                    <span class="ml-2 bg-green-500 text-white rounded-full px-1.5 py-0.5">Good</span>
                                @elseif ($row['score'] >= 40)
                                    <span
                                        class="ml-2 bg-orange-500 text-white rounded-full px-1.5 py-0.5">Average</span>
                                @else
                                    <span class="ml-2 bg-red-500 text-white rounded-full px-1.5 py-0.5">Poor</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($data['Labels']);
    const values = @json($data['Values']);
    const chartColors = @json($chartColors);

    const canvas = document.getElementById('pieChart');
    const ctx = canvas.getContext('2d');

    const ratio = window.devicePixelRatio; // Adjust for retina displays
    canvas.width = 250 * ratio;
    canvas.height = 250 * ratio;
    canvas.style.width = '250px';
    canvas.style.height = '250px';
    ctx.scale(ratio, ratio);

    const chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Score Distribution',
                data: values,
                backgroundColor: chartColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex,
                            array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return currentValue + ' (' + percentage + '%)';
                    }
                }
            }
        }
    });
</script>
