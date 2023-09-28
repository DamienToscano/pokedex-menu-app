# Pokedex Menu App

<p float="left">
    <img style="width: 48%;" src="https://github.com/DamienToscano/pokedex-menu-app/blob/main/public/listing.png?raw=true" alt="Pokedex listing">
    <img style="width: 48%;" src="https://github.com/DamienToscano/pokedex-menu-app/blob/main/public/detail.png?raw=true" alt="Pokedex listing">
</p>

## Introduction

This vintage Pokedex is a delightful macOS menubar application that brings back the nostalgia of the classic Pokemon games. This project leverages the PokeAPI to provide you with a vintage-style Pokedex experience right on your Mac.

## Features
- **Vintage Design:** Experience the charm of the original Gameboy style with a vintage-inspired user interface.
- **Full listing:** A vintage style, but all modern pokemons are available. Navigate through all generations easily with the progress bar.
- **Detailed Information:** Get comprehensive details about each Pokémon, including types, stats.
- **Shiny:** Shiny management is setup on this project. Will you have the chance to see one ? (Spoiler alert: it is way easier than in the game to catch a shiny).

## Stack
- Laravel -> [Doc](https://laravel.com/)
- Livewire -> [Doc](https://livewire.laravel.com/)
- Tailwindcss -> [Doc](https://tailwindcss.com/)
- PokeAPI -> [Doc](https://pokeapi.co/)
- NativePHP -> [Doc](https://nativephp.com/)

## App
The NativePHP package is still in alpha release. So the building of the app is not 100% ready yet. But it will be soon. For now, you can run the app in dev mode locally.

## Installation

Follow these steps to run the project locally:

1. Clone the repository
```bash
git clone https://github.com/DamienToscano/pokedex-menu-app.git
```

2. Install dependencies
```bash
cd pokedex-menu-app

composer install

npm install

php artisan native:install
```

3. Launch the project
```bash
npm run dev

php artisan native:serve
```

## Credits

Pokedex Menu App was built with love by [Damien Toscano](https://twitter.com/DamienToscano)

## License

Pokedex Menu App is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).