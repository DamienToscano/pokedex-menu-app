<?php

namespace App\Repositories;

use App\DataObjects\PokemonData;
use App\DataObjects\PokemonSimpleData;
use App\Exceptions\PokemonNotFoundException;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Lottery;

class ApiPokemonRepository implements PokemonRepository
{
    protected $url = 'https://pokeapi.co/api/v2/pokemon/';

    public function index(): array
    {
        /* TODO: On remplace ça par des appels API ? */
        return Pokemon::get()->map(function (Pokemon $pokemon) {
            return new PokemonSimpleData(
                id: $pokemon->id,
                image: $pokemon->image,
            );
        })->toArray();
    }

    public function find(int $id): PokemonData
    {
        $response = Http::get($this->url . $id);

        if (!$response->successful()) {
            throw new PokemonNotFoundException($id);
        }

        $pokemon = json_decode($response->body());

        return new PokemonData(
            id: $pokemon->id,
            name: $pokemon->name,
            image: Lottery::odds(1, 10)
                            ->winner(fn () => $pokemon->sprites->front_shiny)
                            ->loser(fn () => $pokemon->sprites->front_default)
                            ->choose(),
            base_experience: $pokemon->base_experience,
            height: $pokemon->height,
            weight: $pokemon->weight,
            attack: $pokemon->stats[1]->base_stat,
            defense: $pokemon->stats[2]->base_stat,
            hp: $pokemon->stats[0]->base_stat,
            speed: $pokemon->stats[5]->base_stat,
            special_attack: $pokemon->stats[3]->base_stat,
            special_defense: $pokemon->stats[4]->base_stat,
            primary_type: $pokemon->types[0]->type->name,
            secondary_type: $pokemon->types[1]->type->name ?? null
        );
    }
}
