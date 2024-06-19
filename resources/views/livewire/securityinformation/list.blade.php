<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\SecurityInformations;
new class extends Component {
    public Collection $securitInformations;
    public ?SecurityInformations $editing = null;

    public function mount()
    {
        $this->getSecurityInformations();
    }

    #[On('security-information-created')]
    public function getSecurityInformations()
    {
        $this->securitInformations = SecurityInformations::orderBy('created_at', 'desc')->get();
    }

    public function edit(SecurityInformations $securitInformations)
    {
        $this->editing = $securitInformations;
    }

    #[On('security-information-edit-canceled')]
    #[On('security-information-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getSecurityInformations();
    }

    public function delete(SecurityInformations $securitInformations): void
    {
        $securitInformations->delete();
        $this->getSecurityInformations();
    }
}; ?>
<div class="bg-white shadow-2xl hover:shadow-none">
    <div class="flex flex-row rounded-t-lg bg-[#1C4863] text-white">
        <!-- Header Row -->
        <div style="flex-basis: 50%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
            Question Text</div>
        <div style="flex-basis: 50%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
            Action</div>
    </div>
    @foreach ($securitInformations as $securitInformation)
        <div class="flex flex-row bg-white rounded-b-lg">
            <!-- Data Row -->
            <div class="flex items-start justify-start flex-none border-b border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                @if ($securitInformation->is($editing))
                    <livewire:securityinformation.edit :securitInformation="$securitInformation" :key="$securitInformation->id" />
                @else
                    {{ $securitInformation->name }}
                @endif

            </div>
            <div class="flex items-center justify-center flex-none border-b border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                <button wire:click.prevent="edit('{{ $securitInformation->id }}')" type="button"
                    class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Edit') }}
                </button>
                <button wire:click.prevent="delete('{{ $securitInformation->id }}')" type="button"
                    class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    @endforeach
</div>
