<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\PrivacyCasesModel;
new class extends Component {
    public $caseName;
    public $caseTitle;
    public $caseNumber;
    public $caseLink;
    public $privacyCases;

    #[On('case-deleted')]
    public function mount()
    {
        $this->privacyCases = $this->getPrivacyViolationCases();
    }
    public function resetFields()
    {
        return $this->reset('caseName', 'caseTitle', 'caseNumber', 'caseLink');
    }
    public function saveFormData()
    {
        $validatedData = $this->validate([
            'caseName' => 'required|string|max:255',
            'caseTitle' => 'required|string|max:255',
            'caseNumber' => 'required|string|max:255',
            'caseLink' => 'required|url',
        ]);
        PrivacyCasesModel::create([
            'casename' => $validatedData['caseName'],
            'casetitle' => $validatedData['caseTitle'],
            'casenumber' => $validatedData['caseNumber'],
            'caselink' => $validatedData['caseLink'],
        ]);

        $this->dispatch('case-created');
        $this->resetFields();
    }
    public function getPrivacyViolationCases()
    {
        return PrivacyCasesModel::orderBy('created_at', 'desc')->get();
    }
    public function deletePrivacyCase(PrivacyCasesModel $privacyCase)
    {
        $privacyCase->delete();
        $this->dispatch('case-deleted');
    }
}; ?>

<div>
    <div class="w-full transition-all duration-300 shadow-xl ease x-auto hover:shadow-none">
        <form wire:submit.prevent="saveFormData" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="caseName">
                    Case Name
                </label>
                <input wire:model="caseName"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="caseName" type="text" placeholder="Enter Case Name">
                @error('caseName')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="caseTitle">
                    Case Title
                </label>
                <input wire:model="caseTitle"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="caseTitle" type="text" placeholder="Enter Case Title">
                @error('caseTitle')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="caseNumber">
                    Case Number
                </label>
                <input wire:model="caseNumber"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="caseNumber" type="text" placeholder="Enter Case Number">
                @error('caseNumber')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="caseLink">
                    Case Url Link
                </label>
                <input wire:model="caseLink"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="caseLink" type="text"
                    placeholder="https://www.youtube.com/watch?v=D0UnqGm_miA&pp=ygULZHVtbXkgdmlkZW8%3D">
                @error('caseLink')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
    <div class="bg-white shadow-2xl hover:shadow-none">
        <div class="flex flex-row rounded-t-lg bg-[#1C4863] text-white">
            <!-- Header Row -->
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Name</div>
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Case No.</div>
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Title</div>
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Link</div>
        </div>
        @foreach ($privacyCases as $privacyCase)
            <div class="flex flex-row bg-white rounded-b-lg">
                <!-- Data Row -->
                <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                    style="flex-basis: 25%;">
                    {{ $privacyCase->casename }}
                </div>
                <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                    style="flex-basis: 25%;">
                    {{ $privacyCase->casenumber }}
                </div>
                <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                    style="flex-basis: 25%;">
                    {{ $privacyCase->casetitle }}
                </div>
                <div class="flex items-center justify-center flex-none sm:p-1 md:p-4" style="flex-basis: 25%;">
                    <a target="_blank" href="{{ $privacyCase->caselink }}"
                        class="inline-block rounded-full bg-gray-900 text-white shadow-lg hover:bg-[#C8000B] focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-75 sm:px-2 sm:py-2 sm:text-xs md:px-6 md:py-2">
                        Watch
                    </a>
                    <a wire:click.prevent="deletePrivacyCase('{{ $privacyCase->id }}')" href="#"
                        class="ml-2 inline-block sm:px-2 sm:py-2 sm:text-xs md:px-6 md:py-2 hover:text-[#C8000B]">
                        <span class="material-icons-sharp">
                            delete_forever
                        </span>
                    </a>
                </div>
            </div>
            <div class="flex-grow border-b border-gray-300">
            </div>
        @endforeach
    </div>
</div>
