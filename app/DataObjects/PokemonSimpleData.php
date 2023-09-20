<?php
 
namespace App\DataObjects;
 
readonly class PokemonSimpleData
{
    public function __construct(
        public int $id,
        public string $image,
    ) {
    }
}