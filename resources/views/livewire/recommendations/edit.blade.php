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
        ];
    }
    public function update()
    {
        $this->validate();
        $this->recommendation->update([
            'content' => $this->recommendationText,
            'information_id' => $this->informationId,
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
                </div>
                <div class="border border-gray-300 rounded-md shadow-sm">
                    <select wire:model="informationId" class="block w-full p-3 rounded-md focus:outline-none">

                        <option value="" disabled selected>{{ __('Select...') }}</option>
                        @foreach ($informationText as $information)
                            <option value="{{ $information->id }}">{{ $information->content }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-start space-x-4">
                    <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                    <button wire:click.prevent="cancel" type="button"
                        class="btn btn-secondary">{{ __('Cancel') }}</button>
                </div>
        </form>
    </div>
</div>
