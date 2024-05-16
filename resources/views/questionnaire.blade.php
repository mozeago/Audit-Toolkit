<x-app-layout>
    <div
        style="background-image: url({{ asset('images/bg-questionnaire.webp') }});
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;">
        <livewire:questionnaire.list />
    </div>
</x-app-layout>
