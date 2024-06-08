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
<div
    class="mt-14 grid grid-cols-1 gap-4 text-black md:grid-cols-3">
    @foreach ($templates as $template)
        <div
            class="flex max-w-sm flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg">
            <img class="w-full rounded-t-xl"
                src="{{ Storage::url($template->thumbnail) }}"
                alt="{{ $template->name }}">
            <div class="flex-grow px-6 py-4">
                <div class="mb-2 text-xl font-bold">
                    {{ $template->name }}</div>
                <p class="text-base text-gray-700">
                    {{ $template->category }}
                </p>
            </div>
            <div
                class="flex items-center justify-between border-t border-gray-200 px-4 pb-2 pt-4">
                <span class="text-gray-700"> <a
                        href="{{ Storage::url($template->url) }}"
                        target="_blank"
                        class="inline-flex flex-shrink items-center rounded bg-gray-200 px-1 py-2 text-gray-800 hover:bg-black hover:text-white">
                        <span
                            class="material-icons-sharp mr-2">
                            local_library
                        </span>
                        <span
                            class="text-sm font-light">Preview</span>
                    </a></span>
                <span class="text-gray-700">
                    <a href="{{ Storage::url($template->url) }}"
                        download>
                        <button
                            class="inline-flex flex-shrink flex-grow items-center rounded bg-gray-200 px-1 py-2 font-bold text-gray-800 hover:bg-red-800 hover:text-white">
                            <span
                                class="material-icons-sharp">
                                download_for_offline
                            </span>
                            <span
                                class="text-sm font-light">Download</span>
                        </button>
                    </a>
                </span>
            </div>
        </div>
        {{-- <div
            class="relative overflow-visible bg-white border-2 shadow-xl rounded-xl">
            <img class="object-cover w-full h-48"
                src="https://via.placeholder.com/300"
                alt="{{ $template->title }}">
            <button
                class="absolute top-0 right-0 px-2 py-1 mt-2 mr-2 text-white bg-gray-800 rounded">
                {{ $template->category }}
            </button>
            <div
                class="mb-2 font-bold sm:text-sm md:text-xl">
                Title</div>
            <div
                class="absolute bottom-0 left-0 right-0 p-4 bg-white">
                <div class="grid gap-2 sm:grid-cols-2">
                    <div class="flex w-full">
                        <a href="{{ Storage::url($template->url) }}"
                            target="_blank"
                            class="inline-flex items-center flex-shrink px-1 py-2 text-black bg-gray-300 rounded hover:bg-black hover:text-white">
                            <span
                                class="mr-2 material-icons-sharp">
                                local_library
                            </span>
                            <span
                                class="text-sm font-light">Preview</span>
                        </a>
                    </div>
                    <div class="flex w-full">
                        <a href="{{ Storage::url($template->url) }}"
                            download>
                            <button
                                class="inline-flex items-center flex-grow flex-shrink px-1 py-2 font-bold text-black bg-gray-300 rounded hover:bg-red-800 hover:text-white">
                                <span
                                    class="material-icons-sharp">
                                    download_for_offline
                                </span>
                                <span
                                    class="text-sm font-light">Download</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    @endforeach
</div>
