<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\RiskSubSection;

new class extends Component {
    public Collection $riskSubSections;

    public ?RiskSubSection $editing = null;

    public function mount(): void
    {
        $this->getRiskSections();
    }

    #[On('risk-sub-section-created')]
    public function getRiskSections(): void
    {
        $this->riskSubSections = RiskSubSection::orderBy('created_at', 'desc')->get();
    }

    public function edit(RiskSubSection $riskSubSection)
    {
        $this->editing = $riskSubSection;
        $this->getRiskSections();
    }

    #[On('risk-sub-section-edit-canceled')]
    #[On('risk-sub-section-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getRiskSections();
    }
    public function delete(RiskSubSection $riskSubSection): void
    {
        $riskSubSection->delete();
        $this->getRiskSections();
    }
}; ?>
<div class="w-full overflow-x-auto bg-white rounded-md shadow">
    <div class="overflow-x-auto bg-white rounded-md shadow">
        <table class="w-full min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                        {{ __('Risk Analysis Question Text') }}
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riskSubSections as $riskSubSection)
                    <tr class="hover:bg-gray-100">
                        <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            @if ($riskSubSection->is($editing))
                                <livewire:riskanalysis.subsection.edit :riskSubSection="$riskSubSection" :key="$riskSubSection->id" />
                            @else
                                {{ $riskSubSection->text }}
                            @endif
                        </td>
                        <td
                            class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            <button wire:click.prevent="edit('{{ $riskSubSection->id }}')" type="button"
                                class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ __('Edit') }}
                            </button>
                            <button wire:click.prevent="delete('{{ $riskSubSection->id }}')" type="button"
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
