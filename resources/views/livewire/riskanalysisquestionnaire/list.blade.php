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

        <div class="relative flex items-end justify-end mb-2">
            <button @click="onBoardingText = !onBoardingText"
                class="hover:bg-black text-lg px-4 py-2 text-white bg-[#0E9F6E] rounded-full font-semibold custom-shadow focus:outline-none transition-all duration-300">
                Let's begin
            </button>
        </div>
    </div>
</div>
