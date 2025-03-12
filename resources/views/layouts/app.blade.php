<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <x-layout>
                <x-slot:header>
                    <x-layout.header>
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
                    <x-side-bar smart nagivate>
                        <x-side-bar.item text="Dashboard" icon="home" :route="route('dashboard')" />
                    </x-side-bar>
                </x-slot:menu>

                {{ $slot }}
            </x-layout>
        </div>
    @livewireScripts
    </body>
</html>
