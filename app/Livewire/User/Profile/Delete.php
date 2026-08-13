<?php

declare(strict_types=1);

namespace App\Livewire\User\Profile;

use Exception;
use App\Models\User;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Traits\Alert;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    use Alert;

    public User $user;

    public ?string $password = null;

    public bool $modal = false;

    protected array $validationAttributes = [
        'password' => 'password',
    ];

    #[On('mount')]
    public function mount(): void
    {
        $this->user = user();
    }

    public function render(): View
    {
        return view('livewire.user.profile.delete');
    }

    public function confirm(): void
    {
        $this->validate(['password' => ['required', 'string', 'current_password']]);

        $this->modal = false;

        $this->question()
            ->confirm(method: 'delete')
            ->cancel()
            ->send();
    }

    public function delete(): void
    {
        try {
            Auth::logout();

            $this->user->delete();

            session()->invalidate();
            session()->regenerateToken();

            $this->redirect(route('welcome'));

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }
}
