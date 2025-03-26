<div>
    <x-button color="green" text="Create New User" wire:click="$toggle('modal')" sm />

    <x-modal :title="__('Create New User')" wire>
        <form id="user-create" wire:submit="save" class="space-y-6">
            <div>
                <x-input label="Name *" wire:model="user.name" required />
            </div>

            <div>
                <x-input label="Email *" wire:model="user.email" required />
            </div>

            <div>
                <x-password label="Password *"
                            wire:model="password"
                            rules
                            generator
                            x-on:generate="$wire.set('password_confirmation', $event.detail.password)"
                            required />
            </div>

            <div>
                <x-password label="Password" wire:model="password_confirmation" rules required />
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="user-create">
                Save
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
