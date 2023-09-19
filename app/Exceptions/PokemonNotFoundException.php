<?php

namespace App\Exceptions;

use Exception;

class PokemonNotFoundException extends Exception
{
    public function __construct(
        public string $name,
    ) {
        parent::__construct("Pokemon with name {$name} not found.");
    }
}