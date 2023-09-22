<?php

use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;

new class extends Component {
    #[Url]
    public $offset = 0;
    public $previous;
    public $next;
    public $total;
    public $page_count;

    public function getPokemonsProperty(PokemonRepository $repository): array
    {
        $data = $repository->index($this->offset);
        $this->previous = $data->previous;
        $this->next = $data->next;
        $this->total = $data->total;
        $this->page_count = $data->page_count;
        return $data->items;
    }
} ?>

<x-layout>
    @volt
    <div>
        <x-titles.h1>Pokedex</x-titles.h1>
        <div class="grid grid-cols-4 gap-3">
            @foreach ($this->pokemons as $pokemon)
            <a class="bg-white" href="/pokemons/{{ $pokemon->id }}?offset={{ $this->offset }}" wire:navigate.hover>
                <div
                    class="flex items-center justify-center p-2 border-2 border-gray-400 rounded hover:border-black outline outline-2 outline-offset-1 outline-gray-600 hover:outline-black">
                    <img class="w-auto h-16" src="{{ $pokemon->image }}"
                        alt="Image of pokemon with id {{ $pokemon->id }}"
                        onerror="this.src='{{ Vite::asset('resources/images/question-mark.png') }}';">
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between p-4">
            <div class="w-6">
                @if ($this->previous !== null)
                <a class="bg-white" href="/?offset={{ $this->previous }}" wire:navigate.hover>
                <img class="w-auto h-6 cursor-pointer hover:opacity-60"
                    src="{{ Vite::asset('resources/images/arrow-left.png') }}" alt="Icon of arrow" />
                </a>
                @endif
            </div>
            {{-- Progress --}}
            <div class="h-2 mx-4 bg-gray-200 rounded grow">
                <div class="h-full bg-gray-800 rounded" style="width: {{ ($this->offset + $this->page_count) / $this->total * 100 }}%;"></div>
            </div>
            <div class="w-6">
                @if ($this->next !== null)
                <a class="bg-white" href="/?offset={{ $this->next }}" wire:navigate.hover>
                <img class="w-auto h-6 rotate-180 cursor-pointer hover:opacity-60"
                    src="{{ Vite::asset('resources/images/arrow-left.png') }}" alt="Icon of arrow" />
                </a>
                @endif
            </div>
        </div>
    </div>
    @endvolt
</x-layout>