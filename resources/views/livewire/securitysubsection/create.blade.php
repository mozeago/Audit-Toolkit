<?php

use Livewire\Volt\Component;
use App\Models\SecuritySections;
use App\Models\SecuritySubSections;
use Illuminate\Support\Facades\Auth;
new class extends Component {
    public string $message = '';
    public $sections = null;
    public string $name = '';
    public string $security_sections_id = '';

    public function mount()
    {
        $this->sections = SecuritySections::orderBy('created_at', 'desc')->get();
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'security_sections_id' => 'required|string|max:40',
        ];
    }
    public function store(): void
    {
        $validatedData = $this->validate();

        $securitySection = SecuritySubSections::create([
            'name' => $validatedData['name'],
            'security_sections_id' => $validatedData['security_sections_id'],
        ]);
        $this->dispatch('security-sub-section-created');
        $this->reset('name', 'message', 'security_sections_id');
    }
}; ?>
<div class="flex mb-8 shadow-md">
    <div
        class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="flex flex-col w-full">
                <label for="name"
                    class="mb-2 text-sm font-semibold">{{ __('Security Sub Section Name:') }}</label>
                <input
                    placeholder="{{ __('Sub Section Name') }}"
                    wire:model="name" id="name"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none">
                @error('name')
                    <span
                        class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col w-full mt-4">
                <label for="security_sections_id"
                    class="mb-2 text-sm font-semibold">{{ __('Security Section Name') }}</label>
                <select wire:model="security_sections_id"
                    id="security_sections_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none">
                    <option value="" disabled
                        selected>Select...</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">
                            {{ $section->name }}</option>
                    @endforeach
                </select>
                @error('sectionId')
                    <span
                        class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <x-primary-button
                class="inline-flex items-center px-4 py-2 mt-4 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">{{ __('Save') }}</x-primary-button>
        </form>
        @if ($message)
            <div class="mt-2 text-green-500">
                {{ $message }}</div>
        @endif
    </div>
</div>
