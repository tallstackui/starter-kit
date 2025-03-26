<div>
    <x-card>
        <x-slot:header>
            Edit Your Profile
        </x-slot:header>
        <form id="update-profile" wire:submit="save">
            <div class="space-y-6">
                <div>
                    <x-input label="Name *" wire:model="user.name" required />
                </div>
                <div>
                    <x-input label="Email *" value="{{ $user->email }}" disabled />
                </div>
                <div>
                    <x-password label="Password"
                                hint="The password will only be updated if you set the value of this field"
                                wire:model="password"
                                rules
                                generator
                                x-on:generate="$wire.set('password_confirmation', $event.detail.password)" />
                </div>
                <div>
                    <x-password label="Password" wire:model="password_confirmation" rules />
                </div>
            </div>
            <x-slot:footer>
                <x-button type="submit">
                    Save
                </x-button>
            </x-slot:footer>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="update-profile">
                Save
            </x-button>
        </x-slot:footer>
    </x-card>
</div>
