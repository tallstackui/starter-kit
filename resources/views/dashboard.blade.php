<x-app-layout>
    <x-card>
        <x-slot:header>
            Welcome to the TallStackUI Starter Kit
        </x-slot:header>
        <div class="space-y-2">
            <p>
                👋🏻 This is the TallStackUI starter kit for Laravel 12. With this TallStackUI starter kit you will be able to enjoy a ready-to-use application to initialize your next Laravel 12 project with TallStackUI.
            </p>
            <div class="mt-4 space-y-2">
                <i>
                    "What this starter kit includes out of the box?"
                </i>
                <ul class="ml-2 mt-2 list-inside list-decimal font-semibold">
                    <li>Laravel v12</li>
                    <li>Livewire v3</li>
                    <li>TallStackUI v2</li>
                    <li>TailwindCSS v4</li>
                </ul>
                <p>And also:</p>
                <ul class="ml-2 mt-2 list-inside list-decimal font-semibold">
                    <li><a href="https://github.com/barryvdh/laravel-debugbar" target="_blank">DebugBar</a></li>
                    <li><a href="https://github.com/larastan/larastan" target="_blank">LaraStan</a></li>
                    <li><a href="https://pestphp.com/" target="_blank">Pest</a></li>
                    <li><a href="https://laravel.com/docs/pint" target="_blank">Pint</a></li>
                </ul>
            </div>
        </div>
        <x-slot:footer>
            <span class="text-xs">
                ⚠️ <x-link href="https://tallstackui.com/docs/v2/starter-kit" bold blank sm>Make sure to read the docs about the starter kit!</x-link>
            </span>
        </x-slot:footer>
    </x-card>
</x-app-layout>
