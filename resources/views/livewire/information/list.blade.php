<?php

use Livewire\Volt\Component;
use App\Models\Information;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
new class extends Component {
    public Collection $questionsInformation;
    public ?Information $editing = null;
    public function mount()
    {
        $this->fetchQuestionInformation();
    }

    #[On('question-information-created')]
    public function fetchQuestionInformation()
    {
        $this->questionsInformation = Information::orderBy('created_at', 'desc')->get();
    }

    public function edit(Information $questionInfo)
    {
        $this->editing = $questionInfo;
        $this->fetchQuestionInformation();
    }
    #[On('information-updated')]
    #[On('information-edit-cancelled')]
    public function disableEditing()
    {
        $this->editing = null;
        $this->fetchQuestionInformation();
    }

    public function delete(Information $questionInfo)
    {
        $questionInfo->delete();
        $this->fetchQuestionInformation();
    }
}; ?>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase border-b border-gray-200">
                    Information
                </th>
                <th
                    class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-700 uppercase border-b border-gray-200">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questionsInformation as $questionInformation)
                <tr class="hover:bg-gray-100 ">
                    <td class="px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                        @if ($questionInformation->is($editing))
                            <livewire:information.edit :information="$questionInformation" :key="$questionInformation->id" />
                        @else
                            {{ $questionInformation->content }}
                        @endif
                    </td>
                    <td class="flex justify-end px-5 py-5 text-sm font-normal text-gray-700 border-b border-gray-200">
                        <button wire:click.prevent="edit('{{ $questionInformation->id }}')" type="button"
                            class="inline-flex px-2 py-1 text-sm font-medium text-blue-500 border rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Edit') }}
                        </button>
                        <button wire:click.prevent="delete('{{ $questionInformation->id }}')" type="button"
                            class="inline-flex px-2 py-1 ml-2 text-sm font-medium text-red-500 border rounded-full hover:bg-red-100 focus">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
