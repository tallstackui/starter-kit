<?php

namespace App\Livewire\Traits;

use TallStackUi\Foundation\Interactions\Dialog;
use TallStackUi\Traits\Interactions;

trait Alert
{
    use Interactions;

    public function success(string $title = 'Done!', string $description = 'Task completed successfully.'): void
    {
        $this->dialog()
            ->success(__($title), __($description))
            ->send();
    }

    public function error(string $title = 'Ooops!', string $description = 'Something went wrong!'): void
    {
        $this->dialog()
            ->error(__($title), __($description))
            ->send();
    }

    public function warning(string $title = 'Ooops!', string $description = null): void
    {
        $this->dialog()
            ->warning(__($title), __($description))
            ->send();
    }

    public function info(string $title = 'Warning!', string $description = null): void
    {
        $this->dialog()
            ->info(__($title), __($description))
            ->send();
    }

    public function question(string $title = 'Warning!', string $description = 'Are you sure?'): Dialog
    {
        return $this->dialog()->question(__($title), __($description));
    }
}
