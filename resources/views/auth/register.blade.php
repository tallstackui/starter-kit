<x-guest-layout>
    <x-card shadowless bordered :header="__('Register')">
        <form id="register" method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <x-input label="Name *" name="name" :value="old('name')" required autofocus autocomplete="name" />

            <x-input label="Email *" type="email" name="email" :value="old('email')" required autocomplete="username" />

            <x-password label="Password *" name="password" required autocomplete="new-password" />

            <x-password label="Confirm Password *" name="password_confirmation" required autocomplete="new-password" />
        </form>

        <x-slot:footer between>
            <x-link :href="route('login')" :text="__('Already registered?')" sm underline colorless />

            <x-button submit form="register" :text="__('Register')" />
        </x-slot:footer>
    </x-card>
</x-guest-layout>
