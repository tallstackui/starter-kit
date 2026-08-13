<div>
    <x-modal :title="__('Update User: #:id', ['id' => $user?->id])" wire>
        <form id="user-update-{{ $user?->id }}" wire:submit="save" class="space-y-4">
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
                            hint="The password will only be updated if you set the value of this field"
                            wire:model="password"
                            rules
                            generator="confirm-password-{{ $user?->id }}" />
            </div>

            <div>
                <x-password label="{{ __('Confirm Password') }} *"
                            id="confirm-password-{{ $user?->id }}"
                            wire:model="password_confirmation"
                            rules />
            </div>
        </form>
        <x-slot:footer>
            <x-button submit form="user-update-{{ $user?->id }}" :text="__('Save')" loading="save" round />
        </x-slot:footer>
    </x-modal>
</div>
