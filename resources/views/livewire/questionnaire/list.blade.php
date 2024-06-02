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
            if ($this->answeredQuestionsCount >= 0) {
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
        $attemptNumber =
            UserResponse::where('user_id', $userAnswer['user_id'])
                ->where('question_id', $userAnswer['question_id'])
                ->max('attempt_number') + 1;

        $userResponse = new UserResponse();
        $userResponse->user_id = $userAnswer['user_id'];
        $userResponse->question_id = $userAnswer['question_id'];
        $userResponse->answer = $userAnswer['answer'];
        $userResponse->organization = $userAnswer['organization'];
        $userResponse->department = $userAnswer['department'];
        $userResponse->attempt_number = $attemptNumber;
        $userResponse->save();

        $user = User::find($userAnswer['user_id']);
        if ($user) {
            $user->audit_last_question_index = $this->currentQuestionIndex + 1;
            $user->save();
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
    {{-- @if (count($questions) > 0)
        <!-- Progress Indicator -->
        <div class="m-4" x-show=!$showOrganizationForm>
            <div class="h-4 bg-gray-200 rounded-lg">
                <div class="h-full bg-[#C8000B]/40 rounded-lg"
                    style="width: {{ (($currentQuestionIndex + 1) / count($questions)) * 100 }}%"></div>
            </div>
            <div class="mt-1 text-xs text-gray-600">{{ $currentQuestionIndex + 1 }} of
                {{ count($questions) }}
                questions
                answered</div>
        </div>
        <!-- End Progress Indicator -->
        @if ($showOrganizationForm)
            <div class="flex items-start justify-center px-2 m-0 md:items-center lg:min-h-screen">
                <div
                    class="w-full p-8 space-y-4 bg-white border border-gray-200 rounded-lg shadow-md md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <h2 class="font-bold text-gray-800 md:text-center lg:text-center md:text-2xl">Organization Form</h2>
                    <form wire:submit.prevent="openQuestionnaire">
                        <div class="mb-4">
                            <label for="organization-name" class="block text-sm font-medium text-gray-700">Organization
                                Name</label>
                            <input type="text" id="organization-name" wire:model.defer="organization"
                                value="{{ $this->organization }}"
                                class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                                placeholder="Enter organization name">
                            @error('organization')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                            <input type="text" id="department" wire:model.defer="department"
                                class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                                placeholder="Enter department" value="{{ $this->department }}">
                            @error('department')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button type="submit"
                                class="flex items-center px-4 py-2 font-semibold text-white bg-black rounded-md hover:bg-[#C8000B] focus:outline-none">
                                Next
                                <span class="ml-2">
                                    <svg class="w-6 h-6 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </span>
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @else
        <div class="flex items-start justify-center px-2 m-0 md:items-center lg:min-h-screen">
            <div
                class="w-full p-8 space-y-4 bg-white border border-gray-200 rounded-lg shadow-md md:w-1/2 lg:w-1/2 xl:w-1/2">
                <div class="flex items-center p-2">
                    <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="yellow-600">
                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" />
                    </svg>
                    <h1 class="font-semibold text-yellow-600">No questionnaire to attempt yet</p>
                </div>
            </div>
        </div>
    @endif --}}
    <div class="relative overflow-hidden bg-white rounded-lg shadow-md">
        <svg class="absolute z-10 top-2 left-2" xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24"
            width="48px" fill="#C8000B">
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path d="M22 6h-3v9H6v3h12l4 4V6zm-5 7V2H2v15l4-4h11z" />
        </svg>
        <div class="ml-20">
            <div class="flex flex-col items-start p-2">
                <h3 class="mb-2 text-lg font-semibold">Questionnaire Title</h3>
                <p class="text-base gray-600 text-">Text about the questionnaire goes here. This can be a brief
                    description
                    or instructions for the user.</p>
            </div>
        </div>
    </div>

</div>
