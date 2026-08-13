<?php

declare(strict_types=1);

namespace App\Livewire\User\Profile;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Traits\Alert;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\View\View;

class Password extends Component
{
    use Alert;

    public User $user;

    public ?string $current_password = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    protected array $validationAttributes = [
        'current_password' => 'current password',
        'password'         => 'password',
    ];

    #[On('mount')]
    public function mount(): void
    {
        $this->user = user();
    }

    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                'string',
                'current_password',
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Rules\Password::default(),
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.user.profile.password');
    }

    public function save(): void
    {
        $this->validate();

        try {
            $this->user->update(['password' => $this->password]);

            $this->reset('current_password', 'password', 'password_confirmation');
            $this->dispatch('mount')->self();
            $this->success();

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }
}
