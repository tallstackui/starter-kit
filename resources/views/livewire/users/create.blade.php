<div>
    <x-button :text="__('Create New User')" wire:click="$toggle('modal')" round />

    <x-modal :title="__('Create New User')" wire x-on:open="$tsui.focus('name')">
        <form id="user-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Name') }} *"
                         x-ref="name"
                         wire:model="user.name"
                         required />
            </div>

            <div>
                <x-input label="{{ __('Email') }} *"
                         wire:model="user.email"
                         required />
            </div>

            <div>
                <x-password label="{{ __('Password') }} *"
                            wire:model="password"
                            rules
                            generator="password_confirmation"
                            required />
            </div>

            <div>
                <x-password label="{{ __('Confirm Password') }} *"
                            wire:model="password_confirmation"
                            rules
                            required />
            </div>
        </form>
        <x-slot:footer>
            <x-button submit form="user-create" :text="__('Save')" loading="save" round />
        </x-slot:footer>
    </x-modal>
</div>
