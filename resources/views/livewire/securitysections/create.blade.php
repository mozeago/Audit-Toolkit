<?php

use Livewire\Volt\Component;
use App\Models\SecuritySections;
use Illuminate\Support\Facades\Auth;
new class extends Component {
    public string $message = '';
    public string $name = '';
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
    public function store(): void
    {
        $validatedData = $this->validate();

        $securitySection = SecuritySections::create([
            'name' => $validatedData['name'],
        ]);
        $this->dispatch('security-section-created');
        $this->reset('name', 'message');
    }
}; ?>
<div class="flex mb-8 rounded-sm shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="store">
            <div class="mt-2.5">
                <input wire:model="name" placeholder="{{ __('Security Section Name') }}" type="text" name="section_name"
                    id="section_name" autocomplete=""
                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                @error('name')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        </form>
    </div>

</div>
