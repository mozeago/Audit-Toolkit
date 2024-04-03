<?php

use Livewire\Volt\Component;
use App\Models\Recommendation;
use App\Models\Information;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Recommendation $recommendation;
    public Collection $informationText;
    public string $recommendationText = '';
    public string $informationId = '';
    public string $recommendationFor = '';
    public function mount()
    {
        $this->recommendationText = $this->recommendation->content;
        $this->informationId = $this->recommendation->information_id;
        $this->getInformationText();
    }
    public function getInformationText()
    {
        $this->informationText = Information::orderBy('created_at', 'desc')->get();
    }
    public function rules()
    {
        return [
            'recommendationText' => 'required|min:20',
            'informationId' => 'required|uuid|min:36',
            'recommendationFor' => 'required|in:true,false',
        ];
    }
    public function update()
    {
        $this->validate();
        $this->recommendation->update([
            'content' => $this->recommendationText,
            'information_id' => $this->informationId,
            'question_response' => $this->recommendationFor,
        ]);
        $this->dispatch('recommendation-updated');
    }
    public function cancel()
    {
        $this->dispatch('recommendation-cancelled');
    }
}; ?>

<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col space-y-4">
                <div class="flex border border-gray-300 rounded-md shadow-sm">
                    <textarea wire:model="recommendationText" type="text"
                        class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-l-md"
                        placeholder="{{ __('Quesion Recommendation Text') }}" value="{{ $recommendation->content }}"></textarea>
                    @error('recommendationText')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center mt-4 mb-8 space-x-4">
                    <label for="recommendationFor"
                        class="block mb-2 font-bold text-gray-700">{{ __('Recommendation For') }}:</label>
                    <label for="answer-yes" class="flex items-center space-x-2">
                        <input id="answer-yes" type="radio" name="answer" wire:model="recommendationFor"
                            value="true"
                            class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                        <span class="text-sm font-medium text-gray-700">Yes</span>
                    </label>
                    <label for="answer-no" class="flex items-center space-x-2">
                        <input id="answer-no" type="radio" name="answer" wire:model="recommendationFor"
                            value="false"
                            class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                        <span class="text-sm font-medium text-gray-700">No</span>
                    </label>
                </div>
                <div class="border border-gray-300 rounded-md shadow-sm">
                    <select wire:model="informationId" class="block w-full p-3 rounded-md focus:outline-none">

                        <option value="" disabled selected>{{ __('Select...') }}</option>
                        @foreach ($informationText as $information)
                            <option value="{{ $information->id }}">{{ $information->content }}</option>
                        @endforeach
                    </select>
                    @error('informationId')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-start space-x-4">
                    <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                    <button wire:click.prevent="cancel" type="button"
                        class="btn btn-secondary">{{ __('Cancel') }}</button>
                </div>
        </form>
    </div>
</div>
