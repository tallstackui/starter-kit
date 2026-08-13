<?php

declare(strict_types=1);

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Contracts\View\View;

#[Title('Profile')]
class Profile extends Component
{
    public function render(): View
    {
        return view('livewire.user.profile');
    }
}
