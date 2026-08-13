<div class="space-y-6">
    @if ($this->enabled)
        <x-alert :text="__('Two-factor authentication is enabled on your account.')" color="green" icon="shield-check" />

        <form id="disable-two-factor" wire:submit="disable" class="space-y-2">
            <x-password label="{{ __('Current Password') }} *"
                        wire:model="current_password"
                        autocomplete="current-password"
                        required />
        </form>

        <div class="flex flex-wrap items-center justify-end gap-2">
            <x-button :text="__('Show Recovery Codes')"
                      color="primary"
                      round
                      sm
                      x-on:click="$tsui.open.modal('recovery-codes')" />

            <x-button submit form="disable-two-factor" :text="__('Disable')" color="red" round loading="disable" />
        </div>
    @elseif ($this->pending)
        <x-alert :text="__('Scan the QR code with your authenticator app, then enter the 6-digit code to finish enabling two-factor authentication.')"
                 color="primary"
                 icon="qr-code" />

        <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-start">
            <x-qr-code :link="$this->qrCodeUrl" size="lg" />

            <div class="w-full space-y-4">
                <x-clipboard :text="$this->setupKey" label="{{ __('Setup key') }}" secret />

                <form id="confirm-two-factor" wire:submit="confirm" class="space-y-2">
                    <x-pin wire:model="code" label="{{ __('Authentication Code') }} *" :length="6" numbers />
                </form>
            </div>
        </div>

        <div class="flex justify-end items-center gap-2">
            <x-button :text="__('Cancel')" color="red" round wire:click="cancel" loading="cancel" sm />

            <x-button submit form="confirm-two-factor" :text="__('Confirm')" round loading="confirm" />
        </div>
    @else
        <p class="text-sm text-dark-600 dark:text-gray-100">
            {{ __('When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You can retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        <form id="enable-two-factor" wire:submit="enable" class="space-y-2">
            <x-password label="{{ __('Current Password') }} *"
                        wire:model="current_password"
                        autocomplete="current-password"
                        required />
        </form>

        <div class="flex justify-end">
            <x-button submit form="enable-two-factor" :text="__('Enable')" loading="enable" />
        </div>
    @endif

    @if ($this->enabled || $this->pending)
        <livewire:user.profile.recovery-codes />
    @endif
</div>
