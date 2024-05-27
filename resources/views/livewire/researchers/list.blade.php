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

<div class="mx-auto text-center">
    <h2 class="mt-4 mb-4 text-3xl font-bold text-black">IGNITE Program <span class="text-red-700">Researchers</span></h2>
    <p class="font-semibold text-black">Meet Our IGNITE Cohort 1 Graduates (i| DPO)</p>

    <div class="flex justify-center mt-8 mb-4 ">
        <div class="flex-auto max-w-xs mx-2 bg-gray-200 rounded-sm md:max-w-md">
            <!-- Content for first column -->
            <div class="px-4 py-2 mb-4 text-white bg-[#EEA726] rounded-t-sm">
                <h3 class="text-lg font-bold">Ignite Cohort 1 Graduates</h3>
            </div>
            <div class="flex-auto bg-gray-200">
                <ul class="p-4 shadow-md">
                    @foreach ($yellowColumContributors as $contributor)
                        <li class="flex items-center py-2">
                            {{-- <div
                                class="flex items-center justify-center w-8 h-8 mr-3 font-bold text-white bg-blue-500 rounded-full">
                            </div> --}}
                            <span class="text-gray-800">{{ $contributor->name }}</span>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="px-4 py-2 mt-auto text-white bg-[#EEA726] rounded-b-lg">
                <h3 class="text-lg font-bold">Get Started</h3>
            </div>
        </div>
        <div class="flex-auto max-w-xs mx-2 bg-gray-200 rounded-sm md:max-w-md">
            <!-- Content for second column -->
            <div class="px-4 py-2 mb-4 text-white bg-[#459BBA] rounded-t-sm">
                <h3 class="text-lg font-bold">Ignite Cohort 1 Graduates</h3>
            </div>
            <div class="flex-auto bg-gray-200">
                <ul class="p-4 shadow-md">
                    @foreach ($blueColumContributors as $contributor)
                        <li class="flex items-center py-2">
                            {{-- <div
                                class="flex items-center justify-center w-8 h-8 mr-3 font-bold text-white bg-blue-500 rounded-full">
                            </div> --}}
                            <span class="text-gray-800">{{ $contributor->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="px-4 py-2 mt-auto text-white bg-[#459BBA] rounded-b-lg">
                <h3 class="text-lg font-bold">Get Started</h3>
            </div>
        </div>
        <div class="flex-auto max-w-xs mx-2 bg-gray-200 rounded-sm md:max-w-md">
            <!-- Content for Third column -->
            <div class="px-4 py-2 mb-4 text-white bg-[#78A87F] rounded-t-sm">
                <h3 class="text-lg font-bold">Ignite Cohort 1 Graduates</h3>
            </div>
            <div class="flex-auto bg-gray-200">
                <ul class="p-4 shadow-md">
                    @foreach ($greenColumContributors as $contributor)
                        <li class="flex items-center py-2">
                            {{-- <div
                                class="flex items-center justify-center w-8 h-8 mr-3 font-bold text-white bg-blue-500 rounded-full">
                            </div> --}}
                            <span class="text-gray-800">{{ $contributor->name }}</span>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="px-4 py-2 mt-auto text-white bg-[#78A87F] rounded-b-lg">
                <h3 class="text-lg font-bold">Get Started</h3>
            </div>
        </div>
    </div>
</div>
