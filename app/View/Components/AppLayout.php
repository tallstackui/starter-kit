<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function render(): View
    {
        return view('layouts.app');
    }
}
