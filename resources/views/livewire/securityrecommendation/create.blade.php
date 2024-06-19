<?php

use Livewire\Volt\Component;
use App\Models\SecurityQuestions;
use App\Models\SecurityRecommendations;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $securityQuestions;
    public $recommendationText = '';
    public $questionsId = '';

    public function mount()
    {
        $this->fetchSections();
    }

    public function rules()
    {
        return [
            'recommendationText' => 'required|min:20',
            'questionsId' => 'required|uuid',
        ];
    }

    public function fetchSections()
    {
        $this->securityQuestions = SecurityQuestions::orderBy('created_at', 'desc')->get();
    }

    public function store()
    {
        $validatedData = $this->validate();
        SecurityRecommendations::create([
            'name' => $validatedData['recommendationText'],
            'security_questions_id' => $validatedData['questionsId'],
        ]);
        $this->dispatch('security-recommendations-created');
        $this->resetFields();
        session()->flash('message', 'Security Recommendation saved !');
    }

    public function resetFields()
    {
        $this->reset('recommendationText', 'questionsId');
    }
};
?>

<div class="flex w-full mb-16 shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        @if (session()->has('error'))
            <div class="mb-4 text-red-500">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="store">
            <div class="mb-6">
                <label for="recommendationText"
                    class="block mb-2 text-sm text-gray-700">{{ __('Security Recommendation Text') }}:</label>
                <textarea wire:model="recommendationText"
                    class="w-full h-32 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="{{ __('Security Recommendation Text') }}"></textarea>
                @error('recommendationText')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="questionsId" class="block mb-2 text-sm text-gray-700">{{ __('Security Question') }}</label>
                <select wire:model="questionsId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled selected>{{ __('Select....') }}</option>
                    @foreach ($securityQuestions as $securityQuestion)
                        <option value="{{ $securityQuestion->id }}">{{ $securityQuestion->text }}</option>
                    @endforeach
                </select>
                @error('questionsId')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-start">
                <x-primary-button type="submit"
                    class="px-4 py-2 mt-4 text-white bg-blue-500 rounded shadow hover:bg-blue-700">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
