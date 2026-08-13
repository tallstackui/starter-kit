<div>
    <x-modal id="recovery-codes" :title="__('Recovery Codes')">
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your authenticator device is lost.') }}
        </p>

        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            @foreach ($this->recoveryCodes as $code)
                <x-kbd shadowless>
                    {{ $code }}
                </x-kbd>
            @endforeach
        </div>

        <x-slot:footer>
            <div class="flex justify-between items-center w-full">
                <div class="flex flex-wrap gap-2">
                    <x-button :text="__('Refresh Codes')"
                              round
                              color="secondary"
                              sm
                              wire:click="regenerate"
                              loading="regenerate"/>

                    <x-button :text="__('Download Codes')"
                              round
                              color="secondary"
                              sm
                              wire:click="download"
                              loading="download"/>
                </div>
                <x-button :text="__('Close')"
                          round
                          x-on:click="$tsui.close.modal('recovery-codes')"/>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
