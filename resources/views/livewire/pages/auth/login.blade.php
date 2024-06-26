<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\User;

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
        if ($this->riskAnalysisCompleted() === 'true') {
            redirect()->intended(route('risk-analysis-questionnaire'));
        } else {
            redirect('risk-analysis-questionnaire');
        }
    }
    public function riskAnalysisCompleted()
    {
        $userId = auth()->id();
        return User::find($userId)->qa_analysis_complete ?? false;
    }
}; ?>

<div class="w-3/4 bg-white shadow-2xl rounded-xl">
    <div class="flex justify-between rounded-xl">
        <!-- Black Bg -->
        <div class="relative flex items-center justify-center w-1/2 bg-black rounded-l-xl">
            <img src="{{ asset('images/lamp-suspended.webp') }}" alt="Your Image" class="block w-1/2 h-auto">
            <div class="w-full">
                <p class="mb-2 font-bold text-left text-white roboto-condensed-header-900">Welcome to Data Protection
                    Portal
                    !</p>
                <p class="text-gray-300 roboto-regular">Discover essential resources and guideline to safeguard sensitive
                    information
                    and
                    ensure compliance with
                    regulations.</p>
            </div>
        </div>
        <!-- end black Bg -->
        <div class="w-1/2 p-4"><x-auth-session-status class="mb-4" :status="session('status')" />
            <h2 class="mb-4 text-lg font-semibold text-center text-gray-800">Sign in</h2>
            <form wire:submit="login">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email address')" />
                    <x-text-input placeholder="Email Adrress" wire:model="form.email" id="email"
                        class="block w-full mt-1 rounded-md" type="email" name="email" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input placeholder="Password" wire:model="form.password" id="password"
                        class="block w-full mt-1 rounded-md" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <!-- Remember Me -->
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="text-[#C8000B] border-gray-300 rounded-sm shadow-sm focus:ring-[#C8000B]"> <span
                            class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                    </label>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-700 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 "
                            href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center justify-end mt-4 mb-4">
                    <button type="submit"
                        class="w-full px-4 py-2 font-bold text-white transition-transform duration-300 bg-red-600 rounded hover:shadow-2xl hover:text-gray-300 hover:bg-red-700 focus:outline-none focus:shadow-outline"
                        style="background-color: #BA0C2F;" onmouseover="this.style.transform = 'scale(1.05)'"
                        onmouseout="this.style.transform = 'scale(1)'">
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

            {{-- <div class="flex items-center justify-center mt-4 mb-4 text-gray-600">
                <div class="flex-grow border-b border-gray-300"></div>
                <span class="px-3 font-bold">or login with</span>
                <div class="flex-grow border-b border-gray-300"></div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="flex items-center justify-center">
                <a href="{{ route('google.redirect') }}"
                    class="w-full inline-flex items-center justify-center p-2 bg-white shadow-md hover:shadow-xl hover:text-[#C8000B] hover:font-semibold focus:outline-none rounded-md">
                    <img src="{{ asset('images/google_logo.webp') }}" alt="Google Logo" class="w-8 h-8 mr-2">
                    <span>Sign in With Google</span>
                </a>
            </div> --}}
        </div>
    </div>
</div>
