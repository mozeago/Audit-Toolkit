<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Information;
use App\Models\Question;
use App\Models\Recommendation;
new class extends Component {
    public Collection $informationText;
    public Collection $questions;
    public $relatedInformationId = '';
    public $recommendationText = '';
    public $questionResponse = '';
    public $question_id = '';
    public function mount()
    {
        $this->getInformationText();
    }
    public function rules()
    {
        return [
            'relatedInformationId' => 'required|uuid|min:36',
            'recommendationText' => 'required|string|min:20',
            'questionResponse' => 'required|in:true,false',
            'question_id' => 'required|uuid|min:36',
        ];
    }
    public function store()
    {
        $validatedData = $this->validate();
        $recommendation = Recommendation::create([
            'content' => $validatedData['recommendationText'],
            'information_id' => $validatedData['relatedInformationId'],
            'question_response' => $validatedData['questionResponse'],
            'question_id' => $validatedData['question_id'],
        ]);
        $this->dispatch('recommendation-created');
        $this->clearFiedls();
    }
    public function clearFiedls()
    {
        $this->recommendationText = '';
        $this->relatedInformationId = '';
        $this->questionResponse = '';
        $this->question_idaa = '';
    }
    public function getInformationText()
    {
        $this->informationText = Information::orderBy('created_at', 'desc')->get();
        $this->questions = Question::orderBy('created_at', 'desc')->get();
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
                <label for="question_id"
                    class="block mb-2 font-bold text-gray-700">{{ __('Question For the Recommendation') }}:</label>
                <select wire:model.defer="question_id" id="question_id"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:ring-w-1">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->text }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center mt-4 mb-8 space-x-4">
                <label for="relatedInformationId"
                    class="block mb-2 font-bold text-gray-700">{{ __('Recommendation For') }}:</label>
                <label for="answer-yes" class="flex items-center space-x-2">
                    <input id="answer-yes" type="radio" name="answer" wire:model="questionResponse" value="true"
                        class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                    <span class="text-sm font-medium text-gray-700">Yes</span>
                </label>
                <label for="answer-no" class="flex items-center space-x-2">
                    <input id="answer-no" type="radio" name="answer" wire:model="questionResponse" value="false"
                        class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                    <span class="text-sm font-medium text-gray-700">No</span>
                </label>
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
