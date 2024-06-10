<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Validator;
use App\Models\Template;

new class extends Component {
    use WithFileUploads;

    public $file;
    public $filename;
    public $thumbnail;
    public $template_category;
    public $showSuccessToast = false;
    public $fullName;
    public $fullThumbnailName;
    public $templates;
    #[On('template-deleted')]
    public function mount()
    {
        $this->templates = $this->loadTemplates();
    }
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'filename' => 'required|string|max:255',
            'template_category' => 'required|string|max:255',
        ];
    }
    public function loadTemplates()
    {
        return Template::orderBy('created_at', 'desc')->get();
    }
    public function save()
    {
        if (!isset($this->filename)) {
            $this->addError('filename', 'Filename is required');
            return;
        } elseif (!isset($this->thumbnail)) {
            $this->addError('filename', 'Thumbnail is required');
        }

        $this->validate();

        $extension = $this->file->getClientOriginalExtension();
        $this->file->storeAs('public/templates', $this->filename . '.' . $extension);
        $thumbnailExtension = $this->thumbnail->getClientOriginalExtension();
        $this->thumbnail->storeAs('public/thumbnails', $this->filename . '-thumb.' . $thumbnailExtension);

        Template::create([
            'name' => $this->filename . '.' . $extension,
            'url' => 'templates/' . $this->filename . '.' . $extension,
            'thumbnail' => 'thumbnails/' . $this->filename . '-thumb.' . $thumbnailExtension,
            'category' => $this->template_category,
        ]);

        $this->showSuccessToast = true;
        $this->reset('filename', 'template_category', 'file', 'thumbnail');
    }
    public function deleteTemplate(Template $template)
    {
        $template->delete();
        $this->dispatch('template-deleted');
    }
}; ?>
<div>
    <div class="w-full px-4 py-8 mx-auto bg-white rounded-md shadow-md">
        <div class="flex flex-col overflow-hidden bg-white md:flex-row">
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
                    <label for="file"
                        class="block text-sm font-medium text-gray-700">{{ __('Template File') }}:</label>
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
                    <label for="thumbnail"
                        class="block text-sm font-medium text-gray-700">{{ __('Thumbnail') }}:</label>
                    <div class="relative">
                        <input wire:model="thumbnail" type="file" id="thumbnail"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    @error('thumbnail')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <span
                        class="text-xs text-gray-500">{{ __('Allowed file types: Images (.jpg, .jpeg, .png)') }}</span>
                </div>
                <x-primary-button wire:click.prevent="save"
                    class="px-4 py-2 mt-4 text-white bg-blue-500 rounded shadow hover:bg-blue-700">
                    {{ __('Upload Template') }}
                </x-primary-button>
                {{-- @if ($showSuccessToast)
                <div id="successToast" class="fixed top-0 left-0 flex items-center justify-center w-full h-full">
                    <div class="px-6 py-4 text-white bg-green-500 rounded-lg shadow-lg">
                        <strong>Success!</strong> Your template has been uploaded.
                    </div>
                </div>
            @endif --}}
            </div>
        </div>

    </div>
    <div class="mt-8 bg-white shadow-2xl hover:shadow-none">
        <div class="flex flex-row rounded-t-lg bg-[#1C4863] text-white">
            <!-- Header Row -->
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Name</div>
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Categoty</div>
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                URL</div>
            <div style="flex-basis: 25%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
                Action</div>
        </div>
        @foreach ($templates as $template)
            <div class="flex flex-row bg-white rounded-b-lg">
                <!-- Data Row -->
                <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                    style="flex-basis: 25%;">
                    {{ $template->name }}
                </div>
                <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                    style="flex-basis: 25%;">
                    {{ $template->category }}
                </div>
                <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                    style="flex-basis: 25%;">
                    {{ $template->url }}
                </div>
                <div class="flex items-center justify-center flex-none sm:p-1 md:p-4" style="flex-basis: 25%;">
                    <a wire:click.prevent="deleteTemplate('{{ $template->id }}')" href="#"
                        class="ml-2 inline-block sm:px-2 sm:py-2 sm:text-xs md:px-6 md:py-2 hover:text-[#C8000B]">
                        <span class="material-icons-sharp">
                            delete_forever
                        </span>
                    </a>
                </div>
            </div>
            <div class="flex-grow border-b border-gray-300">
            </div>
        @endforeach
    </div>
</div>
