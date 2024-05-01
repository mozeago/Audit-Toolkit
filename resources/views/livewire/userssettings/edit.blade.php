<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $selectedRole = 'user'; // Default role
    public User $user;
    public $showDropdown = false;
    public function updateRole($role)
    {
        $user = User::findOrFail($this->user->id);
        $user->role = $role;
        $user->save();
        $this->dispatch('roleUpdated');
        $this->showDropdown = false;
    }
}; ?>

<div x-show="showDropdown">
    <div class="relative inline-block text-left">
        <div>
            <button type="button" wire:click="updateRole('{{ $selectedRole }}')"
                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-300 focus:ring-blue">
                <span>{{ ucfirst($selectedRole) }}</span>
                <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="absolute right-0 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                <button x-on:click="showDropdown = false" wire:click='updateRole("user")'
                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                    role="menuitem">User</button>
                <button x-on:click="showDropdown = false" wire:click='updateRole("admin")'
                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                    role="menuitem">Admin</button>
            </div>
        </div>
    </div>
</div>
