<div>
    <x-loading loading="delete" />

    <x-button :text="__('Delete Profile')"
              color="red"
              sm
              round
              wire:click="$toggle('modal')" />

    <x-modal wire
             id="delete-profile"
             :title="__('Delete Profile')"
             center="md"
             x-on:open="$tsui.focus('password')">
        <form id="delete-profile-form" wire:submit="confirm" class="space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Are you sure you want to delete your profile? This action cannot be undone.') }}
            </p>

            <x-password label="{{ __('Current Password') }} *"
                        wire:model="password"
                        autocomplete="current-password"
                        required />
        </form>

        <x-slot:footer>
            <div class="flex flex-wrap items-center gap-2">
                <x-button :text="__('Cancel')"
                      round
                      sm
                      wire:click="$set('modal', false)" />

            <x-button submit
                      form="delete-profile-form"
                      :text="__('Delete')"
                      color="red"
                      round
                      loading="confirm" />
            </div>
        </x-slot:footer>
    </x-modal>
</div>
