<?php

declare(strict_types=1);

namespace App\Livewire\User\Profile;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Laravel\Fortify\Fortify;
use App\Livewire\Traits\Alert;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;

class TwoFactorAuthentication extends Component
{
    use Alert;

    public User $user;

    public ?string $current_password = null;

    public ?string $code = null;

    protected array $validationAttributes = [
        'current_password' => 'current password',
        'code'             => 'authentication code',
    ];

    #[On('mount')]
    public function mount(): void
    {
        $this->user = user();
    }

    public function render(): View
    {
        return view('livewire.user.profile.two-factor-authentication');
    }

    #[Computed]
    public function enabled(): bool
    {
        return $this->user->hasEnabledTwoFactorAuthentication();
    }

    #[Computed]
    public function pending(): bool
    {
        return filled($this->user->two_factor_secret) && $this->user->two_factor_confirmed_at === null;
    }

    #[Computed]
    public function qrCodeUrl(): ?string
    {
        if (! $this->pending()) {
            return null;
        }

        return $this->user->twoFactorQrCodeUrl();
    }

    #[Computed]
    public function setupKey(): ?string
    {
        if (! $this->pending() || blank($this->user->two_factor_secret)) {
            return null;
        }

        return Fortify::currentEncrypter()->decrypt($this->user->two_factor_secret);
    }

    public function enable(EnableTwoFactorAuthentication $enable): void
    {
        $this->validateCurrentPassword();

        try {
            $enable($this->user);

            $this->refreshUser();
            $this->reset('current_password', 'code');

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }

    public function confirm(ConfirmTwoFactorAuthentication $confirm): void
    {
        $this->validate([
            'code' => ['required', 'string'],
        ]);

        try {
            $confirm($this->user, $this->code);

            $this->refreshUser();
            $this->reset('code', 'current_password');
            $this->js('setTimeout(() => $tsui.open.modal("recovery-codes"), 250)');

            return;
        } catch (ValidationException) {
            throw ValidationException::withMessages(['code' => [__('The provided two factor authentication code was invalid.')]]);
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }

    public function disable(DisableTwoFactorAuthentication $disable): void
    {
        $this->validateCurrentPassword();

        try {
            $disable($this->user);

            $this->refreshUser();
            $this->reset('current_password', 'code');

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }

    public function cancel(DisableTwoFactorAuthentication $disable): void
    {
        if ($this->user->hasEnabledTwoFactorAuthentication()) {
            return;
        }

        try {
            $disable($this->user);

            $this->refreshUser();
            $this->reset('code', 'current_password');

            return;
        } catch (Exception $e) {
            report($e);
        }

        $this->error();
    }

    protected function validateCurrentPassword(): void
    {
        $this->validate(['current_password' => ['required', 'string', 'current_password']]);
    }

    protected function refreshUser(): void
    {
        $this->user = $this->user->fresh() ?? user();

        unset($this->enabled, $this->pending, $this->qrCodeUrl, $this->setupKey);
    }
}
