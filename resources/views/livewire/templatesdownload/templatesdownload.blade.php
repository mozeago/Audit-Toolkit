<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Template;
new class extends Component {
    public Collection $templates;

    public function mount()
    {
        $this->templates = $this->loadTemplates();
    }

    public function loadTemplates()
    {
        return Template::orderBy('created_at', 'desc')->get();
    }
}; ?>
<div class="grid grid-cols-1 gap-4 mt-16 text-black md:grid-cols-3">
    @foreach ($templates as $template)
        <div class="flex flex-col max-w-sm overflow-hidden bg-white border border-gray-200 shadow-lg rounded-xl">
            <img class="w-full h-44 rounded-t-xl" src="{{ Storage::url($template->thumbnail) }}"
                alt="{{ $template->name }}">
            <div class="flex-grow px-6 py-4">
                <div class="mb-2 text-xl font-bold">
                    {{ $template->name }}</div>
                <p class="text-base text-gray-700">
                    {{ $template->category }}
                </p>
            </div>
            <div class="flex items-center justify-between px-4 pt-4 pb-2 border-t border-gray-200">
                <span class="text-gray-700"> <a href="{{ Storage::url($template->url) }}" target="_blank"
                        class="inline-flex items-center flex-shrink px-1 py-2 text-gray-800 bg-gray-200 rounded hover:bg-black hover:text-white">
                        <span class="mr-2 material-icons-sharp">
                            local_library
                        </span>
                        <span class="text-sm font-light">Preview</span>
                    </a></span>
                <span class="text-gray-700">
                    <a href="{{ Storage::url($template->url) }}" download>
                        <button
                            class="inline-flex items-center flex-grow flex-shrink px-1 py-2 font-bold text-gray-800 bg-gray-200 rounded hover:bg-red-800 hover:text-white">
                            <span class="material-icons-sharp">
                                download_for_offline
                            </span>
                            <span class="text-sm font-light">Download</span>
                        </button>
                    </a>
                </span>
            </div>
        </div>
    @endforeach
</div>
