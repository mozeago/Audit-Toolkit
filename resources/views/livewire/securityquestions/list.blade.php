<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\SecurityQuestions;
new class extends Component {
    public Collection $securitQuestions;
    public ?SecurityQuestions $editing = null;

    public function mount()
    {
        $this->getSecurityQuestions();
    }

    #[On('security-questions-created')]
    public function getSecurityQuestions()
    {
        $this->securitQuestions = SecurityQuestions::orderBy('created_at', 'desc')->get();
    }

    public function edit(SecurityQuestions $securitQuestions)
    {
        $this->editing = $securitQuestions;
    }

    #[On('security-questions-edit-canceled')]
    #[On('security-questions-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getSecurityQuestions();
    }

    public function delete(SecurityQuestions $securitQuestions): void
    {
        $securitQuestions->delete();
        $this->getSecurityQuestions();
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
    @foreach ($securitQuestions as $securitQuestion)
        <div class="flex flex-row bg-white rounded-b-lg">
            <!-- Data Row -->
            <div class="flex items-start justify-start flex-none border-b border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                @if ($securitQuestion->is($editing))
                    <livewire:securityquestions.edit :securitQuestion="$securitQuestion" :key="$securitQuestion->id" />
                @else
                    {{ $securitQuestion->text }}
                @endif

            </div>
            <div class="flex items-center justify-center flex-none border-b border-r border-gray-300 sm:p-1 md:p-4"
                style="flex-basis: 50%;">
                <button wire:click.prevent="edit('{{ $securitQuestion->id }}')" type="button"
                    class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Edit') }}
                </button>
                <button wire:click.prevent="delete('{{ $securitQuestion->id }}')" type="button"
                    class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    @endforeach
</div>
