<?php

use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\Question;
use App\Models\Information;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
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
        $this->currentQuestionIndex = auth()->user()->audit_last_question_index ?? 0;
        $this->answeredQuestionsCount = UserResponse::where('user_id', auth()->id())->count();
        if ($this->answeredQuestionsCount <= 0) {
            $this->answeredQuestionsCount = RiskAnalysisResponse::where('user_id', auth()->id())->count();
        }
        $this->totalQuestionsCount = Question::count();
        $this->hasAnsweredQuestions();
        $this->fetchQuestions();
    }
    public function hasAnsweredQuestions()
    {
        if ($this->totalQuestionsCount > 0) {
            if ($this->answeredQuestionsCount >= 0 && $this->answeredQuestionsCount !== $this->totalQuestionsCount) {
                $companyDetails = null;
                if ($this->answeredQuestionsCount > 0) {
                    $companyDetails = RiskAnalysisResponse::where('user_id', auth()->id())->first();
                }
                if ($companyDetails == null) {
                    $companyDetails = UserResponse::where('user_id', auth()->id())->first();
                }
                if ($companyDetails) {
                    $this->organization = $companyDetails->organization;
                    $this->department = $companyDetails->department;
                    $this->showOrganizationForm = false;
                }
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
            $user = User::find($userAnswer['user_id']);
            if ($user) {
                $user->audit_last_question_index = $this->currentQuestionIndex + 1;
                $user->save();
            }
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
            $user = User::find($userAnswer['user_id']);
            if ($user) {
                $user->audit_last_question_index = null;
                $user->save();
            }
            return redirect('dashboard');
        }
    }
}; ?>
<div x-data="{ infOpen: false }">
    @if ($this->hasAnsweredQuestions())
        <div class ="container px-4 py-8 mx-auto">
            @if ($showOrganizationForm)
                <div class="max-w-2xl p-4 mx-auto sm:p-6 lg:p-8">
                    <div
                        class="mb-4 flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.9] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#C8000B] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#C8000B]">

                        <div
                            class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#C8000B]/10 sm:size-16">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <g fill="#C8000B">
                                    <path
                                        d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z" />
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3 sm:pt-5">
                            <h2 class="mb-4 text-xl font-semibold text-black">Organization and Department Information
                            </h2>

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
                                <x-primary-button type="submit" class="btn btn-primary">Next<span><svg
                                            class="size-6 shrink-0 self-center stroke-[#C8000B]"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                        </svg></span>
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Progress Indicator -->
                    <div class="mb-4">
                        <div class="h-4 bg-gray-200 rounded-lg">
                            <div class="h-full bg-[#C8000B]/40 rounded-lg"
                                style="width: {{ (($currentQuestionIndex + 1) / count($questions)) * 100 }}%"></div>
                        </div>
                        <div class="mt-1 text-xs text-gray-600">{{ $currentQuestionIndex + 1 }} of
                            {{ count($questions) }}
                            questions
                            answered</div>
                    </div>
                    <div class="flex flex-col w-full md:flex-row md:space-x-4">
                        {{-- questions --}}
                        @if (count($questions) > 0)
                            <div
                                class="w-full flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-[#C8000B]/[0.05] transition duration-300 hover:text-black/70 hover:ring-[#C8000B]/20 focus:outline-none focus-visible:ring-[#C8000B] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#C8000B]">
                                <div
                                    class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#C8000B] sm:size-16 text-white p-1">
                                    <p><strong>{{ $currentQuestionIndex + 1 }}/{{ count($questions) }}</strong></p>
                                </div>
                                {{-- Previous --}}
                                <svg wire:click="previousQuestion" class="size-6 shrink-0 self-center stroke-[#C8000B]"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                                </svg>
                                {{-- end Previous --}}
                                <div class="w-full pt-3 sm:pt-5">
                                    {{-- <h2 class="w-full text-xl font-semibold text-[#C8000B] ">Question
                                        {{ $currentQuestionIndex + 1 }} of
                                        {{ count($questions) }}</h2> --}}

                                    <p class="w-full mt-4 text-lg/relaxed">
                                        {{ $questions[$currentQuestionIndex]->text }}
                                    </p>
                                    <div class="flex items-center w-full mt-4 space-x-4">
                                        <div class="flex items-center w-full mt-4 mb-8 space-x-4">
                                            <label for="answer-yes" class="flex items-center w-full space-x-2 ">
                                                <input id="answer-yes" type="radio" name="answer"
                                                    wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer"
                                                    value="true" class="w-6 h-6 ">
                                                <span class="text-sm font-medium text-gray-700">Yes</span>
                                            </label>
                                            <label for="answer-no" class="flex items-center w-full space-x-2">
                                                <input id="answer-no" type="radio" name="answer"
                                                    wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer"
                                                    value="false" class="w-6 h-6 ">
                                                <span class="text-sm font-medium text-gray-700">No</span>
                                            </label>
                                            @error('answer')
                                                <span class="mt-2 text-red-500 text-l">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- start more info --}}
                                    <div
                                        class="w-full p-4 mt-12 border border-t border-gray-200 rounded-lg shadow-md bg-gray-50">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-lg font-medium">More information about the question</h2>
                                            <button @click="infOpen = !infOpen" class="ml-4 focus:outline-none">
                                                <svg :class="{ 'rotate-180': infOpen }"
                                                    class="w-6 h-6 text-gray-500 transition-transform transform"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-show="infOpen" class="mt-4 prose max-w-none">
                                            <p>
                                                @if ($questions[$currentQuestionIndex]->hasOneInformation)
                                                    {{ $questions[$currentQuestionIndex]->hasOneInformation->content }}
                                                @else
                                                    No related information available for this question.
                                                @endif
                                            </p>
                                            <!-- Add more content here -->
                                        </div>
                                    </div>
                                    {{-- end more info --}}
                                </div>
                                {{-- next --}}
                                <svg wire:click="nextQuestion" class="size-6 shrink-0 self-center stroke-[#C8000B]"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                                {{-- end next --}}
                            </div>
                            {{-- end questions --}}
                        @else
                            <div class="w-full text-center">
                                <svg wire:click="nextQuestion" class="w-24 h-24 mx-auto text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="mt-4 text-lg text-gray-500">No questions available.</p>
                            </div>
                        @endif
                    </div>
            @endif
        </div>
    @else
        <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <strong class="font-bold">Info:</strong>
            <span class="block sm:inline">Thank you ! You have already taken the<strong> Audit</strong>
                questionnaire.</span>
        </div>
    @endif
</div>
@push('styles')
    <style>
        input[type="radio"]:checked {
            background-color: #C8000B;
            border-color: transparent;
        }
    </style>
@endpush
