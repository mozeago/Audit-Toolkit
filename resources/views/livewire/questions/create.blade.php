<?php

use Livewire\Volt\Component;
use App\Models\Question;
use App\Models\Control;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Collection $controls;
    public $questionText = '';
    public $controlId = '';
    public function mount()
    {
        $this->fetchControls();
    }
    public function rules()
    {
        return [
            'questionText' => 'required|min:20',
            'controlId' => 'required|uuid',
        ];
    }
    public function fetchControls()
    {
        $this->controls = Control::orderBy('created_at', 'desc')->get();
    }
    public function store()
    {
        $validatedData = $this->validate();
        $question = Question::create([
            'text' => $validatedData['questionText'],
            'control_id' => $validatedData['controlId'],
        ]);
        $this->dispatch('question-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        return $this->reset('questionText', 'controlId');
    }
}; ?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="mb-6">
                <label for="questionText" class="block mb-2 text-sm text-gray-700">{{ __('Audit Question') }}:</label>
                <textarea wire:model="questionText"
                    class="w-full h-32 px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="{{ __('Audit Question') }}"></textarea>
                @error('questionText')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="category" class="block mb-2 text-sm text-gray-700">{{ __('Audit Control Name') }}</label>
                <select wire:model="controlId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled selected>{{ __('Select....') }}</option>
                    @foreach ($controls as $control)
                        <option value="{{ $control->id }}">{{ $control->name }}</option>
                    @endforeach
                </select>
                @error('controlId')
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
