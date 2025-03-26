<?php

namespace App\Livewire\Users;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public function render(): View
    {
        return view('livewire.users.create');
    }
}
