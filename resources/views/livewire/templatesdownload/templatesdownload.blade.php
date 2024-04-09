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

<div class="w-full">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($templates as $template)
            <div class="relative overflow-hidden bg-white rounded-lg shadow-md">
                <div class="h-40 bg-center bg-cover"
                    style="background-image: url('{{ Storage::url($template->thumbnail) }}')" aria-hidden="true"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center p-2 bg-gray-500 opacity-70">
                    <div class="text-center">
                        <h5 class="mb-2 text-lg font-bold text-black">{{ $template->name }}</h5>
                        <p class="mb-2 text-sm text-black">{{ $template->category }}</p>
                    </div>
                    <div class="flex justify-center mt-auto">
                        <a href="{{ Storage::url($template->url) }}" target="_blank"
                            class="inline-block px-4 py-2 ml-2 font-semibold transition duration-300 border rounded-full shadow-md text-custom-red bg-primary border-custom-red hover:bg-opacity-80 hover:border-opacity-80 hover:border-custom-red">Preview</a>
                        <a href="{{ Storage::url($template->url) }}" download
                            class="inline-block px-4 py-2 ml-2 font-semibold transition duration-300 border rounded-full shadow-md text-custom-red bg-secondary border-custom-red hover:bg-opacity-80 hover:border-opacity-80 hover:border-custom-red">Download</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
