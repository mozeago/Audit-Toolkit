<?php

use Livewire\Volt\Component;

new class extends Component {
    public $data = [];
    public $chartColors = [];

    public function mount()
    {
        $this->data = [
            'Labels' => ['Poor', 'Average', 'Good', 'Excellent'], // Updated labels
            'Values' => [0, 0, 0, 0], // Initialize all values to 0
            'tableData' => [
                [
                    'Name' => 'John Doe',
                    'Email' => 'john.doe@example.com',
                    'Organization' => 'ABC Corporation',
                    'Department' => 'Marketing',
                    'Score' => 85,
                ],
                [
                    'Name' => 'Jane Smith',
                    'Email' => 'jane.smith@example.com',
                    'Organization' => 'XYZ Inc.',
                    'Department' => 'Human Resources',
                    'Score' => 60,
                ],
                [
                    'Name' => 'Michael Johnson',
                    'Email' => 'michael.johnson@example.com',
                    'Organization' => 'LMN Enterprises',
                    'Department' => 'Finance',
                    'Score' => 52,
                ],
                [
                    'Name' => 'Emily Brown',
                    'Email' => 'emily.brown@example.com',
                    'Organization' => 'PQR Ltd.',
                    'Department' => 'Information Technology',
                    'Score' => 98,
                ],
                [
                    'Name' => 'David Wilson',
                    'Email' => 'david.wilson@example.com',
                    'Organization' => 'XYZ Inc.',
                    'Department' => 'Sales',
                    'Score' => 75,
                ],
                [
                    'Name' => 'Sarah Martinez',
                    'Email' => 'sarah.martinez@example.com',
                    'Organization' => 'ABC Corporation',
                    'Department' => 'Human Resources',
                    'Score' => 45,
                ],
                [
                    'Name' => 'James Taylor',
                    'Email' => 'james.taylor@example.com',
                    'Organization' => 'PQR Ltd.',
                    'Department' => 'Finance',
                    'Score' => 80,
                ],
                [
                    'Name' => 'Jessica Miller',
                    'Email' => 'jessica.miller@example.com',
                    'Organization' => 'XYZ Inc.',
                    'Department' => 'Marketing',
                    'Score' => 65,
                ],
                [
                    'Name' => 'Robert Davis',
                    'Email' => 'robert.davis@example.com',
                    'Organization' => 'LMN Enterprises',
                    'Department' => 'Information Technology',
                    'Score' => 70,
                ],
                [
                    'Name' => 'Amanda Garcia',
                    'Email' => 'amanda.garcia@example.com',
                    'Organization' => 'ABC Corporation',
                    'Department' => 'Sales',
                    'Score' => 88,
                ],
                [
                    'Name' => 'Christopher Rodriguez',
                    'Email' => 'christopher.rodriguez@example.com',
                    'Organization' => 'PQR Ltd.',
                    'Department' => 'Human Resources',
                    'Score' => 55,
                ],
            ],
        ];

        // Calculate the distribution of scores
        foreach ($this->data['tableData'] as $row) {
            if ($row['Score'] < 60) {
                $this->data['Values'][0]++; // Poor
            } elseif ($row['Score'] < 80) {
                $this->data['Values'][1]++; // Average
            } elseif ($row['Score'] < 90) {
                $this->data['Values'][2]++; // Good
            } else {
                $this->data['Values'][3]++; // Excellent
            }
        }

        $this->chartColors = ['#FF6384', '#22C55E', '#FCD34D', '#4BC0C0'];
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
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['Name'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['Email'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['Organization'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $row['Department'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs">
                                {{ $row['Score'] }}
                                @if ($row['Score'] >= 80)
                                    <span class="ml-2 bg-green-500 text-white rounded-full px-1.5 py-0.5">Good</span>
                                @elseif ($row['Score'] >= 60)
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
