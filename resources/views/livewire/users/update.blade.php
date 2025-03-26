<div>
    <x-button.circle icon="pencil" wire:click="$toggle('modal')" />

    <x-modal :title="__('Update User: #:id', ['id' => $user->id])" wire>
        <form id="user-update-{{ $user->id }}" wire:submit="save" class="space-y-6">
            <div>
                <x-input label="Name *" wire:model="user.name" required />
            </div>

            <div>
                <x-input label="Email *" wire:model="user.email" required />
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
        </form>
        <x-slot:footer>
            <x-button type="submit" form="user-update-{{ $user->id }}">
                Save
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
