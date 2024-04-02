<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\RiskInformation;

new class extends Component {
    public Collection $riskInformation;

    public ?RiskInformation $editing = null;

    public function mount(): void
    {
        $this->getRiskInformation();
    }
    #[On('risk-information-edit-canceled')]
    #[On('risk-information-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getRiskInformation();
    }
    #[On('risk-information-created')]
    public function getRiskInformation(): void
    {
        $this->riskInformation = RiskInformation::orderBy('created_at', 'desc')->get();
    }

    public function edit(RiskInformation $riskInfo)
    {
        $this->editing = $riskInfo;
        $this->getRiskInformation();
    }
    public function delete(RiskInformation $riskInformation): void
    {
        $riskInformation->delete();
        $this->getRiskInformation();
    }
}; ?>
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                        Risk Sub-Section Text
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riskInformation as $riskInfo)
                    <tr class="hover:bg-gray-100">
                        <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            @if ($riskInfo->is($editing))
                                <livewire:riskanalysis.information.edit :riskInfo="$riskInfo" :key="$riskInfo->id" />
                            @else
                                {{ $riskInfo->text }}
                            @endif
                        </td>
                        <td
                            class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                            <button wire:click.prevent="edit('{{ $riskInfo->id }}')" type="button"
                                class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ __('Edit') }}
                            </button>
                            <button wire:click.prevent="delete('{{ $riskInfo->id }}')" type="button"
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
