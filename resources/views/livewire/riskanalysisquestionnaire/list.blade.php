<?php

use Livewire\Volt\Component;
use App\Models\RiskAnalysisResponse;
use App\Models\UserResponse;
use App\Models\RiskSubSection;
use App\MOdels\User;
use Illuminate\Support\Facades\Session;
new class extends Component {
    public $showMenu = false;
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
        $this->currentQuestionIndex = auth()->user()->risk_analysis_last_question_index ?? 0;
        if ($this->answeredQuestionsCount <= 0) {
            $this->answeredQuestionsCount = UserResponse::where('user_id', auth()->id())->count();
        }
        $this->totalQuestionsCount = RiskSubSection::count();
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
        return RiskAnalysisResponse::where('user_id', auth()->id())->where('risk_sub_section_id', $questionId)->value('answer');
    }

    public function rules()
    {
        return [
            'userAnswers.*.answer' => 'required',
            'userAnswers.*.user_id' => 'required',
            'userAnswers.*.risk_sub_section_id' => 'required',
        ];
    }
    public function fetchQuestions()
    {
        $this->questions = RiskSubSection::with('hasManyRiskInformation')->get();
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
            $userAnswer['risk_sub_section_id'] = $this->questions[$this->currentQuestionIndex]->id;
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
            RiskAnalysisResponse::where('user_id', $userAnswer['user_id'])
                ->where('risk_sub_section_id', $userAnswer['risk_sub_section_id'])
                ->max('attempt_number') + 1;

        $userResponse = new RiskAnalysisResponse();
        $userResponse->user_id = $userAnswer['user_id'];
        $userResponse->risk_sub_section_id = $userAnswer['risk_sub_section_id'];
        $userResponse->answer = $userAnswer['answer'];
        $userResponse->organization = $userAnswer['organization'];
        $userResponse->department = $userAnswer['department'];
        $userResponse->attempt_number = $attemptNumber;
        $userResponse->save();

        $user = User::find($userAnswer['user_id']);
        if ($user) {
            $user->risk_analysis_last_question_index = $this->currentQuestionIndex + 1;
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
            $userAnswer['risk_sub_section_id'] = $this->questions[$this->currentQuestionIndex]->id;
            $userAnswer['organization'] = $this->organization;
            $userAnswer['department'] = $this->department;
            $this->saveUserResponse($userAnswer);
            $user = User::find($userAnswer['user_id']);
            if ($user) {
                $user->risk_analysis_last_question_index = null;
                $user->qa_analysis_complete = true;
                $user->save();
            }
            return redirect('dashboard');
        }
    }
}; ?>
<div x-data="{ riskOpen: false, onBoardingText: true }">
    <div x-show="onBoardingText" class="relative w-full p-6 bg-white rounded-lg shadow-lg lg:max-w-full">
        <div class="text-center">
            <h2 class="mb-4 text-2xl font-bold text-gray-800 lg:text-3xl">Data Protection Assessment</h2>
            <div class="flex w-full gap-0 mb-4">
                <div class="flex-1 h-1 bg-[#FE6D4B]">
                </div>
                <div class="flex-1 h-1 bg-[#FFCF47]">
                </div>
                <div class="flex-1 h-1 bg-[#2F4167]">
                </div>
                <div class="flex-1 h-1 bg-[#52CFBA]">
                </div>
            </div>
        </div>
        <div class="mb-4 text-start">
            <h3 class="text-lg font-semibold text-gray-600 lg:text-xl">Welcome Onboard!</h3>
        </div>
        <p class="mb-6 text-base leading-relaxed text-gray-700 lg:text-lg">
            We're excited to welcome you onboard! This data-protection toolkit is designed to help organizations of all
            sizes enhance their data protection practices and comply with relevant laws.
        </p>
        <p class="mb-6 text-base leading-relaxed text-gray-700 lg:text-lg">
            Use this assessment to evaluate your adherence to data protection laws and determine the necessary steps to
            maintain the security of individuals' personal data. Upon completing each self-assessment, a report will be
            generated, offering actionable recommendations and guidance to enhance your data protection compliance.
        </p>
        <p class="mb-6 text-base leading-relaxed text-gray-700 lg:text-lg">
            Before you access your dashboard, we ask you to complete the risk questionnaire. This questionnaire is
            designed to assess and mitigate potential risks associated with handling and protecting sensitive data. By
            completing this questionnaire, you are taking proactive steps to safeguard data and protect the privacy
            rights of individuals.
        </p>
        <div class="mb-4 text-start">
            <h3 class="text-lg font-semibold text-gray-600 lg:text-xl">
                Confidentiality and Privacy
            </h3>
        </div>
        <div class="p-4 mb-4 border-l-4 rounded-md border-red-950 bg-rose-100">
            <p class="mb-6 text-base leading-relaxed text-gray-700 lg:text-lg">
                Please note that the information provided in this questionnaire is confidential and will be used for the
                purpose of assessing data protection risks and providing recommendations.
            </p>
        </div>
        <div class="relative flex items-end justify-end mb-2">
            <button @click="onBoardingText = !onBoardingText"
                class="hover:bg-black text-lg px-4 py-2 text-white bg-[#0E9F6E] rounded-full font-semibold custom-shadow focus:outline-none transition-all duration-300">
                Let's begin
            </button>
        </div>
    </div>
    <div x-show="!onBoardingText">
        @if (count($questions) > 0)
            @if ($showOrganizationForm)
                <div class="flex items-start justify-center px-2 m-0 md:items-center lg:min-h-screen">
                    <div
                        class="w-full p-8 space-y-4 bg-white border border-gray-200 rounded-lg shadow-md md:w-1/2 lg:w-1/2 xl:w-1/2">
                        <h2 class="font-bold text-gray-800 md:text-center lg:text-center md:text-2xl">Organization Form
                        </h2>
                        <form wire:submit.prevent="openQuestionnaire">
                            <div class="mb-4">
                                <label for="organization-name"
                                    class="block text-sm font-medium text-gray-700">Organization
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
                                <label for="department"
                                    class="block text-sm font-medium text-gray-700">Department</label>
                                <input type="text" id="department" wire:model.defer="department"
                                    class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                                    placeholder="Enter department" value="{{ $this->department }}">
                                @error('department')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <x-primary-button type="submit"
                                    class="flex items-center px-4 py-2 font-semibold text-white bg-gray-900 rounded-md hover:bg-[#C8000B] focus:outline-none">
                                    Next
                                    <span class="ml-2">
                                        <svg class="w-6 h-6 stroke-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                        </svg>
                                    </span>
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <!-- Progress Indicator -->
                <div class="m-4">
                    <div class="h-4 bg-gray-200 rounded-lg">
                        <div class="h-full bg-[#C8000B]/40 rounded-lg"
                            style="width: {{ (($currentQuestionIndex + 1) / count($questions)) * 100 }}%"></div>
                    </div>
                    <div class="mt-1 text-xs text-gray-600">{{ $currentQuestionIndex + 1 }} of
                        {{ count($questions) }}
                        questions
                        answered</div>
                </div>
                <div class="flex items-start justify-center md:items-center">
                    <div class="relative p-2 overflow-hidden bg-white rounded-lg shadow-xl">
                        <svg class="absolute z-10 top-2 left-2" xmlns="http://www.w3.org/2000/svg" height="48px"
                            viewBox="0 0 24 24" width="48px" fill="#C8000B">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M22 6h-3v9H6v3h12l4 4V6zm-5 7V2H2v15l4-4h11z" />
                        </svg>
                        <div class="p-2 ml-20">
                            <div class="flex flex-col items-start p-2">
                                <h3 class="mb-2 text-lg font-semibold">{{ $questions[$currentQuestionIndex]->subtitle }}
                                </h3>
                                <p class="text-base gray-600 text-">{{ $questions[$currentQuestionIndex]->text }}</p>
                            </div>
                            <div class="flex mt-4 space-x-4">
                                <label for="answer-yes" class="flex items-center w-full space-x-2 ">
                                    <input id="answer-yes" type="radio" name="answer"
                                        wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer" value="true"
                                        class="w-6 h-6 ">
                                    <span class="text-sm font-medium text-gray-700">Yes</span>
                                </label>
                                <label for="answer-no" class="flex items-center w-full space-x-2">
                                    <input id="answer-no" type="radio" name="answer"
                                        wire:model.defer="userAnswers.{{ $currentQuestionIndex }}.answer"
                                        value="false" class="w-6 h-6 ">
                                    <span class="text-sm font-medium text-gray-700">No</span>
                                </label>
                            </div>
                            <!--Error messages ye/no/partial --->
                            <div class="flex mt-4 space-x-4">
                                @error('answer')
                                    <p class="text-base gray-600 text-"><span
                                            class="mt-2 text-red-500 text-l">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div
                                class="w-full p-4 mt-12 border border-t border-gray-200 rounded-lg shadow-md bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-base font-medium">More information about the question
                                    </h2>
                                    <button @click="riskOpen = !riskOpen" class="ml-4 focus:outline-none">
                                        <svg :class="{ 'rotate-180': riskOpen }"
                                            class="w-6 h-6 text-gray-500 transition-transform transform"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <div x-show="riskOpen" class="mt-4 prose max-w-none">
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
                            <!-- Buttons row -->
                            <div class="flex justify-between mt-8 ">
                                <button type="button" wire:click="previousQuestion"
                                    class="flex items-center px-4 py-2 text-white bg-gray-900 rounded-md sm:font-thin md:font-semibold hover:bg-[#C8000B] focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        class="mr-2 md:w-6 md:h-6 sm:w-4 sm:h-4" fill="#FFFFFF">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                                    </svg>
                                    Back
                                </button>
                                <button type="button" wire:click="nextQuestion"
                                    x-show="$wire.currentQuestionIndex < $wire.totalQuestionsCount-1"
                                    class="flex items-center px-4 py-2 text-white bg-gray-900 rounded-md sm:font-thin md:font-semibold hover:bg-[#C8000B] focus:outline-none">
                                    Next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 md:w-6 md:h-6 sm:w-4 sm:h-4"
                                        viewBox="0 0 24 24" fill="#FFFFFF">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8-8-8z" />
                                    </svg>
                                </button>
                                <button type="button" wire:click="submitAnswers"
                                    x-show="$wire.currentQuestionIndex === $wire.totalQuestionsCount - 1"
                                    class="flex items-center px-4 py-2 text-white bg-gray-900 rounded-md sm:font-thin md:font-semibold hover:bg-[#C8000B] focus:outline-none">
                                    Submit
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 md:w-6 md:h-6 sm:w-4 sm:h-4"
                                        viewBox="0 0 24 24" fill="#FFFFFF">

                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M17 3H3v18h18V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Questionnaire -->
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
        @endif
    </div>
</div>
