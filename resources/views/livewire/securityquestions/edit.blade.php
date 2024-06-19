<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SecuritySubSections;
use App\Models\SecurityQuestions;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public SecurityQuestions $securitQuestion;
    public Collection $securitySubSections;
    public string $text = '';
    public string $securitySubSectionsId = '';
    public function rules(): array
    {
        return [
            'text' => 'required|string|max:255',
            'securitySubSectionsId' => 'required|max:36',
        ];
    }
    public function mount()
    {
        $this->text = $this->securitQuestion->text;
        $this->securitySubSectionsId = $this->securitQuestion->security_sub_sections_id;
        $this->fetchSecuritySubSections();
    }
    public function fetchSecuritySubSections()
    {
        $this->securitySubSections = SecuritySubSections::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $this->validate();
        $this->securitQuestion->update([
            'text' => $this->text,
            'security_sub_sections_id' => $this->securitySubSectionsId,
        ]);
        $this->dispatch('security-questions-updated');
    }
    public function cancel(): void
    {
        $this->dispatch('security-questions-edit-canceled');
    }
}; ?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col w-full mb-4">
                <label for="text" class="form-label">{{ __('Question Text') }}</label>
                <textarea wire:model="text" id="text" class="form-control @error('text') is-invalid @enderror" rows="4"
                    cols="50"></textarea>
                @error('text')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full mb-4">
                <select wire:model="securitySubSectionsId" id="securitySubSectionsId"
                    class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="" disabled selected>{{ __('Select ...') }}</option>
                    @foreach ($securitySubSections as $securitySubSection)
                        <option value="{{ $securitySubSection->id }}">{{ $securitySubSection->name }}</option>
                    @endforeach
                </select>
                @error('securitySubSectionsId')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
            <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
        </form>
    </div>
</div>
