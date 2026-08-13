<x-guest-layout>
    <div x-data="{ recovery: false }">
        <x-card shadowless bordered :header="__('Two-factor authentication')">
            <form id="two-factor-challenge" method="POST" action="{{ route('two-factor.login.store') }}" class="space-y-4">
                @csrf

                <div x-show="!recovery">
                    <p class="mb-4 text-sm text-gray-600">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </p>

                    <div class="flex justify-center">
                        <x-pin name="code" label="Code *" :length="6" numbers />
                    </div>
                </div>

                <div x-show="recovery" x-cloak>
                    <p class="mb-4 text-sm text-gray-600">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </p>

                    <x-input name="recovery_code" label="Recovery Code *" autocomplete="one-time-code" />
                </div>
            </form>

            <x-slot:footer>
                <div class="flex w-full flex-col gap-y-2">
                    <x-button submit form="two-factor-challenge" :text="__('Log in')" block round />

                    <span class="text-center text-sm text-gray-600">
                        <button type="button"
                                class="cursor-pointer font-semibold text-primary-500"
                                x-on:click="recovery = !recovery"
                                x-text="recovery ? '{{ __('Use an authentication code') }}' : '{{ __('Use a recovery code') }}'">
                        </button>
                    </span>
                </div>
            </x-slot:footer>
        </x-card>
    </div>
</x-guest-layout>
