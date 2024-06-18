<?php

use Livewire\Volt\Component;
use App\Models\SecurityQuestions;
use App\Models\SecuritySubSections;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Collection $controls;
    public $questionText = '';
    public $subSectionId = '';

    public function mount()
    {
        $this->fetchControls();
    }

    public function rules()
    {
        return [
            'questionText' => 'required|min:20',
            'subSectionId' => 'required|uuid',
        ];
    }

    public function fetchControls()
    {
        $this->controls = SecuritySubSections::orderBy('created_at', 'desc')->get();
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            SecurityQuestions::create([
                'text' => $validatedData['questionText'],
                'security_sections_id' => $validatedData['subSectionId'],
            ]);
            $this->dispatch('sub-section-question-created');
            $this->resetFields();
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Failed to create security question', [
                'error' => $e->getMessage(),
                'questionText' => $validatedData['questionText'],
                'security_sections_id' => $validatedData['subSectionId'],
            ]);
            session()->flash('error', 'Failed to create security question. Please ensure the sub-section name is valid.');
        }
    }

    public function resetFields()
    {
        $this->reset('questionText', 'subSectionId', 'message');
    }
}; ?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        @if (session()->has('error'))
            <div class="mb-4 text-red-500">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="store">
            <div class="mb-6">
                <label for="questionText"
                    class="block mb-2 text-sm text-gray-700">{{ __('Security Question Text') }}:</label>
                <textarea wire:model="questionText"
                    class="w-full h-32 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="{{ __('Security Question Text') }}"></textarea>
                @error('questionText')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="subSectionId"
                    class="block mb-2 text-sm text-gray-700">{{ __('Security Sub-Section Name') }}</label>
                <select wire:model="subSectionId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled selected>{{ __('Select....') }}</option>
                    @foreach ($controls as $control)
                        <option value="{{ $control->id }}">{{ $control->name }}</option>
                    @endforeach
                </select>
                @error('subSectionId')
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
