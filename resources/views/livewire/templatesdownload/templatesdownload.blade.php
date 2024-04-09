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

<div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($templates as $template)
            <div class="rounded-lg shadow-md card">
                <div class="card-body">
                    @if ($template->thumbnail != '')
                        <img src="{{ Storage::url($template->thumbnail) }}" alt="{{ $template->name }} thumbnail">
                    @endif
                    <h5 class="card-title">{{ $template->name }}</h5>
                    <a href="{{ 'storage/app/templates/' . $template->url }}" target="_blank"
                        class="btn btn-primary">Preview</a>
                    <a href="{{ 'storage/app/templates/' . $template->url }}" download
                        class="btn btn-secondary">Download</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
