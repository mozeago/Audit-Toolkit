<?php

use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\SecuritySections;
new class extends Component {
    public SecuritySections $securitySections;
    public string $name;

    public function mount(SecuritySections $securitySections)
    {
        $this->securitySections = $securitySections;
        $this->name = $securitySections->name;
    }

    #[Validate('required|string|max:255')]
    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->securitySections->update($validatedData);

        $this->dispatch('security-section-updated');
    }

    public function cancel()
    {
        $this->dispatch('security-section-edit-canceled');
    }
}; ?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col space-y-4">
                <div class="flex border border-gray-300 rounded-md shadow-sm">
                    <input wire:model="name" type="text"
                        class="flex-grow p-3 border-r border-gray-300 focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-l-md"
                        placeholder="Security Section Name">
                    @error('name')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-start space-x-4">
                    <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
                    <button wire:click.prevent="cancel" type="button"
                        class="btn btn-secondary">{{ __('Cancel') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
