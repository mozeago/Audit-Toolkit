<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\SecuritySections;
new class extends Component {
    public Collection $securitySections;
    public ?SecuritySections $editing = null;

    public function mount()
    {
        $this->getSecuritySections();
    }

    #[On('security-section-created')]
    public function getSecuritySections()
    {
        $this->securitySections = SecuritySections::orderBy('created_at', 'desc')->get();
    }

    public function edit(SecuritySections $securitySection)
    {
        $this->editing = $securitySection;
    }

    #[On('security-section-edit-canceled')]
    #[On('security-section-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getSecuritySections();
    }

    public function delete(SecuritySections $securitySection): void
    {
        $securitySection->delete();
        $this->getSecuritySections();
    }
}; ?>
<div class="bg-white shadow-2xl hover:shadow-none">
    <div class="flex flex-row rounded-t-lg bg-[#1C4863] text-white">
        <!-- Header Row -->
        <div style="flex-basis: 50%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
            Name</div>
        <div style="flex-basis: 50%;" class="flex items-center justify-center uppercase sm:p-2 md:p-4">
            Action</div>
    </div>
    @foreach ($securitySections as $securitySection)
        <div class="flex flex-row bg-white rounded-b-lg">
            <!-- Data Row -->
            <div class="flex items-start justify-start flex-none border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                @if ($securitySection->is($editing))
                    <livewire:securitysections.edit :securitySections="$securitySection" :key="$securitySection->id" />
                @else
                    {{ $securitySection->name }}
                @endif

            </div>
            <div class="flex items-center justify-center flex-none border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                <button wire:click.prevent="edit('{{ $securitySection->id }}')" type="button"
                    class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Edit') }}
                </button>
                {{-- <button wire:click.prevent="delete('{{ $securitySection->id }}')" type="button"
                    class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                    {{ __('Delete') }}
                </button> --}}
            </div>
        </div>
    @endforeach
</div>
