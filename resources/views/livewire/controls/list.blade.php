<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\Control;
new class extends Component {
    public Collection $controls;

    public ?Control $editing = null;

    public function mount()
    {
        $this->getControls();
    }

    #[On('control-created')]
    public function getControls()
    {
        $this->controls = Control::orderBy('created_at', 'desc')->get();
    }
    #[On('control-edit-cancelled')]
    #[On('control-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getControls();
    }

    public function edit(Control $control): void
    {
        $this->editing = $control;
        $this->getControls();
    }
    public function delete(Control $control): void
    {
        $control->delete();

        $this->getControls();
    }
}; ?>

<div class="overflow-x-auto bg-white rounded-md shadow">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        @if (count($controls) > 0)
            <table class="w-full min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                            {{ __('Name') }}
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($controls as $control)
                        <tr wire:key="{{ $control->id }}">
                            <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                                @if ($control->is($editing))
                                    <livewire:controls.edit :control="$control" :key="$control->id" />
                                @else
                                    {{ $control->name }}
                                @endif
                            </td>
                            <td
                                class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                                <button wire:click.prevent="edit('{{ $control->id }}')" type="button"
                                    class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Edit') }}
                                </button>
                                <button wire:click.prevent="delete('{{ $control->id }}')" type="button"
                                    class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                                    {{ __('Delete') }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="alert alert-success">No Controls saved yet !</p>
        @endif
    </div>
</div>
