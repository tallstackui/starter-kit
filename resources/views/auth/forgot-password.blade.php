<x-guest-layout>
    <x-card shadowless bordered :header="__('Forgot your password?')">
        @if (session('status'))
            <div class="mb-4">
                <x-alert :text="session('status')" color="green" />
            </div>
        @endif

        <p class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>

        <form id="forgot-password" method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <x-input label="Email *"
                     type="email"
                     name="email"
                     :value="old('email')"
                     required
                     autofocus
                     autocomplete="username"/>
        </form>

        <x-slot:footer between>
            <div class="flex flex-col w-full gap-y-2">
                <x-button submit form="forgot-password" :text="__('Email Password Reset Link')" block round/>

                <span class="text-sm text-gray-600 text-center">
                    Remembered your password?
                    <x-link :href="route('login')" :text="__('Back to log in')" sm underline colorless/>
                </span>
            </div>
        </x-slot:footer>
    </x-card>
</x-guest-layout>
