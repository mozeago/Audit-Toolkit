<?php

use Livewire\Volt\Component;

new class extends Component {
    public Control $control;
    public string $controlName = '';
    public string $sectionId = '';
    public function mount()
    {
    }
}; ?>

<div>
    <div wire:model="control" class="flex items-center w-full">
        <input wire:model="" type="text"
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
        <div class="flex ml-2 space-x-2">
            <button wire:click="update" type="button"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
            </button>
            <button wire:click="cancel" type="button"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-500 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Cancel
            </button>
        </div>
    </div>
</div>
