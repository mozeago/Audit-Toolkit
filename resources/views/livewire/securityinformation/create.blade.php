<?php

use Livewire\Volt\Component;
use App\Models\SecurityQuestions;
use App\Models\SecurityInformations;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $securityQuestions;
    public $securityQuestionId = null;
    public $informationText = '';

    public function mount()
    {
        $this->fetchSections();
    }

    public function rules()
    {
        return [
            'informationText' => 'required|min:20',
            'securityQuestionId' => 'required',
        ];
    }

    public function fetchSections()
    {
        $this->securityQuestions = SecurityQuestions::orderBy('created_at', 'desc')->get();
    }

    public function store()
    {
        try {
            $validatedData = $this->validate();

            SecurityInformations::create([
                'name' => $validatedData['informationText'],
                'security_questions_id' => $validatedData['securityQuestionId'],
            ]);

            $this->dispatch('security-information-created');
            $this->resetFields();
            session()->flash('message', 'Security information saved!');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error saving security information: ' . $e->getMessage());

            // Flash an error message to the session
            session()->flash('error', 'There was an error saving the security information. Please try again.');
        }
    }

    public function resetFields()
    {
        $this->reset('informationText', 'securityQuestionId');
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
                <label for="informationText"
                    class="block mb-2 text-sm text-gray-700">{{ __('Security Information Text') }}:</label>
                <textarea wire:model="informationText"
                    class="w-full h-32 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="{{ __('Security Information Text') }}"></textarea>
                @error('informationText')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="securityQuestionId"
                    class="block mb-2 text-sm text-gray-700">{{ __('Security Question') }}</label>
                <select wire:model="securityQuestionId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled selected>{{ __('Select....') }}</option>
                    @foreach ($securityQuestions as $securityQuestion)
                        <option value="{{ $securityQuestion->id }}">{{ $securityQuestion->text }}</option>
                    @endforeach
                </select>
                @error('securityQuestionId')
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
