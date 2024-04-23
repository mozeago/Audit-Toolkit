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

<div class="w-full pl-5 mt-10 mb-10">
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-2">
        @foreach ($templates as $template)
            <div class="relative max-w-sm mx-auto mb-20 ml-2 mr-2 overflow-hidden bg-white shadow-lg rounded-xl">
                <img class="object-cover w-full h-64" src="{{ Storage::url($template->thumbnail) }}" alt="Image"
                    style="opacity: 0.5;">
                <button class="absolute top-0 right-0 px-2 py-1 mt-2 mr-2 text-white bg-gray-800 rounded">
                    {{ $template->category }}
                </button>
                <div class="p-6">
                    <div class="mb-2 text-xl font-bold">{{ $template->name }}</div>
                    <p class="mb-4 text-base text-gray-700">{{ $template->category }}</p>
                    <div class="flex justify-between">
                        <a href="{{ Storage::url($template->url) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 font-bold text-gray-800 bg-gray-200 rounded hover:bg-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Preview
                        </a>
                        <a href="{{ Storage::url($template->url) }}" download>
                            <button
                                class="inline-flex items-center px-4 py-2 font-bold text-gray-800 bg-gray-200 rounded hover:bg-red-800 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                                Download
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
