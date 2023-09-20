<?php

namespace App\Providers;

use App\Repositories\PokemonRepository;
use App\Repositories\ApiPokemonRepository;
use App\Repositories\LocalPokemonRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            PokemonRepository::class,
            // LocalPokemonRepository::class,
            ApiPokemonRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
