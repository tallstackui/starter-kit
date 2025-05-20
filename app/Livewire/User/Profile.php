<?php

namespace App\Livewire\User;

use App\Livewire\Traits\Alert;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class Profile extends Component
{
    use Alert;

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
            'user.name' => [
                'required',
                'string',
                'max:255'
            ],
            'password' => [
                'nullable',
                'string',
                'confirmed',
                Rules\Password::defaults()
            ]
        ];
    }

    public function render(): View
    {
        return view('livewire.user.profile');
    }

    public function save(): void
    {
        $this->validate();

        $this->user->password = when($this->password !== null, Hash::make($this->password), $this->user->password);
        $this->user->save();

        $this->dispatch('updated', name: $this->user->name);

        $this->resetExcept('user');

        $this->success();
    }
}
