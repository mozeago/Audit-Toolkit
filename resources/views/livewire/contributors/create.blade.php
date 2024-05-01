<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\ResearchContributorsModel;
new class extends Component {
    public $name;
    public $email;
    public $role;
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'role' => 'required|string',
        ];
    }
    public function resetFields()
    {
        return $this->reset('name', 'email', 'role');
    }
    public function save()
    {
        $validatedData = $this->validate();
        $contributor = ResearchContributorsModel::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'description' => $validatedData['role'],
        ]);
        $this->dispatch('contributor-created');
        $this->resetFields();
    }
}; ?>

<div class="flex rounded-sm shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="save">
            <div class="mt-2.5">
                <input wire:model="name" placeholder="{{ __('Full Name') }}" type="text" name="name" id="name"
                    autocomplete=""
                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                @error('name')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2.5">
                <input wire:model="email" placeholder="{{ __('Email') }}" type="text" name="email" id="email"
                    autocomplete=""
                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                @error('email')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2.5">
                <input wire:model="role" placeholder="{{ __('Role') }}" type="text" name="role" id="role"
                    autocomplete=""
                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                @error('role')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</div>
