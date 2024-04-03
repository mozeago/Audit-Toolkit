<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex flex-col gap-4 mt-4">
        <a href="{{ route('google.redirect') }}"
            class="inline-flex items-center px-4 py-2 font-bold text-white bg-gray-800 rounded-lg cursor-pointer hover:bg-opacity-75">
            <img src="{{ asset('images/google_logo.png') }}" alt="Google Logo" class="w-4 h-4 mr-2"> Log in with Google
        </a>
    </div>
</div>
