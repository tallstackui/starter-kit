<x-app-layout>
    <x-card>
        <x-slot:header>
            Welcome to the TallStackUI Starter Kit
        </x-slot:header>
        <div class="space-y-2">
            <p>
                👋🏻 This is the TallStackUI starter kit for Laravel 12. With this TallStackUI starter kit you will be able to enjoy a ready-to-use application to initialize your next Laravel 12 project with TallStackUI.
            </p>
            <div>
                <i>
                    "What this starter kit includes?"
                </i>
                <ul class="ml-2 mt-2 list-inside list-decimal font-bold">
                    <li>Laravel v12</li>
                    <li>Livewire v3</li>
                    <li>TallStackUI v2</li>
                    <li>TailwindCSS v4</li>
                </ul>
            </div>
        </div>
        <x-slot:footer>
            <span class="text-xs">
                ✨ We've prepared a basic <i>C.R.U.D.</i> for users in the app/Livewire/Users folder using several TallStackUI components. <x-link :href="route('users.index')" colorless underline>Click here to try it out!</x-link>
            </span>
        </x-slot:footer>
    </x-card>
</x-app-layout>
