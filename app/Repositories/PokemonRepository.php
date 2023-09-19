<?php

namespace App\Repositories;

use App\DataObjects\PokemonData;

interface PokemonRepository
{
    public function index(): array;

    /**
     * @throws PokemonNotFoundException
     */
    public function find(int $id): PokemonData;
}