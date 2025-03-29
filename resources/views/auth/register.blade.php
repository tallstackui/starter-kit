<x-guest-layout>
    <div class="my-6 flex items-center justify-center">
        <img src="{{ asset('/assets/images/tsui.png') }}" />
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input label="Name *" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <x-input label="Email *" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-password label="Password *" name="password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-password label="Confirm Password *" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button type="submit" class="ms-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
