<?php

use Livewire\Volt\Component;
use App\Models\Section;
use Livewire\Attributes\Validate;
new class extends Component {
    public Section $section;

    #[Validate('required|string|max:255')]
    public string $name = '';

    public function mount(): void
    {
        $this->name = $this->section->name;
        session()->forget('message');
    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->section->update($validated);

        session()->flash('message', 'Section updated!');

        $this->dispatch('section-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('section-edit-canceled');
    }
};
?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col space-y-4">
                <div class="flex border border-gray-300 rounded-md shadow-sm">
                    <input wire:model="name" type="text"
                        class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-l-md"
                        placeholder="Question Text" value="{{ $section->name }}">
                    @error('name')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-start space-x-4">
                    <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                    <button wire:click="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
                </div>
        </form>
    </div>
</div>
