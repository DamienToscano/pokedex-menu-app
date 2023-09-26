<?php

namespace App\Repositories;

use App\DataObjects\CustomPaginationData;
use App\DataObjects\PokemonData;
use App\DataObjects\PokemonSimpleData;
use App\Exceptions\PokemonNotFoundException;
use App\Models\Pokemon;

class LocalPokemonRepository implements PokemonRepository
{
    protected int $number_per_page = 16;

    public function index(int $page = 1): CustomPaginationData
    {
        // Parse pokemons data
        $pokemons =  Pokemon::take($this->number_per_page)->skip(($page - 1) * $this->number_per_page)->get()->map(function (Pokemon $pokemon) {
            return new PokemonSimpleData(
                id: $pokemon->id,
                image: $pokemon->image,
            );
        })->toArray();

        // Set metadata
        $count = count($pokemons);
        $previous_page = ($page - 1) > 0 ? $page - 1 : null;
        $next_page = ($count == $this->number_per_page) ? $page + 1 : null;

        return new CustomPaginationData(
            items: $pokemons,
            total: $count,
            previous: $previous_page,
            next: $next_page,
            page_count: $this->number_per_page,
        );
    }

    public function find(int $id): PokemonData
    {
        $pokemon  = Pokemon::find($id);

        if (!$pokemon) {
            throw new PokemonNotFoundException($id);
        }

        return new PokemonData(
            id: $pokemon->id,
            name: $pokemon->name,
            image: $pokemon->image,
            base_experience: $pokemon->base_experience,
            height: $pokemon->height,
            weight: $pokemon->weight,
            attack: $pokemon->attack,
            defense: $pokemon->defense,
            hp: $pokemon->hp,
            speed: $pokemon->speed,
            special_attack: $pokemon->special_attack,
            special_defense: $pokemon->special_defense,
            primary_type: $pokemon->primary_type,
            secondary_type: $pokemon->secondary_type,
        );
    }
}
