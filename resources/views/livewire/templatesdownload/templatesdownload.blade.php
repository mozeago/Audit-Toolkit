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
<div class="grid grid-cols-1 gap-4 md:grid-cols-3">
    <div class="relative overflow-hidden bg-white rounded shadow-lg">
        <img class="object-cover w-full h-48" src="https://via.placeholder.com/300" alt="Card Image">
        <div class="px-6 py-4">
            <div class="mb-2 text-xl font-bold">Card Title 1</div>
            <p class="text-base text-gray-700">Card Subtitle 1</p>
        </div>
        <div class="absolute bottom-0 w-full bg-gray-200 py-2 px-4">
            <p class="text-gray-800 text-sm">Fixed Row at Bottom</p>
        </div>
    </div>

</div>
