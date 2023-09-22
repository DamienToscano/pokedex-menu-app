<?php

namespace App\Repositories;

use App\DataObjects\CustomPaginationData;
use App\DataObjects\PokemonData;

interface PokemonRepository
{
    public function index(): CustomPaginationData;

    /**
     * @throws PokemonNotFoundException
     */
    public function find(int $id): PokemonData;
}