<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SecuritySubSections;
use App\Models\SecuritySections;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public SecuritySubSections $securitySubSection;
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
        $this->name = $this->securitySubSection->name;
        $this->section_id = $this->securitySubSection->id;
        $this->fetchSections();
    }
    public function fetchSections()
    {
        $this->sections = SecuritySections::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $this->validate();
        $this->control->update([
            'name' => $this->name,
            'security_sections_id' => $this->section_id,
        ]);
        $this->dispatch('control-updated');
    }
    public function cancel(): void
    {
        $this->dispatch('security-sub-section-cancelled');
    }
}; ?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col w-full mb-4">
                <label for="name" class="form-label">{{ __('Question') }}</label>
                <input wire:model="name" type="text" id="name"
                    class="form-control @error('name') is-invalid @enderror" />
                @error('name')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full mb-4">
                <select wire:model="section_id" id="section_id"
                    class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="" disabled selected>{{ __('Select ...') }}</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section_id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
                @error('section_id')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
            <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
        </form>
    </div>
</div>
