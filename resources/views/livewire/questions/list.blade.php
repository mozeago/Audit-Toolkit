<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Question;
use Livewire\Attributes\On;
new class extends Component {
    public Collection $questions;
    public ?Question $editing = null;
    public function mount()
    {
        $this->getQuestions();
    }
    #[On('question-created')]
    public function getQuestions()
    {
        $this->questions = Question::orderBy('created_at', 'desc')->get();
    }
    public function edit(Question $question)
    {
        $this->editing = $question;
        $this->getQuestions();
    }
    #[On('question-updated')]
    #[On('question-update-cancelled')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getQuestions();
    }
    public function delete(Question $question)
    {
        $question->delete();
        $this->getQuestions();
    }
}; ?>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        @if (count($questions) > 0)
            <table class="w-full min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                            Question
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr class="hover:bg-gray-100">
                            <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                                @if ($question->is($editing))
                                    <livewire:questions.edit :question="$question" :key="$question->id" />
                                @else
                                    {{ $question->text }}
                                @endif
                            </td>
                            <td
                                class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                                <button wire:click.prevent="edit('{{ $question->id }}')" type="button"
                                    class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </button>
                                <button wire:click.prevent="delete('{{ $question->id }}')" type="button"
                                    class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
