<?php

use Livewire\Volt\Component;
use App\Models\RiskRecommendation;
use App\Models\RiskInformation;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public RiskRecommendation $riskRecommendation;
    public Collection $riskInformationText;
    public string $riskRecommendationText = '';
    public string $riskInformationId = '';
    public string $message = '';
    public $recommendationFor = '';
    public function mount()
    {
        $this->riskRecommendationText = $this->riskRecommendation->text;
        $this->riskInformationId = $this->riskRecommendation->risk_information_id;
        $this->recommendationFor = $this->riskRecommendation->question_response;
        $this->getRiskRecommendationText();
    }
    public function getRiskRecommendationText()
    {
        $this->riskInformationText = RiskInformation::orderBy('created_at', 'desc')->get();
    }
    public function rules()
    {
        return [
            'riskRecommendationText' => 'required|min:20',
            'riskInformationId' => 'required|uuid|min:36',
            'recommendationFor' => 'required|in:true,false',
        ];
    }
    public function update()
    {
        $this->validate();
        $this->riskRecommendation->update([
            'text' => $this->riskRecommendationText,
            'risk_information_id' => $this->riskInformationId,
            'question_response' => $this->recommendationFor,
        ]);
        $this->dispatch('risk-recommendation-updated');
    }
    public function cancel()
    {
        $this->dispatch('risk-recommendation-cancelled');
    }
}; ?>

<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col w-full">
                <label for="riskRecommendationText"
                    class="mb-2 text-sm font-semibold">{{ __('Risk Recommendation Text:') }}</label>
                <textarea placeholder="{{ __('Risk Recommendation Text') }}" wire:model="riskRecommendationText"
                    id="riskRecommendationText" type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500"></textarea>
                @error('riskRecommendationText')
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
                        class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                    <span class="text-sm font-medium text-gray-700">No</span>
                </label>
            </div>
            <div class="flex flex-col w-full mt-4">
                <label for="riskInformationId"
                    class="mb-2 text-sm font-semibold">{{ __('Risk Information Text') }}</label>
                <select wire:model="riskInformationId" id="riskInformationId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($riskInformationText as $riskInfo)
                        <option value="{{ $riskInfo->id }}">{{ $riskInfo->text }}</option>
                    @endforeach
                </select>
                @error('riskInformationId')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-start space-x-4">
                <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                <button wire:click.prevent="cancel" type="button"
                    class="btn btn-secondary">{{ __('Cancel') }}</button>
            </div>
        </form>
        @if ($message)
            <div class="mt-2 text-green-500">{{ $message }}</div>
        @endif
    </div>
</div>
