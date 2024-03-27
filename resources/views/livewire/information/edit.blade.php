<?php
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use App\Models\Question;
use App\Models\Information;
use Livewire\Attributes\Validate;

new class extends Component {
    public Information $information;
    public Collection $questions;
    public string $infoContent = '';
    public string $questionId = '';
    public function mount()
    {
        $this->infoContent = $this->information->content;
        $this->questionId = $this->information->question_id;
        $this->fetchQuestions();
    }
    public function rules()
    {
        return [
            'infoContent' => 'required|min:20',
            'questionId' => 'required|uuid|min:36',
        ];
    }
    public function cancel()
    {
        $this->dispatch('information-edit-cancelled');
    }
    public function fetchQuestions()
    {
        $this->questions = Question::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $this->validate();
        $this->information->update([
            'content' => $this->infoContent,
            'question_id' => $this->questionId,
        ]);
        $this->dispatch('information-updated');
    }
}; ?>
<div class="flex">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col space-y-4">
                <div class="flex border border-gray-300 rounded-md shadow-sm">
                    <textarea wire:model="infoContent" type="text"
                        class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-l-md"
                        placeholder="{{ __('Quesion Information Text') }}" value="{{ $information->content }}"></textarea>
                </div>
                <div class="border border-gray-300 rounded-md shadow-sm">
                    <select wire:model="questionId" class="block w-full p-3 rounded-md focus:outline-none">

                        <option value="" disabled selected>{{ __('Select...') }}</option>
                        @foreach ($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->text }}</option>
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
