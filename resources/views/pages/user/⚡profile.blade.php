<?php

use Livewire\Component;
use TallStackUi\Traits\Interactions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

new class extends Component {
    use Interactions;

    public User $user;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function mount(): void
    {
        $this->user = Auth::user();
    }

    public function rules(): array
    {
        return [
            'user.name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->user->password = when($this->password !== null, Hash::make($this->password), $this->user->password);
        $this->user->save();

        $this->dispatch('updated', name: $this->user->name);

        $this->resetExcept('user');

        $this->dialog()->success('Success', 'Changes saved successfully.')->send();
    }
};
?>

<div @updated="$dispatch('name-updated', { name: $event.detail.name })">
    <x-card :header="__('Edit Your Profile')">
        <form id="update-profile" wire:submit="save">
            <div class="space-y-6">
                <div>
                    <x-input label="{{ __('Name') }} *" wire:model="user.name" required />
                </div>
                <div>
                    <x-input label="{{ __('Email') }} *" value="{{ $user->email }}" disabled />
                </div>
                <div>
                    <x-password
                        :label="__('Password')"
                        :hint="__('The password will only be updated if you set the value of this field')"
                        wire:model="password"
                        rules
                        generator
                        x-on:generate="$wire.set('password_confirmation', $event.detail.password)"
                    />
                </div>
                <div>
                    <x-password :label="__('Confirm password')" wire:model="password_confirmation" rules />
                </div>
            </div>
            <x-slot:footer>
                <x-button type="submit">
                    @lang ('Save')
                </x-button>
            </x-slot:footer>
        </form>
        <x-slot:footer>
            <div class="flex justify-end">
                <x-button type="submit" form="update-profile">
                    @lang ('Save')
                </x-button>
            </div>
        </x-slot:footer>
    </x-card>
</div>
