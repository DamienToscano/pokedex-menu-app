<?php

namespace App\Repositories;

use App\DataObjects\PokemonData;
use App\DataObjects\PokemonSimpleData;
use App\Exceptions\PokemonNotFoundException;
use App\Models\Pokemon;

class LocalPokemonRepository implements PokemonRepository
{
    public function index(): array
    {
        /* TODO: Mettre en place la pagination ici aussi */
        return Pokemon::get()->map(function (Pokemon $pokemon) {
            return new PokemonSimpleData(
                id: $pokemon->id,
                image: $pokemon->image,
            );
        })->toArray();
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
