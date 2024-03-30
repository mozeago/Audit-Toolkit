<?php

use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\Question;
use App\Models\Information;
new class extends Component {
    public $currentQuestionIndex = 0;
    public $userAnswers = [];
    public $userAnswer = [];
    public $questions;
    public function mount()
    {
        $this->fetchQuestions();
    }

    private function getUserResponse(int $questionId): ?string
    {
        return UserResponse::where('user_id', auth()->id())->where('question_id', $questionId)->value('answer');
    }

    public function rules()
    {
        return [
            'userAnswers.*.answer' => 'required',
            'userAnswers.*.user_id' => 'required',
            'userAnswers.*.question_id' => 'required',
        ];
    }
    public function fetchQuestions()
    {
        $this->questions = Question::with('hasOneInformation')->get();
    }

    public function nextQuestion()
    {
        // Prepare user answer data (only if answer exists)
        if (isset($this->userAnswers[$this->currentQuestionIndex])) {
            $userAnswer = $this->userAnswers[$this->currentQuestionIndex];
            $userAnswer['user_id'] = auth()->id();
            $userAnswer['question_id'] = $this->questions[$this->currentQuestionIndex]->id;

            // Save user response to database
            $this->saveUserResponse($userAnswer);
        }
        // Increment question index
        $this->currentQuestionIndex++;

        // Clear error messages after validation and saving
        $this->resetValidation();
    }

    private function saveUserResponse($userAnswer)
    {
        $userResponse = new UserResponse();
        $userResponse->user_id = $userAnswer['user_id'];
        $userResponse->question_id = $userAnswer['question_id'];
        $userResponse->answer = $userAnswer['answer'];
        $userResponse->updateOrCreate(['question_id' => $userAnswer['question_id']], $userAnswer);
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }
    public function submitAnswers()
    {
        if (isset($this->userAnswers[$this->currentQuestionIndex])) {
            $userAnswer = $this->userAnswers[$this->currentQuestionIndex];
            $userAnswer['user_id'] = auth()->id();
            $userAnswer['question_id'] = $this->questions[$this->currentQuestionIndex]->id;

            // Save user response to database
            $this->saveUserResponse($userAnswer);
        }
    }
}; ?>

<div>
    <div class="container px-4 py-8 mx-auto">
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex flex-col md:flex-row md:space-x-4">
                <button wire:click="previousQuestion" class="btn btn-outline-secondary disabled:opacity-50"
                    :disabled="$currentQuestionIndex === 0" {{ $currentQuestionIndex > 0 ? '' : 'hidden' }}>
                    <div class="flex flex-col items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="5"
                                d="M15 19l-7-7 7-7-1.41-1.41L6 12l8.41 8.41z"></path>
                        </svg>
                        <span>{{ __('Previous') }}</span>
                    </div>
                </button>
            </div>

            <div class="w-full p-6 bg-white rounded-lg shadow-md md:w-3/4">
                @if (count($questions) > 0)
                    <h2 class="mb-4 text-2xl font-semibold">Question {{ $currentQuestionIndex + 1 }} of
                        {{ count($questions) }}</h2>
                    <p class="mb-8 text-lg leading-loose">{{ $questions[$currentQuestionIndex]->text }}</p>
                    <div class="flex items-center mt-4 space-x-4">
                        <div class="flex items-center mt-4 mb-8 space-x-4">
                            <label for="answer-yes" class="flex items-center space-x-2">
                                <input id="answer-yes" type="radio" name="answer"
                                    wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer" value="true"
                                    class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                                <span class="text-sm font-medium text-gray-700">Yes</span>
                            </label>
                            <label for="answer-no" class="flex items-center space-x-2">
                                <input id="answer-no" type="radio" name="answer"
                                    wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer" value="false"
                                    class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                                <span class="text-sm font-medium text-gray-700">No</span>
                            </label>
                        </div>
                    </div>
                @else
                    <p>No questions here to answer !</p>
                @endif
                <div class="w-full p-4 mt-12 border border-t border-gray-200 rounded-lg shadow-md bg-gray-50">
                    <div class="prose max-w-none">
                        @if ($questions[$currentQuestionIndex]->hasOneInformation)
                            {{ $questions[$currentQuestionIndex]->hasOneInformation->content }}
                        @else
                            <p>No related information available for this question.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-4 md:flex-row md:space-x-4">
                <button wire:click="submitAnswers"
                    class="btn btn-success disabled:opacity-50 {{ !($currentQuestionIndex == count($questions) - 1) ? 'hidden' : '' }}"
                    :disabled="count($userAnswers) !== count($questions)">
                    <span>{{ __('Submit Answers') }}</span>
                </button>
                <button wire:click="nextQuestion"
                    class="btn btn-primary {{ $currentQuestionIndex == count($questions) - 1 ? 'hidden' : '' }}"
                    :disabled="$currentQuestionIndex == count($questions) - 1">
                    <div class="flex flex-col items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="7" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span>{{ __('Next') }}</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
