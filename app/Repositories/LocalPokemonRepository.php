<?php

namespace App\Repositories;

use App\DataObjects\PokemonData;
use App\Exceptions\PokemonNotFoundException;
use App\Models\Pokemon;

class LocalPokemonRepository implements PokemonRepository
{
    public function index(): array
    {
        return Pokemon::get()->map(function (Pokemon $pokemon) {
            return new PokemonData(
                $pokemon->id,
                $pokemon->name,
                $pokemon->image,
                $pokemon->base_experience,
                $pokemon->height,
                $pokemon->weight,
                $pokemon->attack,
                $pokemon->defense,
                $pokemon->hp,
                $pokemon->speed,
                $pokemon->special_attack,
                $pokemon->special_defense,
                $pokemon->primary_type,
                $pokemon->secondary_type,
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
            $pokemon->id,
            $pokemon->name,
            $pokemon->image,
            $pokemon->base_experience,
            $pokemon->height,
            $pokemon->weight,
            $pokemon->attack,
            $pokemon->defense,
            $pokemon->hp,
            $pokemon->speed,
            $pokemon->special_attack,
            $pokemon->special_defense,
            $pokemon->primary_type,
            $pokemon->secondary_type,
        );
    }
}
