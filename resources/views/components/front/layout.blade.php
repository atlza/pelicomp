<x-layout>

    <x-slot name="nav">
        <div class="text-gray-400/70 flex  font-medium uppercase">
            Votre compte
        </div>
        <div class="text-gray-400/70 flex  font-medium uppercase">
            <i data-lucide="film" class="mr-2"></i>Films
        </div>
        <div class="text-gray-400/70 flex  font-medium uppercase">
            <i data-lucide="Tv2" class="mr-2"></i>Séries TV
        </div>
<!--        <div class="text-gray-400/70 flex  font-medium uppercase">
            <i data-lucide="Dice6" class="mr-2"></i>Jeux de société
        </div>
        <div class="text-gray-400/70 flex  font-medium uppercase">
            <i data-lucide="Book" class="mr-2"></i>Livres
        </div>-->
    </x-slot>

    {{ $frontContent }}

</x-layout>


