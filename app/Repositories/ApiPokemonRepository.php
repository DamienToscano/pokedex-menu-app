<?php

namespace App\Repositories;

use App\DataObjects\CustomPaginationData;
use App\DataObjects\PokemonData;
use App\DataObjects\PokemonSimpleData;
use App\Exceptions\PokemonNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Lottery;

class ApiPokemonRepository implements PokemonRepository
{
    protected string $url = 'https://pokeapi.co/api/v2/pokemon/';
    protected string $image_url = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/';
    protected int $number_per_page = 16;

    public function index(int $page = 1): CustomPaginationData
    {
        $pokemons = [];

        $response = Http::get($this->url . '?offset=' . (($page - 1) * $this->number_per_page) . '&limit=' . $this->number_per_page);
        $decoded_reponse = json_decode($response->body());
        $data = $decoded_reponse->results;
        $count = $decoded_reponse->count;

        if ($decoded_reponse->next) {
            parse_str(parse_url($decoded_reponse->next)['query'], $next_query);
            $next_offset = $next_query['offset'];
            // Convert offset to page
            $next_page = $next_offset / $this->number_per_page + 1;
        }

        if ($decoded_reponse->previous) {
            parse_str(parse_url($decoded_reponse->previous)['query'], $previous_query);
            $previous_offset = $previous_query['offset'];
            // Convert offset to page
            $previous_page = $previous_offset / $this->number_per_page + 1;
        }


        $pokemons = Arr::map($data, function ($pokemon) {
            $id = $this->getIdFromUrl($pokemon->url);

            return new PokemonSimpleData(
                id: $id,
                image: $this->getImageUrl($id),
            );
        });

        return new CustomPaginationData(
            items: $pokemons,
            total: $count,
            previous: $previous_page ?? null,
            next: $next_page ?? null,
            page_count: $this->number_per_page,
        );
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
            image: $pokemon->sprites->front_default ?
                Lottery::odds(1, 10)
                ->winner(fn () => $pokemon->sprites->front_shiny)
                ->loser(fn () => $pokemon->sprites->front_default)
                ->choose()
                : '',
            base_experience: $pokemon->base_experience ?: 0,
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

    protected function getImageUrl(int $id): string
    {
        return $this->image_url . $id . '.png';
    }

    protected function getIdFromUrl(string $url): int
    {
        return (int) Arr::last(explode('/', trim($url, '/')));
    }
}
