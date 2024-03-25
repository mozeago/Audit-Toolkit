<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\Section;

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

    public function edit(Section $section)
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
        $this->getSections();
    }
}; ?>
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                        Section Name
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr class="hover:bg-gray-100">
                        <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            @if ($section->is($editing))
                                <livewire:sections.edit :section="$section" :key="$section->id" />
                            @else
                                {{ $section->name }}
                            @endif
                        </td>
                        <td
                            class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            <button wire:click.prevent="edit('{{ $section->id }}')" type="button"
                                class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Edit
                            </button>
                            <button wire:click="delete('{{ $section->id }}')" type="button"
                                class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('sectionDeleted', function() {
            session() - > forget('message');
        });
    </script>
@endpush
