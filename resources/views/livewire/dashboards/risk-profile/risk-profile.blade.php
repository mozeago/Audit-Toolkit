<?php

use Livewire\Volt\Component;

new class extends Component {
    public $data = [];

    public function mount()
    {
        $this->data = [
            'Labels' => ['Excellent', 'Good', 'Needs Improvement'],
            'Values' => [30, 50, 20],
            'tableData' => [
                [
                    'Name' => 'John Doe',
                    'Email' => 'john.doe@example.com',
                    'Organization' => 'Acme Inc.',
                    'Department' => 'Marketing',
                    'Score' => 85, // Adjust score values
                ],
                [
                    'Name' => 'Jane Smith',
                    'Email' => 'jane.smith@example.com',
                    'Organization' => 'Renovations R Us',
                    'Department' => 'Sales',
                    'Score' => 60, // Adjust score values
                ],
            ],
        ];
    }
}; ?>
<div>
    <h1>Risk Profile Dashboard</h1>
    <canvas id="pieChart"></canvas>

    <div class="mt-4">
        <table class="table-auto w-full">
            <thead>
                <tr>
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
                        <td class="px-4 py-2">{{ $row['Name'] }}</td>
                        <td class="px-4 py-2">{{ $row['Email'] }}</td>
                        <td class="px-4 py-2">{{ $row['Organization'] }}</td>
                        <td class="px-4 py-2">{{ $row['Department'] }}</td>
                        <td class="px-4 py-2">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full
                                @if ($row['Score'] >= 80) bg-green-500 text-white
                                @elseif ($row['Score'] >= 60)
                                    bg-orange-500 text-white
                                @else
                                    bg-red-500 text-white @endif
                            ">
                                {{ $row['Score'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('scripts')
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($data['Labels']),
                datasets: [{
                    label: 'Score Distribution',
                    data: @json($data['Values']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {}
        });
    </script>
@endpush
