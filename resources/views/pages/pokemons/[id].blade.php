<?php

use App\Exceptions\PokemonNotFoundException;
use App\Repositories\PokemonRepository;
use Livewire\Attributes\Url;
use function Laravel\Folio\name;
use Livewire\Volt\Component;

new class extends Component {

    #[Url]
    public $page;

    public function mount(PokemonRepository $repository, int $id) {

        /* TODO: Register the repository here as $this->repository and use it on a computed properties to allow persitence ->perists()  */

        try {
            $this->pokemon = $repository->find($id);
        } catch (PokemonNotFoundException $e) {
            abort(404);
        }
    }

} ?>

<x-layout>
    @volt
    <div>
        <div class="flex items-baseline justify-between">
            <a href="/?page={{ $this->page }}" wire:navigate.hover>
                <img class="w-auto h-6 hover:opacity-60" src="{{ Vite::asset('resources/images/arrow-left.png') }}"
                    alt="" />
            </a>
            <x-titles.h1>{{ $this->pokemon->name }}</x-titles.h1>
            <p class="text-3xl font-medium">#{{ $this->pokemon->id }}</p>
        </div>
        {{-- Image --}}
        @if (! $this->pokemon->image)
        <p class='text-center'>Image not available yet on the API for this pokemon</p>
        @else
        <img class="mx-auto" src="{{ $this->pokemon->image }}" alt='Image of {{ $this->pokemon->name }}'>
        @endif
        {{-- Info --}}
        <div
            class="p-4 mt-2 text-xs bg-white border-2 border-gray-400 rounded outline outline-2 outline-offset-1 outline-gray-600">
            <ul class="grid grid-cols-2 text-lg tracking-wide uppercase">
                <li><span class="font-semibold">Type: </span>
                    <span class="text-{{ $this->pokemon->primary_type }}">{{ $this->pokemon->primary_type }}</span>
                    @if ($this->pokemon->secondary_type)
                    <span> / <span class="text-{{ $this->pokemon->secondary_type }}">{{ $this->pokemon->secondary_type }}</span></span>   
                    @endif
                </li>
                <li><span class="font-semibold">Height: </span><span>{{ $this->pokemon->height }}</span></li>
                <li><span class="font-semibold">Weight: </span><span>{{ $this->pokemon->weight }}</span></li>
                <li><span class="font-semibold">Base Xp: </span><span>{{ $this->pokemon->base_experience }}</span></li>
                <li><span class="font-semibold">Hp: </span><span>{{ $this->pokemon->hp }}</span></li>
                <li><span class="font-semibold">Attack: </span><span>{{ $this->pokemon->attack }}</span></li>
                <li><span class="font-semibold">Defense: </span><span>{{ $this->pokemon->defense }}</span></li>
                <li><span class="font-semibold">Sp. attack: </span><span>{{ $this->pokemon->special_attack }}</span></li>
                <li><span class="font-semibold">Sp. defense: </span><span>{{ $this->pokemon->special_defense }}</span>
                </li>
                <li><span class="font-semibold">Speed: </span><span>{{ $this->pokemon->speed }}</span></li>
            </ul>
        </div>
    </div>
    @endvolt
</x-layout>