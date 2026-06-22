<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

new #[Layout('layouts.guest')] #[Title('Registration')] class extends Component {
    #[Validate('required')]
    public string $name = '';

    #[Validate('required|email|unique:users')]
    public string $email = '';

    #[Validate('required|confirmed')]
    public string $password = '';

    #[Validate('required')]
    public string $password_confirmation = '';

    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/');
        }
    }

    public function register()
    {
        $data = $this->validate();

        $data['avatar'] = '/empty-user.jpg';
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        auth()->login($user);

        request()->session()->regenerate();

        return redirect('/');
    }
};
?>

<div>
    <div class="my-6 flex items-center justify-center">
        <img src="{{ asset('/assets/images/tsui.png') }}" />
    </div>

    <form wire:submit="register">
        <div>
            <x-input label="Name *" wire:model="name" required autofocus autocomplete="name" />
        </div>
        <div class="mt-4">
            <x-input label="Email *" type="email" wire:model="email" required autocomplete="username" />
        </div>
        <div class="mt-4">
            <x-password label="Password *" wire:model="password" required autocomplete="new-password" />
        </div>
        <div class="mt-4">
            <x-password
                label="Confirm Password *"
                wire:model="password_confirmation"
                required
                autocomplete="new-password"
            />
        </div>
        <div class="mt-4 flex items-center justify-end">
            <x-button href="{{ route('login') }}" class="ms-4" color="secondary" flat wire:navigate>
                {{ __('Already registered?') }}
            </x-button>
            <x-button type="submit" class="ms-4"> {{ __('Register') }} </x-button>
        </div>
    </form>
</div>
