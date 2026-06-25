<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <tallstackui:script />
    @livewireStyles
    @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="font-sans antialiased"
    x-cloak
    x-data="{ name: @js(auth()->user()->name) }"
    x-on:name-updated.window="name = $event.detail.name"
    x-bind:class="{ 'dark bg-gray-800': darkTheme, 'bg-gray-100': !darkTheme }"
>
    <x-layout>
        <x-slot:top>
            <x-dialog />
            <x-toast />
        </x-slot:top>
        <x-slot:header>
            <x-layout.header>
                <x-slot:right>
                    <x-dropdown>
                        <x-slot:action>
                            <div>
                                <button class="cursor-pointer" x-on:click="show = !show">
                                    <span class="text-primary-500 text-base font-semibold" x-text="name"></span>
                                </button>
                            </div>
                        </x-slot:action>
                        <x-slot:header>
                            <x-theme-switch block />
                        </x-slot:header>
                        <x-dropdown.items :text="__('Profile')" :href="route('user.profile')" wire:navigate />
                        <x-dropdown.items :text="__('Logout')" :href="route('logout')" separator />
                    </x-dropdown>
                </x-slot:right>
            </x-layout.header>
        </x-slot:header>
        <x-slot:menu>
            <x-side-bar smart collapsible>
                <x-slot:brand>
                    <div class="my-4 flex items-center justify-center">
                        <img src="{{ asset('/assets/images/tsui.png') }}" width="40" height="40" />
                    </div>
                </x-slot:brand>
                <x-slot:brand-collapsed>
                    <div class="my-4 flex items-center justify-center">
                        <img src="{{ asset('/assets/images/tsui.png') }}" width="20" height="20" />
                    </div>
                </x-slot:brand-collapsed>
                <x-side-bar.item text="Dashboard" icon="home" :route="route('dashboard')" wire:navigate />
                <x-side-bar.item text="Welcome Page" icon="arrow-uturn-left" :route="route('welcome')" wire:navigate />
            </x-side-bar>
        </x-slot:menu>
        {{ $slot }}
    </x-layout>
    @livewireScripts
</body>
</html>
