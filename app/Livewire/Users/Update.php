<?php

namespace App\Livewire\Users;

use App\Livewire\Traits\Alert;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    use Alert;

    public ?User $user;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.users.update');
    }

    #[On('load::user')]
    public function load(User $user): void
    {
        $this->user = $user;

        $this->modal = true;
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
                Rule::unique('users', 'email')->ignore($this->user->id),
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

        $this->user->password = when($this->password !== null, bcrypt($this->password), $this->user->password);
        $this->user->save();

        $this->dispatch('updated');

        $this->resetExcept('user');

        $this->success();
    }
}
