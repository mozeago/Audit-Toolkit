<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SecurityRecommendations;
use App\Models\SecurityQuestions;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public SecurityRecommendations $securityRecommendation;
    public Collection $securityQuestions;
    public string $name = '';
    public string $questionId = '';
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'questionId' => 'required|max:36',
        ];
    }
    public function mount()
    {
        $this->name = $this->securityRecommendation->name;
        $this->questionId = $this->securityRecommendation->security_questions_id;
        $this->fetchSecurityQuestions();
    }
    public function fetchSecurityQuestions()
    {
        $this->securityQuestions = SecurityQuestions::orderBy('created_at', 'desc')->get();
    }
    public function update(): void
    {
        $validatedData = $this->validate();
        $this->securityRecommendation->update([
            'name' => $validatedData['name'],
            'security_questions_id' => $validatedData['questionId'],
        ]);
        $this->dispatch('security-recommendation-updated');
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
                <label for="name" class="form-label">{{ __('Recommendation Text') }}</label>
                <textarea wire:model="name" id="name" class="form-control @error('name') is-invalid @enderror" rows="4"
                    cols="50"></textarea>
                @error('name')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full mb-4">
                <select wire:model="questionId" id="questionId"
                    class="block w-full p-3 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="" disabled selected>{{ __('Select ...') }}</option>
                    @foreach ($securityQuestions as $securityQuestion)
                        <option value="{{ $securityQuestion->id }}">{{ $securityQuestion->text }}</option>
                    @endforeach
                </select>
                @error('questionId')
                    <div class="text-red-500 invalid-feedback error-class">{{ $message }}</div>
                @enderror
            </div>
            <x-primary-button type="submit" class="btn btn-primary">{{ __('Update') }}</x-primary-button>
            <button wire:click.prevent="cancel" type="button" class="btn btn-secondary">{{ __('Cancel') }}</button>
        </form>
    </div>
</div>
