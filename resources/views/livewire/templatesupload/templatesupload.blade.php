<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use App\Models\Template;

new class extends Component {
    use WithFileUploads;

    public $file;
    public $filename;
    public $thumbnail;
    public $template_category;
    public $showSuccessModal = false;
    public $fullName;
    public $fullThumbnailName;

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimetypes:application/pdf,application/msword',
            'thumbnail' => 'nullable|image|max:2048|mimetypes:application/jpg,application/jpeg,application/png',
            'filename' => 'required|string|max:255',
            'template_category' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        if (!isset($this->thumbnail) || !isset($this->filename)) {
            $this->addError('filename', 'Filename and/or thumbnail is required');
            return;
        }

        $this->validate();

        $extension = $this->file->getClientOriginalExtension();
        $this->file->storeAs('templates', $this->filename . '.' . $extension);
        $thumbnailExtension = $this->thumbnail->getClientOriginalExtension();
        $this->thumbnail->storeAs('thumbnails', $this->filename . '-thumb.' . $thumbnailExtension);

        Template::create([
            'name' => $this->filename . '.' . $extension,
            'url' => $this->filename . '.' . $extension,
            'category' => $this->template_category,
            'thumbnail' => $this->filename . '-thumb.' . $thumbnailExtension,
        ]);

        $this->showSuccessToast = true;
        $this->reset();
    }
}; ?>

<div class="container px-4 py-8 mx-auto">

    <div class="flex flex-col overflow-hidden bg-white rounded-lg shadow-md md:flex-row">
        <div class="w-full p-8">
            <div class="mb-4">
                <label for="filename" class="block text-sm font-medium text-gray-700">Filename:</label>
                <input wire:model="filename" type="text" id="filename"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600">
                @error('filename')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mt-4 mb-4">
                <label for="template_category" class="mb-2 text-sm font-semibold">{{ __('Category') }}:</label>
                <select wire:model="template_category" id="template_category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500">
                    <option value="" selected>Select...</option>
                    <option value="yearly">{{ __('Yearly') }}</option>
                    <option value="quarterly">{{ __('Quarterly') }}</option>
                    <option value="monthly">{{ __('Monthly') }}</option>
                </select>
                @error('template_category')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">{{ __('Template File') }}:</label>
                <div class="relative">
                    <input wire:model="file" type="file" id="file"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                @error('file')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <span class="text-xs text-gray-500">{{ __('Allowed file types: PDF, Word (.docx)') }}</span>
            </div>

            <div class="mb-8">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700">{{ __('Thumbnail') }}:</label>
                <div class="relative">
                    <input wire:model="thumbnail" type="file" id="thumbnail"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                @error('thumbnail')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <span class="text-xs text-gray-500">{{ __('Allowed file types: Images (.jpg, .jpeg, .png)') }}</span>
            </div>
            <x-primary-button wire:click.prevent="save"
                class="px-4 py-2 mt-4 text-white bg-blue-500 rounded shadow hover:bg-blue-700">
                {{ __('Upload Template') }}
            </x-primary-button>
        </div>
    </div>

</div>
