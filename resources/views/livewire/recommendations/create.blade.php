<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Information;
use App\Models\Recommendation;
new class extends Component {
    public Collection $informationText;
    public $relatedInformationId = '';
    public $recommendationText = '';
    public function mount()
    {
        $this->getInformationText();
    }
    public function rules()
    {
        return [
            'relatedInformationId' => 'required|uuid|min:36',
            'recommendationText' => 'required|string|min:20',
        ];
    }
    public function store()
    {
        $validatedData = $this->validate();
        $recommendation = Recommendation::create([
            'content' => $validatedData['recommendationText'],
            'information_id' => $validatedData['relatedInformationId'],
        ]);
        $this->dispatch('recommendation-created');
    }
    public function getInformationText()
    {
        $this->informationText = Information::orderBy('created_at', 'desc')->get();
    }
}; ?>

<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="recommendationText"
                    class="block mb-2 font-bold text-gray-700">{{ __('Recommendation Text:') }}</label>
                <textarea wire:model.defer="recommendationText" type="text" id="recommendationText"
                    placeholder="{{ __('Question Recommendation Text') }}"
                    class="w-full h-32 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="relatedInformationId"
                    class="block mb-2 font-bold text-gray-700">{{ __('Information related to Recommendation') }}:</label>
                <select wire:model.defer="relatedInformationId" id="relatedInformationId"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:ring-w-1">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($informationText as $text)
                        <option value="{{ $text->id }}">{{ $text->content }}</option>
                    @endforeach
                </select>
            </div>

            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</div>
