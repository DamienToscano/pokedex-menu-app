<?php
 
namespace App\DataObjects;
 
class PokemonData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $image,
        public readonly int $base_experience,
        public readonly int $height,
        public readonly int $weight,
        public readonly int $attack,
        public readonly int $defense,
        public readonly int $hp,
        public readonly int $speed,
        public readonly int $special_attack,
        public readonly int $special_defense,
        public readonly string $primary_type,
        public readonly ?string $secondary_type,
    ) {
    }
}