<?php

use Livewire\Volt\Component;
use App\Models\User;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
new class extends Component {
    public $users;
    public User $user;
    public ?User $editing = null;
    public function mount()
    {
        $this->users = $this->getUsers();
    }
    public function edit(User $user): void
    {
        $this->editing = $user;
    }
    #[On('roleUpdated')]
    public function disableEditing()
    {
        $this->editing = null;
        $this->getUsers();
    }
    public function getUsers()
    {
        $groupedAnswers = User::select('users.id', 'users.name', 'users.email', 'users.role', 'user_responses.organization', 'user_responses.department')->leftJoin('user_responses', 'users.id', '=', 'user_responses.user_id')->groupBy('users.id', 'users.name', 'users.role', 'users.email', 'user_responses.organization', 'user_responses.department')->get();

        return $groupedAnswers;
    }
}; ?>


<div class="p-4 transition-all duration-300 bg-white shadow-xl ease hover:shadow-none">
    <div class="flex flex-col items-center justify-center mt-4 mb-4 sm:flex-row sm:items-center sm:justify-center">
        <div class="flex-grow border-b-4 border-[#C8000B] mb-4 sm:mb-0"></div>
        <span class="px-3 text-xl font-bold text-center">System Users</span>
        <div class="flex-grow border-b-4 border-[#C8000B] mb-4 sm:mb-0"></div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-300 divide-y divide-gray-200 table-auto">
            <thead class="bg-[#1C4863]">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                        Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                        Email
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                        Organization
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                        Department
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                        Role
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-medium tracking-wider text-left text-white uppercase">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="text-center transition-colors duration-300 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->organization }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($user->is($editing))
                                <livewire:userssettings.edit :user="$user" :key="$user->id" />
                            @else
                                {{ $user->role }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <a @click="showDropdown ='true'" wire:click.prevent="edit('{{ $user->id }}')">
                                <svg class="w-6 h-6 text-green-500 text-end dark:text-black hover:text-[#C8000B]"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
