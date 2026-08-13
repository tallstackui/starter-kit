<x-guest-layout>
    <x-card shadowless bordered :header="__('Reset password')">
        <form id="reset-password" method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-input label="Email *"
                     type="email"
                     name="email"
                     :value="old('email', $request->email)"
                     readonly />

            <x-password label="{{ __('Password') }} *"
                        name="password"
                        required
                        rules
                        generator="confirm_password"
                        autocomplete="new-password" />

            <x-password label="{{ __('Confirm Password') }} *"
                        id="confirm_password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />
        </form>

        <x-slot:footer>
            <x-button submit form="reset-password" :text="__('Reset Password')" block round/>
        </x-slot:footer>
    </x-card>
</x-guest-layout>
