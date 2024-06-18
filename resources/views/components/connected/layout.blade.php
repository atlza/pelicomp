<x-layout>

    <x-slot name="nav">
        <div class="text-gray-400/70 flex  font-medium uppercase">
            <i data-lucide="film" class="mr-2"></i>Compte
        </div>
        <a
            href="{{ route('user-home') }}"
            class="flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white">
            <span>Accueil</span>
        </a>
        <a
            href="{{ route('films-popular') }}"
            class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white ">
            <span>Notifications</span>
        </a>
        <a
            href="{{ route('films-popular') }}"
            class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white ">
            <span>Listes</span>
        </a>
        <a
            href="{{ route('films-popular') }}"
            class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white ">
            <span>Préférences</span>
        </a>
    </x-slot>

    {{ $userContent }}

</x-layout>


