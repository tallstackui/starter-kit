<div @updated="$dispatch('name-updated', { name: $event.detail.name })">
    <x-tab selected="profile" shadowless bordered scroll-on-mobile>
        <x-tab.items tab="profile" :title="__('Profile')">
            <livewire:user.profile.information />
        </x-tab.items>

        <x-tab.items tab="password" :title="__('Password')">
            <livewire:user.profile.password />
        </x-tab.items>

        <x-tab.items tab="two-factor" :title="__('Two Factor Authentication')">
            <livewire:user.profile.two-factor-authentication />
        </x-tab.items>
    </x-tab>
</div>
