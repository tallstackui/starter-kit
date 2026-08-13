<?php

declare(strict_types=1);

namespace App\Livewire\User\Profile;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Traits\Alert;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RecoveryCodes extends Component
{
    use Alert;

    public User $user;

    #[On('mount')]
    public function mount(): void
    {
        $this->user = user();
    }

    public function render(): View
    {
        return view('livewire.user.profile.recovery-codes');
    }

    #[Computed]
    public function recoveryCodes(): array
    {
        if (blank($this->user->two_factor_recovery_codes)) {
            return [];
        }

        return $this->user->recoveryCodes();
    }

    public function download(): StreamedResponse
    {
        $codes = implode(PHP_EOL, $this->recoveryCodes());

        return response()->streamDownload(static function () use ($codes): void {
            echo $codes;
        }, $this->downloadFilename());
    }

    public function downloadFilename(): string
    {
        return 'recovery_codes-'.config('app.name').'_'.$this->user->email.'.txt';
    }

    public function regenerate(GenerateNewRecoveryCodes $generate): void
    {
        try {
            $generate($this->user);

            $this->user = $this->user->fresh() ?? user();

            unset($this->recoveryCodes);

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }
}
