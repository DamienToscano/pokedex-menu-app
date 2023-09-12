<?php

use App\Models\Pokemon;
use Illuminate\Support\Stringable;
use function Livewire\Volt\computed;
use function Livewire\Volt\state;

state(['pokemons' => fn () => Pokemon::get()]);

?>

<x-layout>
    @volt
    <div>
        <x-titles.h1>Pokedex</x-titles.h1>
        <div class="grid grid-cols-4 gap-3">
            @foreach ($pokemons as $pokemon)
            <a class="bg-white" href="/pokemons/{{ $pokemon->id }}" wire:navigate>
                <div class="flex items-center p-2 border-2 border-gray-400 rounded hover:border-black outline outline-2 outline-offset-1 outline-gray-600 hover:outline-black">

                    <img class="w-auto h-16" src="{{ $pokemon->image }}" alt='Image of {{ $pokemon->name }}'>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endvolt
</x-layout>