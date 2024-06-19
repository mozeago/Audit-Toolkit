<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SecurityInformations;
use App\Models\SecurityQuestions;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public SecurityInformations $securitInformation;
    public Collection $securitQuestions;
    public string $informationText = '';
    public string $securityQuestionId = '';
    public function rules(): array
    {
        return [
            'informationText' => 'required|string',
            'securityQuestionId' => 'required|max:36',
        ];
    }
    public function mount()
    {
        $this->informationText = $this->securitInformation->name;
        $this->securityQuestionId = $this->securitInformation->security_questions_id;
        $this->fetchSecurityQuestions();
    }
    public function fetchSecurityQuestions()
    {
        $this->securitQuestions = SecurityQuestions::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $validatedData = $this->validate();
        $this->securitInformation->update([
            'name' => $validatedData['informationText'],
            'security_questions_id' => $validatedData['securityQuestionId'],
        ]);
        $this->dispatch('security-information-updated');
    }
    public function cancel(): void
    {
        $this->dispatch('security-information-edit-canceled');
    }
}; ?>

<div class="flex w-full shadow-md">
    <div class="w-full max-w-md min-w-full px-8 py-6 leading-normal bg-white rounded">
        <form wire:submit.prevent="update">
            <div class="flex flex-col w-full mb-4">
                <label for="informationText" class="form-label">{{ __('Information Text') }}</label>
                <textarea wire:model="informationText" id="informationText"
                    class="form-control @error('informationText') is-invalid @enderror" rows="4" cols="50"></textarea>
                @error('informationText')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full mb-4">
                <select wire:model="securityQuestionId" id="securityQuestionId"
                    class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="" disabled selected>{{ __('Select ...') }}</option>
                    @foreach ($securitQuestions as $securitQuestion)
                        <option value="{{ $securitQuestion->id }}">{{ $securitQuestion->text }}</option>
                    @endforeach
                </select>
                @error('securityQuestionId')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
            <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
        </form>
    </div>
</div>
