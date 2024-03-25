<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public Collection $sections;

    public ?Section $editing = null;

    public function mount(): void
    {
        $this->getSections();
    }

    #[On('section-created')]
    public function getSections(): void
    {
        $this->sections = Section::orderBy('created_at', 'desc')->get();
    }

    public function edit(Section $section): void
    {
        $this->editing = $section;
        $this->getSections();
    }

    #[On('section-edit-canceled')]
    #[On('section-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getSections();
    }
    public function delete(Section $section): void
    {
        $section->delete();
        session()->flash('message', 'Deleted Successfully.');
        $this->getSections();
    }
}; ?>
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (count($sections) > 0)
        <table class="table border border-collapse">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-200 border border-gray-200">
                        Section Name
                    </th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-200 border border-gray-200">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        @if ($section->is($editing))
                            <livewire:sections.edit :section="$section" :key="$section->id" />
                        @else
                            <td>{{ $section->name }}</td>
                        @endif
                        <td><x-primary-button wire:click="edit('{{ $section->id }}')">
                                {{ __('Edit') }}
                            </x-primary-button>
                            <button wire:click="delete('{{ $section->id }}')">
                                {{ __('Delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No sections saved.</p>
    @endif
</div>
