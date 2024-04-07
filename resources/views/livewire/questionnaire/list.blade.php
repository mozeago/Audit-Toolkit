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
    public $organization;
    public $department;
    public $answeredQuestionsCount = 0;
    public $totalQuestionsCount = 0;
    public $showOrganizationForm = true;
    public $hasAnsweredQuestionnaire = true;
    public function mount()
    {
        $this->answeredQuestionsCount = UserResponse::where('user_id', auth()->id())->count();
        $this->totalQuestionsCount = Question::count();
        $this->hasAnsweredQuestions();
        $this->fetchQuestions();
    }
    public function hasAnsweredQuestions()
    {
        if ($this->totalQuestionsCount > 0) {
            if ($this->answeredQuestionsCount >= 0 && $this->answeredQuestionsCount !== $this->totalQuestionsCount) {
                return true;
            }
        }
    }
    public function openQuestionnaire()
    {
        $this->validate([
            'organization' => 'required|min:3',
            'department' => 'required|min:2',
        ]);
        $this->showOrganizationForm = false;
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
        // Check if user has provided an answer before proceeding
        if (!isset($this->userAnswers[$this->currentQuestionIndex]['answer'])) {
            $this->addError('answer', 'Please select an answer before proceeding.');
            return;
        }
        // Prepare user answer data (only if answer exists)
        if (isset($this->userAnswers[$this->currentQuestionIndex])) {
            $userAnswer = $this->userAnswers[$this->currentQuestionIndex];
            $userAnswer['user_id'] = auth()->id();
            $userAnswer['question_id'] = $this->questions[$this->currentQuestionIndex]->id;
            $userAnswer['organization'] = $this->organization;
            $userAnswer['department'] = $this->department;
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
        // Check if a response already exists for the current question
        $existingResponse = UserResponse::where('user_id', $userAnswer['user_id'])
            ->where('question_id', $userAnswer['question_id'])
            ->first();

        if ($existingResponse) {
            // Update the existing response
            $existingResponse->answer = $userAnswer['answer'];
            $existingResponse->save();
        } else {
            // Create a new response
            $userResponse = new UserResponse();
            $userResponse->user_id = $userAnswer['user_id'];
            $userResponse->question_id = $userAnswer['question_id'];
            $userResponse->answer = $userAnswer['answer'];
            $userResponse->organization = $userAnswer['organization'];
            $userResponse->department = $userAnswer['department'];
            $userResponse->save();
        }
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
            $userAnswer['organization'] = $this->organization;
            $userAnswer['department'] = $this->department;

            // Save user response to database
            $this->saveUserResponse($userAnswer);
            return redirect('dashboard');
        }
    }
}; ?>
<div>
    @if ($this->hasAnsweredQuestions())
        <div class="container px-4 py-8 mx-auto">
            @if ($showOrganizationForm)
                <div class="mb-4">
                    <h2 class="mb-4 text-2xl font-semibold">Organization and Department Information</h2>
                    <form wire:submit.prevent="openQuestionnaire">
                        <div class="mb-4">
                            <label for="organization" class="block mb-1 text-gray-700">Organization</label>
                            <input id="organization" type="text" wire:model.defer="organization"
                                class="w-full px-4 py-2 border rounded-md" value="{{ $this->organization }}">
                            @error('organization')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="department" class="block mb-1 text-gray-700">Department</label>
                            <input id="department" type="text" wire:model.defer="department"
                                class="w-full px-4 py-2 border rounded-md" value="{{ $this->department }}">
                            @error('department')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-primary-button type="submit" class="btn btn-primary">Next</x-primary-button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Progress Indicator -->
                <div class="mb-4">
                    <div class="h-4 bg-gray-200 rounded-lg">
                        <div class="h-full bg-green-500 rounded-lg"
                            style="width: {{ (($currentQuestionIndex + 1) / count($questions)) * 100 }}%"></div>
                    </div>
                    <div class="mt-1 text-xs text-gray-600">{{ $currentQuestionIndex + 1 }} of {{ count($questions) }}
                        questions
                        answered</div>
                </div>
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
                                <div class="flex items-center w-full mt-4 mb-8 space-x-4">
                                    <label for="answer-yes" class="flex items-center w-full space-x-2">
                                        <input id="answer-yes" type="radio" name="answer"
                                            wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer"
                                            value="true"
                                            class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                                        <span class="text-sm font-medium text-gray-700">Yes</span>
                                    </label>
                                    <label for="answer-no" class="flex items-center w-full space-x-2">
                                        <input id="answer-no" type="radio" name="answer"
                                            wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer"
                                            value="false"
                                            class="w-6 h-6 bg-gray-200 border-gray-300 rounded-full focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 checked:bg-indigo-500 checked:border-transparent">
                                        <span class="text-sm font-medium text-gray-700">No</span>
                                    </label>
                                    @error('answer')
                                        <span class="mt-2 text-red-500 text-l">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="w-full text-center">
                                <svg class="w-24 h-24 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="mt-4 text-lg text-gray-500">No questions available.</p>
                            </div>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="7"
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                <span>{{ __('Next') }}</span>
                            </div>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <strong class="font-bold">Info:</strong>
            <span class="block sm:inline">Thank you ! You have already taken the questionnaire.</span>
        </div>
    @endif
</div>
