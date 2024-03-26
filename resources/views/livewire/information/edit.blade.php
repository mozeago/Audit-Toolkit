<?php

use Livewire\Volt\Component;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Collection $questions;
    public Information $questionInformation;
    public $text = '';
    public $question_id = '';
    public function mount()
    {
        $this->fetchQuestions();
    }
    public function fetchQuestions()
    {
        $this->questions = Question::orderBy('created_at', 'desc')->get();
    }
    public function cancel()
    {
        $this->editing = null;
        $this->dispatch('information-edit-cancelled');
    }
}; ?>

<div>
    <form wire:submit.prevent="update">
        <div class="flex flex-col space-y-4">
            <div class="flex border border-gray-300 rounded-md shadow-sm">
                <textarea wire:model="text" type="text" value=""
                    class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-l-md"
                    placeholder="{{ __('Question Info. content') }}"></textarea>
            </div>
            <div class="border border-gray-300 rounded-md shadow-sm">
                <select wire:model="question_id"
                    class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    {{-- @foreach ($controls as $control)
                        <option value="{{ $control->id }}">{{ $control->name }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>
        <x-primary-button type="submit"
            class="px-4 py-2 mt-4 text-white bg-blue-500 rounded shadow hover:bg-blue-700">{{ __('Update') }}</x-primary-button>
        <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
    </form>
</div>
