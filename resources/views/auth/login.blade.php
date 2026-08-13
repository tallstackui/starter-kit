<x-guest-layout>
    <x-card shadowless bordered :header="__('Log in')">
        @if (session('status'))
            <div class="mb-4">
                <x-alert :text="session('status')" color="green" />
            </div>
        @endif

        <form id="login" method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf

            <x-input label="Email *"
                     type="email"
                     name="email"
                     :value="old('email', 'test@example.com')"
                     required
                     autofocus
                     autocomplete="username" />

            <x-password label="Password *"
                        name="password"
                        required
                        autocomplete="current-password" />

            <div class="flex items-center justify-between">
                <x-checkbox label="Remember me" id="remember_me" name="remember"/>

                <x-link :href="route('password.request')" :text="__('Forgot your password?')" sm underline colorless/>
            </div>
        </form>

        <x-slot:footer>
            <div class="flex flex-col w-full gap-y-2">
                <x-button submit form="login" :text="__('Log in')" block round/>

                <span class="text-sm text-gray-600 text-center">
                    Don't have an account?
                    <x-link :href="route('register')" :text="__('Create account!')" sm bold />
                </span>
            </div>
        </x-slot:footer>
    </x-card>
</x-guest-layout>
