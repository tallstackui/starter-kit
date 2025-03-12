<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
            <x-input label="Email *" type="email" name="email" :value="old('email', 'test@example.com')" required autofocus autocomplete="username" />

            <x-password label="Password *" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <x-checkbox label="Remember me" id="remember_me" type="checkbox" name="remember" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-button type="submit" class="ms-3">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
