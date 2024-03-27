<?php

use Livewire\Volt\Component;
use App\Models\Question;
use App\Models\Information;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Collection $questions;
    public $questionInformation = '';
    public $questionId = '';
    public function rules()
    {
        return [
            'questionInformation' => 'required|string|min:20',
            'questionId' => 'required|uuid|min:36',
        ];
    }
    public function mount()
    {
        $this->fetchQuestions();
    }
    public function fetchQuestions()
    {
        return $this->questions = Question::orderBy('created_at', 'desc')->get();
    }
    public function store()
    {
        $validatedData = $this->validate();
        $questionInfo = Information::create([
            'content' => $validatedData['questionInformation'],
            'question_id' => $validatedData['questionId'],
        ]);
        $this->dispatch('question-information-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->reset('questionId', 'questionInformation');
    }
}; ?>

<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="questionInformation" class="block mb-2 font-bold text-gray-700">Information Text:</label>
                <textarea wire:model.defer="questionInformation" type="text" id="questionInformation"
                    placeholder="{{ __('Information Text') }}"
                    class="w-full h-32 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="questionId" class="block mb-2 font-bold text-gray-700">{{ __('Question') }}:</label>
                <select wire:model.defer="questionId" id="questionId"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:ring-w-1">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->text }}</option>
                    @endforeach
                </select>
            </div>

            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</div>
