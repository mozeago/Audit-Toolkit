<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label for="textInput" class="block mb-2 font-bold text-gray-700">Information Text:</label>
            <input wire:model.defer="textInput" type="text" id="textInput"
                class="relative block w-full px-3 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-indigo-500 focus:ring-w-1">
        </div>

        <div class="mb-4">
            <label for="selectedOption" class="block mb-2 font-bold text-gray-700">Question:</label>
            <select wire:model.defer="question" id="question"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:ring-w-1">
                {{-- @foreach ($options as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach --}}
            </select>
        </div>

        <x-primary-button class="mt-4">Save</x-primary-button>
    </form>
</div>
