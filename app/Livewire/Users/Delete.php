<?php

namespace App\Livewire\Users;

use App\Livewire\Traits\Alert;
use App\Models\User;
use Exception;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Delete extends Component
{
    use Alert;

    public User $user;

    public function render(): string
    {
        return <<<'HTML'
        <div>
            <x-button.circle icon="trash" color="red" wire:click="confirm" />
        </div>
        HTML;
    }

    #[Renderless]
    public function confirm(): void
    {
        $this->question()
            ->confirm(method: 'delete')
            ->cancel()
            ->send();
    }

    public function delete(): void
    {
        try {
            $this->user->delete();

            $this->dispatch('deleted');
            $this->success();

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }
}
