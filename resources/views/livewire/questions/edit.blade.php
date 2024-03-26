<?php

use Livewire\Volt\Component;
use App\Models\Question;
use App\Models\Control;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Question $question;

    public Collection $controls;

    public string $text = '';

    public string $control_id = '';
    public function mount()
    {
        $this->text = $this->question->text;
        $this->control_id = $this->question->control_id;
        $this->fetchControls();
    }
    public function rules()
    {
        return [
            'text' => 'required|string|min:20',
            'control_id' => 'required|uuid|min:36',
        ];
    }
    public function fetchControls()
    {
        $this->controls = Control::orderBy('created_at', 'desc')->get();
    }
    public function update()
    {
        $validatedData = $this->validate();
        $this->question->update($validatedData);
        $this->dispatch('question-updated');
    }
    public function cancel(): void
    {
        $this->editing = null;
        $this->dispatch('question-update-cancelled');
    }
}; ?>

<div>
    <form wire:submit.prevent="update">
        <div class="flex flex-col space-y-4">
            <div class="flex border border-gray-300 rounded-md shadow-sm">
                <input wire:model="text" type="text" value="{{ $question->text }}"
                    class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-l-md"
                    placeholder="Question Text">
            </div>
            <div class="border border-gray-300 rounded-md shadow-sm">
                <select wire:model="control_id"
                    class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    @foreach ($controls as $control)
                        <option value="{{ $control->id }}">{{ $control->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-primary-button type="submit"
            class="px-4 py-2 mt-4 text-white bg-blue-500 rounded shadow hover:bg-blue-700">{{ __('Update') }}</x-primary-button>
        <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
    </form>
</div>
