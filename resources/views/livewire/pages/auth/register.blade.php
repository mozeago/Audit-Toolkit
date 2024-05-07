<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);
        if ($this->riskAnalysisCompleted() === 'true') {
            $this->redirect(route('dashboard', absolute: false), navigate: true);
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

<div class="w-3/4 bg-white rounded-md shadow-2xl">
    <div class="flex justify-between rounded-xl">
        <div class="relative flex items-center justify-center w-1/2 bg-black rounded-l-xl">
            <img src="{{ asset('images/lamp-suspended.jpg') }}" alt="Your Image" class="block w-1/2 h-auto">
        </div>

        <div class="w-1/2 p-4"><x-auth-session-status class="mb-4" :status="session('status')" />
            <h2 class="mb-4 text-lg font-semibold text-center text-gray-800">Register</h2>
            <form wire:submit="register">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input placeholder="Full Name" wire:model="name" id="name" class="block w-full mt-1"
                        type="text" name="name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" class="block w-full mt-1" type="email"
                        name="email" placeholder="Email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input placeholder="Password" wire:model="password" id="password" class="block w-full mt-1"
                        type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input placeholder="Confirm Password" wire:model="password_confirmation"
                        id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}" wire:navigate>
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
