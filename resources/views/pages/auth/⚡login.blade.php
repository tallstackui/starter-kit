<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

new #[Layout('layouts.guest')] #[Title('Registration')] class extends Component {
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';

    public bool $remember = false;

    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/dashboard');
        }
    }

    public function login()
    {
        $credentials = $this->validate();

        if (auth()->attempt($credentials, $this->remember)) {
            request()->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }
};
?>

<div>
    <div class="my-6 flex items-center justify-center">
        <img src="{{ asset('/assets/images/tsui.png') }}" />
    </div>

    <form wire:submit="login">
        <div class="space-y-4">
            <x-input label="Email *" type="email" wire:model="email" required autofocus autocomplete="username" />

            <x-password
                label="Password *"
                type="password"
                wire:model="password"
                required
                autocomplete="current-password"
            />
        </div>

        <div class="mt-4 block">
            <x-checkbox label="Remember me" id="remember_me" type="checkbox" wire:model="remember" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            @if (Route::has('register'))
                <x-button href="{{ route('register') }}" class="ms-4" color="secondary" flat wire:navigate>
                    {{ __('Sign up') }}
                </x-button>
            @endif

            <x-button type="submit" class="ms-3"> {{ __('Log in') }} </x-button>
        </div>
    </form>
</div>
