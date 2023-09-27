<?php

use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Livewire\Attributes\{Computed, Url};
use Livewire\Volt\Component;

new class extends Component {
    #[Url]
    public $page = 1;
    public $previous;
    public $next;
    public $total;
    public $page_count;
    protected $repository;

    public function mount(PokemonRepository $repository) {
        $this->repository = $repository;
    }

    #[Computed]
    public function pokemons()
    {
        $data = Cache::remember('pokemons' . $this->page, 1800, function () {
            return $this->repository->index($this->page);
        });

        $this->previous = $data->previous;
        $this->next = $data->next;
        $this->total = $data->total;
        $this->page_count = $data->page_count;

        return $data->items;
    }

    #[Computed]
    public function pages_number()
    {
        return ceil($this->total / $this->page_count);
    }
} ?>

<x-layout>
    @volt
    <div class="relative">
        <x-titles.h1>Pokedex</x-titles.h1>
        <p class="absolute right-0 text-xl font-medium top-6">P.{{ $this->page }}</p>
        <div class="grid grid-cols-4 gap-3">
            @foreach ($this->pokemons as $pokemon)
            <a class="bg-white" href="/pokemons/{{ $pokemon->id }}?page={{ $this->page }}" wire:navigate.hover>
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
                <a class="bg-white" href="/?page={{ $this->previous }}" wire:navigate.hover>
                    <img class="w-auto h-6 cursor-pointer hover:opacity-60"
                        src="{{ Vite::asset('resources/images/arrow-left.png') }}" alt="Icon of arrow" />
                </a>
                @endif
            </div>
            {{-- Progress --}}
            <div class="flex h-2 mx-4 bg-gray-200 grow">
                @for ($i = 1; $i <= $this->pages_number; $i++)
                    {{-- <div @class(['w-full', 'h-full', 'bg-gray-800' => $i <= $this->page])></div> --}}
                    <a @class(['w-full', 'h-full', 'hover:bg-gray-800' => $i > $this->page, 'hover:bg-gray-200' => $i <= $this->page, 'bg-gray-800' => $i <= $this->page]) href="/?page={{ $i }}" wire:navigate.hover></a>
                @endfor
            </div>
            <div class="w-6">
                @if ($this->next !== null)
                <a class="bg-white" href="/?page={{ $this->next }}" wire:navigate.hover>
                    <img class="w-auto h-6 rotate-180 cursor-pointer hover:opacity-60"
                        src="{{ Vite::asset('resources/images/arrow-left.png') }}" alt="Icon of arrow" />
                </a>
                @endif
            </div>
        </div>
    </div>
    @endvolt
</x-layout>