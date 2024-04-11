<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="mx-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <livewire:dashboard.userchart />
    </div>
</x-app-layout>
