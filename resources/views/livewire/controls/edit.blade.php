<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\Control;
use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Control $control;
    public Collection $sections;
    public string $name = '';
    public string $section_id = '';
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'section_id' => 'required|max:36',
        ];
    }
    public function mount()
    {
        $this->name = $this->control->name;
        $this->section_id = $this->control->section_id;
        $this->fetchSections();
    }
    public function fetchSections()
    {
        $this->sections = Section::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $this->validate();
        $this->control->update([
            'name' => $this->name,
            'section_id' => $this->section_id,
        ]);
        $this->dispatch('control-updated');
    }
    public function cancel(): void
    {
        $this->dispatch('control-edit-cancelled');
    }
}; ?>

<div>
    <form wire:submit.prevent="update">
        <div class="flex flex-col w-full mb-4">
            <label for="name" class="form-label">{{ __('Question') }}</label>
            <input wire:model="name" type="text" id="name"
                class="form-control @error('name') is-invalid @enderror" />
            @error('name')
                <div class="invalid-feedback error-class">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col w-full mb-4">
            <select wire:model="section_id" id="section_id"
                class="form-control @error('section_id') is-invalid @enderror">
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
            @error('section_id')
                <div class="invalid-feedback error-class">{{ $message }}</div>
            @enderror
        </div>
        <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
        <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
    </form>
</div>
