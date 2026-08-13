<div>
    <form id="update-profile" wire:submit="save" class="space-y-2">
        <div class="grid gap-4 sm:grid-cols-2">
            <x-input label="{{ __('Name') }} *" wire:model="user.name" required />

            <x-input label="{{ __('Email') }}" :value="$user->email" disabled />
        </div>
    </form>

    <div class="mt-6 flex items-center justify-between">
        <livewire:user.profile.delete />

        <x-button submit form="update-profile" :text="__('Save')" loading="save" round />
    </div>
</div>
