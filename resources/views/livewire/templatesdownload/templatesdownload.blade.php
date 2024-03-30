<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;
new class extends Component {
    public $templates = [];

    public function mount()
    {
        $this->templates = $this->loadTemplates();
    }

    public function loadTemplates()
    {
        $templates = [];

        $files = Storage::disk('local')->files('templates');

        foreach ($files as $file) {
            $templateName = basename($file);
            $templateUrl = Storage::disk('local')->url($file); // Use appropriate disk if needed

            $templates[] = [
                'name' => $templateName,
                'url' => $templateUrl,
            ];
        }

        return $templates;
    }
}; ?>

<div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($templates as $template)
            <div class="rounded-lg shadow-md card">
                <div class="card-body">
                    <h5 class="card-title">{{ $template['name'] }}</h5>
                    <a href="{{ $template['url'] }}" target="_blank" class="btn btn-primary">Preview</a>
                    <a href="{{ $template['url'] }}" download class="btn btn-secondary">Download</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
