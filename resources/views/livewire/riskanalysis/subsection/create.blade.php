<?php
use Livewire\Volt\Component;
use App\Models\RiskSection;
use App\Models\RiskSubSection;

new class extends Component {
    public string $message = '';
    public $riskSections = [];
    public $rikSectionId = '';
    public $subSectionText = '';
    public $questionTitle = '';
    public function mount()
    {
        $this->riskSections = RiskSection::all();
    }
    public function rules(): array
    {
        return [
            'subSectionText' => 'required|string|min:20',
            'rikSectionId' => 'required|string',
            'questionTitle' => 'required|string',
        ];
    }
    public function store(): void
    {
        $validatedData = $this->validate();
        $riskSubSection = RiskSubSection::create([
            'text' => $validatedData['subSectionText'],
            'risk_section_id' => $validatedData['rikSectionId'],
            'subtitle' => $validatedData['questionTitle'],
        ]);

        $this->message = 'Sub-Section Saved!';
        $this->dispatch('risk-sub-section-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        return $this->reset('subSectionText', 'rikSectionId', 'message', 'questionTitle');
    }
}; ?>
<div>
    <div class="flex">
        <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
            <form wire:submit.prevent="store">
                <div class="flex flex-col w-full">
                    <label for="subSectionText"
                        class="mb-2 text-sm font-semibold">{{ __('Risk Analysis Question Text') }}:</label>
                    <textarea placeholder="{{ __('Risk Analysis Question Text') }}" wire:model="subSectionText" id="subSectionText"
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500"></textarea>
                    @error('subSectionText')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-full mt-4">
                    <label for="rikSectionId"
                        class="mb-2 text-sm font-semibold">{{ __('Risk Analysis Section Name') }}</label>
                    <select wire:model="rikSectionId" id="rikSectionId"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
                        <option value="" disabled selected>Select...</option>
                        @foreach ($riskSections as $riskSection)
                            <option value="{{ $riskSection->id }}">{{ $riskSection->name }}</option>
                        @endforeach
                    </select>
                    @error('rikSectionId')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-full mt-4">
                    <label for="questionTitle" class="mb-2 text-sm font-semibold">{{ __('Question Subtitle') }}:</label>
                    <textarea placeholder="{{ __('Question Subtitle') }}" wire:model="questionTitle" id="questionTitle" type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-[#C8000B]"></textarea>
                    @error('questionTitle')
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
</div>
