<?php

use Livewire\Volt\Component;
use App\Models\Section;
use Livewire\Attributes\Validate;
new class extends Component {
    public Section $section;

    #[Validate('required|string|max:255')]
    public string $name = '';
    // public function rules(): array
    // {
    //     return [
    //         'name' => 'required|string|max:255',
    //     ];
    // }

    public function mount(): void
    {
        $this->section = Section::where('id', $section->id)->get();
        $this->name = $this->section->name;
    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->section->update($validated);

        $this->dispatch('section-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('section-edit-canceled');
    }
}; ?>

<div>
    <form wire:submit.prevent="update">
        <input type="text" wire:model.defer="name"
            class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
        <x-primary-button class="mt-4">{{ __('Update Section') }}</x-primary-button>
        <button class="mt-4" wire:click.prevent="cancel">Cancel</button>
    </form>
</div>
