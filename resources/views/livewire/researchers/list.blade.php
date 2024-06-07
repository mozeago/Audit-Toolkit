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
        <div class="flex-auto max-w-xs bg-gray-200 rounded-sm md:max-w-md">
            <!-- Content for first column -->
            <div class="px-4 py-2 mb-4 text-white bg-[#EEA726] rounded-t-sm">
                <h3 class="text-lg font-bold">Ignite Cohort 1</h3>
            </div>
            <div class="items-start flex-auto bg-gray-200">
                <ul class="items-start p-4 shadow-md">
                    @foreach ($yellowColumContributors as $contributor)
                        <li class="flex items-start py-2">
                            <span
                                class="flex items-start justify-center flex-shrink-0 w-8 h-8 mr-4 text-white rounded-full">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </span>
                            <span class="text-gray-800">{{ $contributor->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="px-4 py-2 mt-auto text-white bg-[#EEA726] rounded-b-lg">
                <h3 class="text-lg font-bold">Graduates</h3>
            </div>
        </div>
        <div class="flex-auto max-w-xs mx-2 bg-gray-200 rounded-sm md:max-w-md">
            <!-- Content for second column -->
            <div class="px-4 py-2 mb-4 text-white bg-[#459BBA] rounded-t-sm">
                <h3 class="text-lg font-bold">Ignite Cohort 1</h3>
            </div>
            <div class="flex-auto bg-gray-200">
                <ul class="p-4 shadow-md">
                    @foreach ($blueColumContributors as $contributor)
                        <li class="flex items-start py-2">
                            <span
                                class="flex items-center justify-center flex-shrink-0 w-8 h-8 mr-4 text-white rounded-full">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </span>
                            <span class="text-gray-800">{{ $contributor->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="px-4 py-2 mt-auto text-white bg-[#459BBA] rounded-b-lg">
                <h3 class="text-lg font-bold">Graduates</h3>
            </div>
        </div>
        <div class="flex-auto max-w-xs mx-2 bg-gray-200 rounded-sm md:max-w-md">
            <!-- Content for Third column -->
            <div class="px-4 py-2 mb-4 text-white bg-[#78A87F] rounded-t-sm">
                <h3 class="text-lg font-bold">Ignite Cohort 1</h3>
            </div>
            <div class="flex-auto bg-gray-200">
                <ul class="p-4 shadow-md">
                    @foreach ($greenColumContributors as $contributor)
                        <li class="flex items-start py-2">
                            <span
                                class="flex items-center justify-center flex-shrink-0 w-8 h-8 mr-4 text-white rounded-full">
                                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </span>
                            <span class="text-gray-800">{{ $contributor->name }}</span>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="px-4 py-2 mt-auto text-white bg-[#78A87F] rounded-b-lg">
                <h3 class="text-lg font-bold">Graduates</h3>
            </div>
        </div>
    </div>
</div>
