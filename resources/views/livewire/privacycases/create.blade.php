<?php

use Livewire\Volt\Component;
use App\Models\PrivacyCasesModel;
new class extends Component {
    public $caseName;
    public $caseTitle;
    public $caseNumber;
    public $caseLink;
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
}; ?>

<div class="w-full transition-all duration-300 shadow-xl  ease x-auto hover:shadow-none">
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
