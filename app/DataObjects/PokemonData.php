<?php
 
namespace App\DataObjects;
 
readonly class PokemonData
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $image,
        public int $base_experience,
        public int $height,
        public int $weight,
        public int $attack,
        public int $defense,
        public int $hp,
        public int $speed,
        public int $special_attack,
        public int $special_defense,
        public string $primary_type,
        public ?string $secondary_type,
    ) {
    }
}