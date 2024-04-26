<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div style="background-image: url({{ asset('images/bg-questionnaire.jpeg') }});
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;"
        class="mx-auto overflow-hidden bg-gray-100 shadow-sm sm:rounded-lg">
        <livewire:dashboard.userchart />
    </div>
</x-app-layout>
