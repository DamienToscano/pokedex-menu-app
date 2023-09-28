<?php
 
namespace App\DataObjects;
 
/* TODO: Voir pourquoi le readonly ne passe pas sur NativePHP, surement à cause de la version de php */
class PokemonSimpleData
{
    public function __construct(
        public readonly int $id,
        public readonly string $image,
    ) {
    }
}