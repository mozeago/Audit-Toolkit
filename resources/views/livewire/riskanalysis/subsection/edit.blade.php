<?php

use Livewire\Volt\Component;
use App\Models\RiskSubSection;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use App\Models\RiskSection;
new class extends Component {
    public Collection $riskSections;
    public RiskSubSection $riskSubSection;
    public string $text = '';
    public string $riskSectionId = '';
    public function rules(): array
    {
        return [
            'text' => 'required|string|max:255',
            'riskSectionId' => 'required|max:36',
        ];
    }
    public function mount(): void
    {
        $this->text = $this->riskSubSection->text;
        $this->riskSectionId = $this->riskSubSection->risk_section_id;
        $this->fetchRiskSections();

        session()->forget('message');
    }
    public function fetchRiskSections()
    {
        $this->riskSections = RiskSection::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $validatedData = $this->validate();

        $this->riskSubSection->update([
            'text' => $validatedData['text'],
            'risk_section_id' => $validatedData['riskSectionId'],
        ]);

        session()->flash('message', 'Risk Sub-Section updated!');

        $this->dispatch('risk-sub-section-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('risk-sub-section-edit-canceled');
    }
};
?>

<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col space-y-4">
                <div class="flex border border-gray-300 rounded-md shadow-sm">
                    <input wire:model="text" type="text"
                        class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-l-md"
                        placeholder="Risk Sub-Section Text" value="{{ $riskSubSection->text }}">
                    @error('text')
                        <div class="invalid-feedback error-class">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-full mb-4">
                    <select wire:model="riskSectionId" id="riskSectionId"
                        class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="" disabled selected>{{ __('Select ...') }}</option>
                        @foreach ($riskSections as $riskSection)
                            <option value="{{ $riskSection->id }}">{{ $riskSection->name }}</option>
                        @endforeach
                    </select>
                    @error('riskSectionId')
                        <div class="invalid-feedback error-class">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-start space-x-4">
                    <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                    <button wire:click="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
                </div>
        </form>
    </div>
</div>
