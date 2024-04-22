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
        if (!session()->has('questionnaire_completed') || session()->get('questionnaire_completed') === false) {
            $this->redirect()->route('risk-analysis-questionnaire');
        } else {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>
<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input wire:model="form.email" id="email" class="block w-full mt-1 rounded-md" type="email"
                name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block w-full mt-1 rounded-md" type="password"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <!-- Remember Me -->
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="text-indigo-600 border-gray-300 rounded-sm shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
            </label>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-700 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 "
                    href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <div class="flex items-center justify-end mt-4 mb-4">
            <button type="submit"
                class="w-full px-4 py-2 font-bold text-white bg-red-600 rounded hover:shadow-xl hover:text-black hover:bg-red-700 focus:outline-none focus:shadow-outline"
                style="background-color: #BA0C2F;">
                {{ __('Log in') }}
            </button>
        </div>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('register'))
                <a class="text-sm text-blue-700 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 "
                    href="{{ route('register') }}" wire:navigate>
                    {{ __('Dont have an account, Register') }}
                </a>
            @endif
        </div>
    </form>

    <div class="flex items-center justify-center mt-4 mb-4 text-gray-600">
        <div class="flex-grow border-b border-gray-300"></div>
        <span class="px-3 font-bold">or login with</span>
        <div class="flex-grow border-b border-gray-300"></div>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <a href="{{ route('google.redirect') }}"
        class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-md hover:shadow-lg focus:outline-none">
        <img src="{{ asset('images/google_logo.png') }}" alt="Google Logo" class="w-8 h-8">
    </a>
</div>
