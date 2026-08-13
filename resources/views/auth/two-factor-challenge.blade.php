<x-guest-layout>
    <div x-data="{ recovery: false }">
    <x-card shadowless bordered :header="__('Two-factor authentication')">
        <form id="two-factor-challenge" method="POST" action="{{ route('two-factor.login.store') }}" class="space-y-4">
            @csrf

            <div x-show="!recovery">
                <p class="mb-4 text-sm text-gray-600">
                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                </p>

                <x-pin name="code" label="Code *" :length="6" numbers />
            </div>

            <div x-show="recovery" x-cloak>
                <p class="mb-4 text-sm text-gray-600">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </p>

                <x-input name="recovery_code" label="Recovery Code *" autocomplete="one-time-code" />
            </div>
        </form>

        <x-slot:footer between>
            <button type="button"
                    class="cursor-pointer text-sm text-gray-600 underline hover:text-gray-900"
                    x-on:click="recovery = !recovery"
                    x-text="recovery ? '{{ __('Use an authentication code') }}' : '{{ __('Use a recovery code') }}'">
            </button>

            <x-button submit form="two-factor-challenge" :text="__('Log in')" />
        </x-slot:footer>
    </x-card>
    </div>
</x-guest-layout>
