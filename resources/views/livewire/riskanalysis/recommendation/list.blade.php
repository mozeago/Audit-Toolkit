<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\RiskRecommendation;

new class extends Component {
    public Collection $riskRecommendations;

    public ?RiskRecommendation $editing = null;

    public function mount(): void
    {
        $this->getRecommendations();
    }
    #[On('risk-recommendation-cancelled')]
    #[On('risk-recommendation-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getRecommendations();
    }
    #[On('risk-recommendation-created')]
    public function getRecommendations(): void
    {
        $this->riskRecommendations = RiskRecommendation::orderBy('created_at', 'desc')->get();
    }

    public function edit(RiskRecommendation $riskRecommendation)
    {
        $this->editing = $riskRecommendation;
        $this->getRecommendations();
    }
    public function delete(RiskRecommendation $riskRecommendation): void
    {
        $riskRecommendation->delete();
        $this->getRecommendations();
    }
}; ?>
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                        Risk Recommendation Text
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riskRecommendations as $riskRecommendation)
                    <tr class="hover:bg-gray-100">
                        <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            @if ($riskRecommendation->is($editing))
                                <livewire:riskanalysis.recommendation.edit :riskRecommendation="$riskRecommendation" :key="$riskRecommendation->id" />
                            @else
                                {{ $riskRecommendation->text }}
                            @endif
                        </td>
                        <td
                            class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            <button wire:click.prevent="edit('{{ $riskRecommendation->id }}')" type="button"
                                class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ __('Edit') }}
                            </button>
                            <button wire:click.prevent="delete('{{ $riskRecommendation->id }}')" type="button"
                                class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                                {{ __('Delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
