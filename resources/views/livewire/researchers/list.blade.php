<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public $yellowColumContributors;
    public $blueColumContributors;
    public $greenColumContributors;
    public function mount(): void
    {
        $this->yellowColumContributors = $this->fetchContributors(1);
        $this->blueColumContributors = $this->fetchContributors(2);
        $this->greenColumContributors = $this->fetchContributors(3);
    }
    public function fetchContributors($portion = 1)
    {
        $totalUsers = DB::table('research_contributors')->count();
        $oneThird = ceil($totalUsers / 3);
        $offset = ($portion - 1) * $oneThird;
        return DB::table('research_contributors')->offset($offset)->limit($oneThird)->get();
    }
}; ?>

<div class="p-4 mx-auto text-center bg-white rounded-md shadow-xl hover:shadow-none">
    <h2 class="mt-4 mb-4 text-2xl font-bold text-black">IGNITE Program <span class="text-red-700">Researchers</span></h2>
    <p class="text-lg font-semibold text-black">Meet Our IGNITE Cohort 1 Graduates (i| DPO)</p>

    <div class="flex justify-center mt-8 mb-4 ">
        <div class="flex-auto max-w-xs mr-4 bg-gray-200 rounded-sm md:max-w-md">
            <div class="flex flex-col justify-between max-w-sm bg-white rounded-lg shadow-lg">
                <!-- Title Row -->
                <div class="px-6 py-4 text-xl font-bold text-white bg-[#F97316] rounded-t-lg">
                    Ignite Cohort 1
                </div>
                <div class="flex-grow px-6 py-4">
                    <!-- List of Names -->
                    <ul class="list-none">
                        @foreach ($yellowColumContributors as $contributor)
                            <li class="flex items-center mb-2">
                                <svg class="w-6 h-6 mr-2 text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="text-gray-700">{{ $contributor->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Footer Row -->
                <div class="px-6 py-4 text-xl font-bold text-white bg-[#F97316] rounded-b-lg">
                    Graduates
                </div>
            </div>
        </div>
        <div class="flex-auto max-w-xs mr-4 bg-gray-200 rounded-sm md:max-w-md">
            <div class="flex flex-col justify-between max-w-sm bg-white rounded-lg shadow-lg">
                <!-- Title Row -->
                <div class="px-6 py-4 text-xl font-bold text-white bg-[#459BBA] rounded-t-lg">
                    Ignite Cohort 1
                </div>
                <div class="flex-grow px-6 py-4">
                    <!-- List of Names -->
                    <ul class="list-none">
                        @foreach ($blueColumContributors as $contributor)
                            <li class="flex items-center mb-2">
                                <svg class="w-6 h-6 mr-2 text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="text-gray-700">{{ $contributor->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Footer Row -->
                <div class="px-6 py-4 text-xl font-bold text-white bg-[#459BBA] rounded-b-lg">
                    Graduates
                </div>
            </div>
        </div>
        <div class="flex-auto max-w-xs bg-gray-200 rounded-sm md:max-w-md">
            <div class="flex flex-col justify-between max-w-sm bg-white rounded-lg shadow-lg">
                <!-- Title Row -->
                <div class="px-6 py-4 text-xl font-bold text-white bg-[#78A87F] rounded-t-lg">
                    Ignite Cohort 1
                </div>
                <div class="flex-grow px-6 py-4">
                    <!-- List of Names -->
                    <ul class="list-none">
                        @foreach ($blueColumContributors as $contributor)
                            <li class="flex items-center mb-2">
                                <svg class="w-6 h-6 mr-2 text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="text-gray-700">{{ $contributor->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Footer Row -->
                <div class="px-6 py-4 text-xl font-bold text-white bg-[#78A87F] rounded-b-lg">
                    Graduates
                </div>
            </div>
        </div>
    </div>
</div>
