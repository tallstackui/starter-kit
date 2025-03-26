<?php

namespace App\Livewire\Users;

use App\Livewire\Traits\Alert;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use Alert;

    public User $user;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function mount(): void
    {
        $this->user = new User();
    }

    public function render(): View
    {
        return view('livewire.users.create');
    }

    public function rules(): array
    {
        return [
            'user.name' => [
                'required',
                'string',
                'max:255'
            ],
            'user.email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ]
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->user->password = bcrypt($this->password);
        $this->user->email_verified_at = now();
        $this->user->save();

        $this->dispatch('created');

        $this->reset();
        $this->user = new User();

        $this->success();
    }
}
