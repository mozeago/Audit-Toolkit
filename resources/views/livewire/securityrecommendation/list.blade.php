<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\SecurityRecommendations;
new class extends Component {
    public Collection $securitRecommendations;
    public ?SecurityRecommendations $editing = null;

    public function mount()
    {
        $this->getSecurityRecommendations();
    }

    #[On('security-recommendations-created')]
    #[On('security-recommendations-deleted')]
    #[On('security-recommendation-updated')]
    public function getSecurityRecommendations()
    {
        $this->securitRecommendations = SecurityRecommendations::orderBy('created_at', 'desc')->get();
    }

    public function edit(SecurityRecommendations $securityRecommendations)
    {
        $this->editing = $securityRecommendations;
    }

    #[On('security-recommendation-edit-canceled')]
    #[On('security-recommendation-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getSecurityRecommendations();
    }

    public function delete(SecurityRecommendations $securityRecommendations): void
    {
        $securityRecommendations->delete();
        $this->dispatch('security-recommendations-deleted');

        $this->getSecurityRecommendations();
    }
}; ?>
<div class="bg-white shadow-2xl hover:shadow-none">
    <div class="flex flex-row rounded-t-lg bg-[#1C4863] text-white">
        <!-- Header Row -->
        <div style="flex-basis: 50%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
            Recommendation Text</div>
        <div style="flex-basis: 50%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
            Action</div>
    </div>
    @foreach ($securitRecommendations as $securityRecommendation)
        <div class="flex flex-row bg-white rounded-b-lg">
            <!-- Data Row -->
            <div class="flex items-start justify-start flex-none border-b border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                @if ($securityRecommendation->is($editing))
                    <livewire:securityrecommendation.edit :securityRecommendation="$securityRecommendation" :key="$securityRecommendation->id" />
                @else
                    {{ $securityRecommendation->name }}
                @endif

            </div>
            <div class="flex items-center justify-center flex-none border-b border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                <button wire:click.prevent="edit('{{ $securityRecommendation->id }}')" type="button"
                    class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Edit') }}
                </button>
                <button wire:click.prevent="delete('{{ $securityRecommendation->id }}')" type="button"
                    class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    @endforeach
</div>
