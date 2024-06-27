<?php

use Livewire\Volt\Component;
use App\Models\RiskRecommendation;
use App\Models\RiskSubSection;

new class extends Component {
    public string $message = '';
    public $riskSubsection = [];
    public $text = '';
    public $riskSubsectionId = '';
    public $recommendationFor = '';
    public function mount()
    {
        $this->riskSubsection = RiskSubSection::orderBy('created_at', 'desc')->get();
    }
    public function rules(): array
    {
        return [
            'text' => 'required|string|min:20',
            'riskSubsectionId' => 'required|uuid|max:36',
            'recommendationFor' => 'required|in:true,false',
        ];
    }
    public function store(): void
    {
        $validatedData = $this->validate();
        $riskRecommendation = RiskRecommendation::create([
            'text' => $validatedData['text'],
            'risk_sub_section_id' => $validatedData['riskSubsectionId'],
            'question_response' => $validatedData['recommendationFor'],
        ]);

        $this->message = 'Recommendation Saved!';
        $this->dispatch('risk-recommendation-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        return $this->reset('text', 'riskSubsectionId', 'message');
    }
}; ?>

<div class="flex w-full rounded-md shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="flex flex-col w-full">
                <label for="text" class="mb-2 text-sm font-semibold">{{ __('Risk Recommendation Text:') }}</label>
                <textarea placeholder="{{ __('Risk Recommendation Text') }}" wire:model="text" id="text" type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500"></textarea>
                @error('text')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center mt-4 mb-8 space-x-4">
                <label for="recommendationFor"
                    class="block mb-2 font-bold text-gray-700">{{ __('Recommendation For') }}:</label>
                <label for="answer-yes" class="flex items-center space-x-2">
                    <input id="answer-yes" type="radio" name="answer" wire:model="recommendationFor" value="true"
                        class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                    <span class="text-sm font-medium text-gray-700">Yes</span>
                </label>
                <label for="answer-no" class="flex items-center space-x-2">
                    <input id="answer-no" type="radio" name="answer" wire:model="recommendationFor" value="false"
                        class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-[#C8000B] checked:bg-[#C8000B] checked:border-transparent">
                    <span class="text-sm font-medium text-gray-700">No</span>
                </label>
            </div>
            <div class="flex flex-col w-full mt-4">
                <label for="riskSubsectionId" class="mb-2 text-sm font-semibold">{{ __('Risk Question Text') }}</label>
                <select wire:model="riskSubsectionId" id="riskSubsectionId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-[#C8000B]">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($riskSubsection as $riskSubsect)
                        <option value="{{ $riskSubsect->id }}">{{ $riskSubsect->text }}</option>
                    @endforeach
                </select>
                @error('riskSubsectionId')
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
