<?php

use Livewire\Volt\Component;
use App\Models\Control;
use App\Models\Question;
use Livewire\Attributes\Validate;

new class extends Component {
    public $controls = [];
    public string $text = '';
    public string $control_id = '';
    public function rules()
    {
        return [
            'text' => 'required|min:20',
            'control_id' => 'required|uuid',
        ];
    }
    public function mount()
    {
        $this->controls = Control::all();
    }
    public function store(): void
    {
        if (empty($this->control_id)) {
            $this->addError('control_id', 'Please select a control.');
            return;
        }
        $validatedData = $this->validate();
        $question = Question::create([
            'text' => $validatedData['text'],
            'control_id' => $validatedData['control_id'],
        ]);
        $this->dispatch('question-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->reset('text', 'control_id');
    }
}; ?>

<div>
    <form wire:submit.prevent="store">
        <div class="flex flex-col mb-4 space-y-4">
            <textarea wire:model="text" rows="5" placeholder="{{ __('Question Text') }}"
                class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary-500 focus:ring-opacity-50"></textarea>
            @error('text')
                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col w-full mb-4">
            <select wire:model="control_id" id="control_id"
                class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary-500 focus:ring-opacity-500">
                <option value=""disabled selected>Select...</option>
                @foreach ($controls as $control)
                    <option value="{{ $control->id }}">{{ $control->name }}</option>
                @endforeach

            </select>
            @error('control_id')
                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
