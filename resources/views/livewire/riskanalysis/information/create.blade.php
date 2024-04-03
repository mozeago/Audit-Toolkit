<?php

use Livewire\Volt\Component;
use App\Models\RiskInformation;
use App\Models\RiskSubSection;

new class extends Component {
    public string $message = '';
    public $riskSubSections = [];
    public $rikSubSectionId = '';
    public $riskInformationText = '';
    public function mount()
    {
        $this->riskSubSections = RiskSubSection::orderBy('created_at', 'desc')->get();
    }
    public function rules(): array
    {
        return [
            'riskInformationText' => 'required|string|min:20',
            'rikSubSectionId' => 'required|uuid|max:36',
        ];
    }
    public function store(): void
    {
        $validatedData = $this->validate();
        $riskInformation = RiskInformation::create([
            'text' => $validatedData['riskInformationText'],
            'risk_sub_section_id' => $validatedData['rikSubSectionId'],
        ]);

        $this->message = 'information Saved!';
        $this->dispatch('risk-information-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        return $this->reset('riskInformationText', 'rikSubSectionId', 'message');
    }
}; ?>

<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="flex flex-col w-full">
                <label for="riskInformationText"
                    class="mb-2 text-sm font-semibold">{{ __('Risk Information Text:') }}</label>
                <textarea placeholder="{{ __('Risk Information Text') }}" wire:model="riskInformationText" id="riskInformationText"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500"></textarea>
                @error('riskInformationText')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col w-full mt-4">
                <label for="rikSubSectionId"
                    class="mb-2 text-sm font-semibold">{{ __('Risk Sub-Section Name') }}</label>
                <select wire:model="rikSubSectionId" id="rikSubSectionId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($riskSubSections as $riskSubSection)
                        <option value="{{ $riskSubSection->id }}">{{ $riskSubSection->text }}</option>
                    @endforeach
                </select>
                @error('rikSubSectionId')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <x-primary-button
                class="inline-flex items-center px-4 py-2 mt-4 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">{{ __('Save') }}</x-primary-button>
        </form>
        @if ($message)
            <div class="mt-2 text-green-500">{{ $message }}</div>
        @endif
    </div>
</div>
