<?php

use App\Exceptions\PokemonNotFoundException;
use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use function Laravel\Folio\name;

?>

<x-layout>
    @volt
    <div>
        <div class="flex items-baseline justify-between">
            <a href="/" wire:navigate.hover>
                <img class="w-auto h-6 hover:opacity-60" src="{{ Vite::asset('resources/images/arrow-left.png') }}"
                    alt="" />
            </a>
            <x-titles.h1>Who's that pokemon ?</x-titles.h1>
        </div>

        <img id="unknown-image" src="#" class="m-auto brightness-0 contrast-50">

        <p class="text-xl text-center">Sorry we have not found that pokemon in our pokedex</p>
    </div>
    @endvolt
</x-layout>

<script>
    let count = 1
    const intervalId = setInterval(function() {
        let id = Math.floor(Math.random() * 151)
        let url = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png`
        document.querySelector('#unknown-image').setAttribute('src', url)
    }, 200);
</script>