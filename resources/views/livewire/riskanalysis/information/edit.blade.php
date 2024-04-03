<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use App\Models\RiskSubSection;
use App\Models\RiskInformation;
new class extends Component {
    public Collection $riskSubSections;
    public RiskInformation $riskInfo;
    public string $text = '';
    public string $risk_sub_section_id = '';
    public function rules(): array
    {
        return [
            'text' => 'required|string|min:20',
            'risk_sub_section_id' => 'required|uuid|max:36',
        ];
    }
    public function mount(): void
    {
        $this->text = $this->riskInfo->text;
        $this->risk_sub_section_id = $this->riskInfo->risk_sub_section_id;
        $this->fetchRiskSubSections();

        session()->forget('message');
    }
    public function fetchRiskSubSections()
    {
        $this->riskSubSections = RiskSubSection::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $this->validate();
        $this->riskInfo->update([
            'text' => $this->text,
            'risk_sub_section_id' => $this->risk_sub_section_id,
        ]);

        session()->flash('message', 'Risk Information updated!');

        $this->dispatch('risk-information-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('risk-information-edit-canceled');
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
                        placeholder="Risk Information Text" value="{{ $text }}">
                    @error('text')
                        <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-full mb-4">
                    <select wire:model="risk_sub_section_id" id="risk_sub_section_id"
                        class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="" disabled selected>{{ __('Select ...') }}</option>
                        @foreach ($riskSubSections as $riskSubSection)
                            <option value="{{ $riskSubSection->id }}">{{ $riskSubSection->text }}</option>
                        @endforeach
                    </select>
                    @error('risk_sub_section_id')
                        <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-start space-x-4">
                    <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                    <button wire:click="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
                </div>
        </form>
    </div>
</div>
