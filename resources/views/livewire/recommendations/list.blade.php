<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\Recommendation;
new class extends Component {
    public Collection $recommendations;
    public ?Recommendation $editing = null;
    public function mount()
    {
        $this->getRecomendations();
    }
    #[On('recommendation-created')]
    public function getRecomendations()
    {
        $this->recommendations = Recommendation::orderBy('created_at', 'desc')->get();
    }

    public function edit(Recommendation $recommendation)
    {
        $this->editing = $recommendation;
        $this->getRecomendations();
    }

    #[On('recommendation-updated')]
    #[On('recommendation-cancelled')]
    public function disableEditing()
    {
        $this->editing = null;
        $this->getRecomendations();
    }
    public function delete(Recommendation $recommendation)
    {
        $recommendation->delete();
        $this->getRecomendations();
    }
}; ?>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                    Question Text
                </th>
                <th
                    class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recommendations as $recommendation)
                <tr class="hover:bg-gray-100 ">
                    <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                        @if ($recommendation->is($editing))
                            <livewire:recommendations.edit :recommendation="$recommendation" :key="$recommendation->id" />
                        @else
                            {{ $recommendation->content }}
                        @endif
                    </td>
                    <td class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                        <button wire:click.prevent="edit('{{ $recommendation->id }}')" type="button"
                            class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Edit') }}
                        </button>
                        <button wire:click.prevent="delete('{{ $recommendation->id }}')" type="button"
                            class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
