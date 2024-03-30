<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
new class extends Component {
    use WithFileUploads;

    public $file;
    public $filename;
    public $template_category;
    public $showSuccessModal = false;

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimetypes:application/pdf,application/msword',
            'filename' => 'required|string|max:255',
            'template_category' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        $extension = $this->file->getClientOriginalExtension();
        $this->file->storeAs('templates', $this->filename . '.' . $extension);

        $this->showSuccessToast = true;
        $this->reset();
    }
}; ?>
<div class="container px-4 py-8 mx-auto">

    <div class="flex flex-col overflow-hidden bg-white rounded-lg shadow-md md:flex-row">

        <div class="w-full p-8 md:w-1/2">

            <h1 class="mb-4 text-2xl font-bold">Upload Template</h1>

            <div class="mb-4">
                <label for="filename" class="block text-sm font-medium text-gray-700">Filename:</label>
                <input wire:model="filename" type="text" id="filename"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600">
                @error('filename')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="template_category"
                    class="block text-sm font-medium text-gray-700">{{ __('Category') }}:</label>
                <select wire:model="template_category" id="template_category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600">
                    <option value="" selected disabled>{{ __('Select Category') }}</option>
                    <option value="yearly">{{ __('Yearly') }}</option>
                    <option value="quarterly">{{ __('Quarterly') }}</option>
                    <option value="monthly">{{ __('Monthly') }}</option>
                </select>
                @error('template_category')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file"
                    class="block text-sm font-medium text-gray-700">{{ __('Upload Template') }}:</label>
                <div class="relative">
                    <input wire:model="file" type="file" id="file"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                @error('file')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <span class="text-xs text-gray-500">{{ __('Allowed file types: PDF, Word (.docx)') }}</span>
            </div>

            <x-primary-button wire:click.prevent="save"
                class="px-4 py-2 mt-4 text-white bg-blue-500 rounded shadow hover:bg-blue-700">
                {{ __('Upload Template') }}
            </x-primary-button>
        </div>

    </div>

</div>
