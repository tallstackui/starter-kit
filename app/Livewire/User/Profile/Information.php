<?php

declare(strict_types=1);

namespace App\Livewire\User\Profile;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Traits\Alert;
use Illuminate\Contracts\View\View;

class Information extends Component
{
    use Alert;

    public User $user;

    protected array $validationAttributes = [
        'user.name' => 'Name',
    ];

    #[On('mount')]
    public function mount(): void
    {
        $this->user = user();
    }

    public function rules(): array
    {
        return [
            'user.name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.user.profile.information');
    }

    public function save(): void
    {
        $this->validate();

        try {
            $this->user->save();

            $this->dispatch('updated', name: $this->user->name);
            $this->success();

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }
}
