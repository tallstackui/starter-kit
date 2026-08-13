<div class="space-y-6">
    @if ($this->enabled)
        <x-alert :text="__('Two-factor authentication is enabled on your account.')" color="green" icon="shield-check" />

        @if ($showingRecoveryCodes)
            <div class="space-y-3">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your authenticator device is lost.') }}
                </p>

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    @foreach ($this->recoveryCodes as $recoveryCode)
                        <code class="rounded-md bg-gray-100 px-3 py-2 text-sm dark:bg-gray-800">{{ $recoveryCode }}</code>
                    @endforeach
                </div>

                <x-clipboard :text="implode(PHP_EOL, $this->recoveryCodes)" :label="__('Copy recovery codes')" secret />
            </div>
        @endif

        <form id="disable-two-factor" wire:submit="disable" class="space-y-2">
            <x-password :label="__('Current password') . ' *'"
                        wire:model="current_password"
                        autocomplete="current-password"
                        required />
        </form>

        <div class="flex flex-wrap justify-end gap-2">
            <x-button :text="$showingRecoveryCodes ? __('Hide recovery codes') : __('Show recovery codes')"
                      round
                      wire:click="toggleRecoveryCodes" />

            <x-button :text="__('Regenerate recovery codes')"
                      color="amber"
                      round
                      wire:click="regenerate"
                      loading="regenerate" />

            <x-button submit form="disable-two-factor" :text="__('Disable')" color="red" round loading="disable" />
        </div>
    @elseif ($this->pending)
        <x-alert :text="__('Scan the QR code with your authenticator app, then enter the 6-digit code to finish enabling two-factor authentication.')"
                 color="primary"
                 icon="qr-code" />

        <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-start">
            <x-qr-code :link="$this->qrCodeUrl" size="lg" />

            <div class="w-full space-y-4">
                <x-clipboard :text="$this->setupKey" :label="__('Setup key')" secret />

                <form id="confirm-two-factor" wire:submit="confirm" class="space-y-2">
                    <x-pin wire:model="code" label="{{ __('Authentication code') }} *" :length="6" numbers />
                </form>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <x-button :text="__('Cancel')" color="red" round wire:click="cancel" loading="cancel" />

            <x-button submit form="confirm-two-factor" :text="__('Confirm')" round loading="confirm" />
        </div>
    @else
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You can retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        <form id="enable-two-factor" wire:submit="enable" class="space-y-2">
            <x-password :label="__('Current password') . ' *'"
                        wire:model="current_password"
                        autocomplete="current-password"
                        required />
        </form>

        <div class="flex justify-end">
            <x-button submit form="enable-two-factor" :text="__('Enable')" loading="enable" />
        </div>
    @endif
</div>
