<?php

namespace App\Livewire\Traits;

use TallStackUi\Foundation\Interactions\Dialog;
use TallStackUi\Traits\Interactions;

trait Alert
{
    use Interactions;

    public function success(string $description = 'Task completed successfully.', string $title = 'Done!'): void
    {
        $this->dialog()
            ->success(__($title), __($description))
            ->send();
    }

    public function error(string $description = 'Something went wrong!', string $title = 'Ops!'): void
    {
        $this->dialog()
            ->error(__($title), __($description))
            ->send();
    }

    public function warning(string $description = 'Hey! This is dangerous.', string $title = 'Ops!'): void
    {
        $this->dialog()
            ->warning(__($title), __($description))
            ->send();
    }

    public function info(string $description = 'Ops! Pay attention on it.', string $title = 'Warning!'): void
    {
        $this->dialog()
            ->info(__($title), __($description))
            ->send();
    }

    public function question(string $description = 'Are you sure?', string $title = 'Warning!'): Dialog
    {
        return $this->dialog()->question(__($title), __($description));
    }
}
