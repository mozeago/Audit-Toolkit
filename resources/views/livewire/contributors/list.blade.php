<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ResearchContributorsModel;
new class extends Component {
    public $contributors;
    public function mount()
    {
        $this->getContributors();
    }
    #[On('contributor-created')]
    public function getContributors()
    {
        return $this->contributors = ResearchContributorsModel::orderBy('created_at', 'desc')->get();
    }
}; ?>

<div>
    <div class="flex items-center justify-center mt-24 mb-8">
        <div class="flex-grow border-b-4 border-[#1C4863] "></div>
        <span class="px-3 text-xl font-bold text-center">Research Contributors</span>
        <div class="flex-grow border-b-4 border-[#1C4863] "></div>

    </div>
    <div class="flex justify-center mt-4 shadow-2xl">
        <div class="flex justify-center">
            <table class="w-full mb-8 bg-white border border-gray-300 divide-y divide-gray-200 table-auto">
                <thead class="bg-[#1C4863] ">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Role</th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Photo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($contributors as $contributor)
                        <tr class="text-center transition-colors duration-300 hover:bg-gray-100">
                            <td class="px-6 py-4 text-left whitespace-nowrap">
                                {{ $contributor->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $contributor->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $contributor->description }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
