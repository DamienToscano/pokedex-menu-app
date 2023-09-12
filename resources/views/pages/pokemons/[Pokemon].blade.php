<?php
use function Laravel\Folio\name;
use function Livewire\Volt\state;

state(['pokemon' => fn () => $pokemon]);

?>

<x-layout>
    @volt
    <div>
        <div class="flex items-baseline justify-between">
            <a href="/" wire:navigate>
                <img class="w-auto h-6 hover:opacity-60" src="{{ Vite::asset('resources/images/arrow-left.png') }}"
                    alt="" />
            </a>
            <x-titles.h1>{{ $pokemon->name }}</x-titles.h1>
            <p class="text-3xl font-medium">#{{ $pokemon->id }}</p>
        </div>
        {{-- Image --}}
        <img class="mx-auto" src="{{ $pokemon->image }}" alt='Image of {{ $pokemon->name }}'>
        {{-- Info --}}
        <div
            class="p-4 mt-2 text-xs bg-white border-2 border-gray-400 rounded outline outline-2 outline-offset-1 outline-gray-600">
            <ul class="grid grid-cols-2 text-lg tracking-wide uppercase">
                <li><span class="font-semibold">Type: </span><span>{{ $pokemon->primary_type . ($pokemon->secondary_type
                        ? '
                        / ' : '') . $pokemon->secondary_type }}</span></li>
                <li><span class="font-semibold">Height: </span><span>{{ $pokemon->height }}</span></li>
                <li><span class="font-semibold">Weight: </span><span>{{ $pokemon->weight }}</span></li>
                <li><span class="font-semibold">Base Xp: </span><span>{{ $pokemon->base_experience }}</span></li>
                <li><span class="font-semibold">Hp: </span><span>{{ $pokemon->hp }}</span></li>
                <li><span class="font-semibold">Attack: </span><span>{{ $pokemon->attack }}</span></li>
                <li><span class="font-semibold">Defense: </span><span>{{ $pokemon->defense }}</span></li>
                <li><span class="font-semibold">Sp. attack: </span><span>{{ $pokemon->special_attack }}</span></li>
                <li><span class="font-semibold">Sp. defense: </span><span>{{ $pokemon->special_defense }}</span>
                </li>
                <li><span class="font-semibold">Speed: </span><span>{{ $pokemon->speed }}</span></li>
            </ul>
        </div>
    </div>
    @endvolt
</x-layout>