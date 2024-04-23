<?php

use Livewire\Volt\Component;
use App\Models\Section;
use App\Models\Control;

new class extends Component {
    public string $message = '';
    public $sections = [];
    public $sectionId = '';
    public $controlName = '';
    public function mount()
    {
        $this->sections = Section::all();
    }
    public function rules(): array
    {
        return [
            'controlName' => 'required|string|max:255',
            'sectionId' => 'required|string',
        ];
    }
    public function store(): void
    {
        $validatedData = $this->validate();
        $control = Control::create([
            'name' => $validatedData['controlName'],
            'section_id' => $validatedData['sectionId'],
        ]);

        $this->message = 'Control Saved!';
        $this->dispatch('control-created');
        $this->resetFields();
    }
    public function resetFields()
    {
        return $this->reset('controlName', 'sectionId', 'message');
    }
}; ?>

<div class="flex shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="flex flex-col w-full">
                <label for="controlName" class="mb-2 text-sm font-semibold">{{ __('Audit Control Name:') }}</label>
                <input placeholder="{{ __('Audit Control Name') }}" wire:model="controlName" id="controlName" type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
                @error('controlName')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col w-full mt-4">
                <label for="sectionId" class="mb-2 text-sm font-semibold">{{ __('Audit Section Name') }}</label>
                <select wire:model="sectionId" id="sectionId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>Select...</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
                @error('sectionId')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <x-primary-button
                class="inline-flex items-center px-4 py-2 mt-4 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">{{ __('Save') }}</x-primary-button>
        </form>
        @if ($message)
            <div class="mt-2 text-green-500">{{ $message }}</div>
        @endif
    </div>
</div>
