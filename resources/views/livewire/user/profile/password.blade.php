<div>
    <form id="update-password" wire:submit="save" class="space-y-2">
        <div class="grid gap-4 sm:grid-cols-3">
            <x-password :label="__('Current Password') . ' *'"
                        wire:model="current_password"
                        autocomplete="current-password"
                        required />

            <x-password :label="__('New Password') . ' *'"
                        wire:model="password"
                        rules
                        generator="password_confirmation"
                        autocomplete="new-password"
                        required />

            <x-password :label="__('Confirm Password') . ' *'"
                        wire:model="password_confirmation"
                        autocomplete="new-password"
                        required />
        </div>
    </form>

    <div class="mt-6 flex justify-end">
        <x-button submit form="update-password" :text="__('Save')" loading="save" />
    </div>
</div>
