<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" x-cloak x-bind:class="{ 'dark bg-gray-800': darkTheme, 'bg-gray-100': !darkTheme }">
    <x-layout>
        <x-slot:top>
            <x-dialog />
            <x-toast />
        </x-slot:top>
        <x-slot:header>
            <x-layout.header>
                <x-slot:left>
                    <x-theme-switch />
                </x-slot:left>
                <x-slot:right>
                    <x-dropdown text="Hello, {{ auth()->user()->name }}!">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown.items text="Logout" onclick="event.preventDefault(); this.closest('form').submit();" />
                        </form>
                    </x-dropdown>
                </x-slot:right>
            </x-layout.header>
        </x-slot:header>
        <x-slot:menu>
            <x-side-bar smart>
                <x-slot:brand>
                    <div class="flex justify-center items-center mt-6">
                        <img src="{{ asset('/assets/images/tsui.png') }}" />
                    </div>
                </x-slot:brand>
                <x-side-bar.item text="Dashboard" icon="home" :route="route('dashboard')" />
                <x-side-bar.item text="Users" icon="users" :route="route('users.index')" />
                <x-side-bar.item text="Welcome Page" icon="arrow-uturn-left" :route="route('welcome')" />
            </x-side-bar>
        </x-slot:menu>
        {{ $slot }}
    </x-layout>
    @livewireScripts
    </body>
</html>
