<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pokedex App</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased font-retro bg-slate-50">
    <div class="max-w-md px-4 py-4 mx-auto">
        {{$slot}}
    </div>

    <footer class="mx-2 mb-1 text-lg text-center">
        Made with <img class="inline w-auto h-4" src="{{ Vite::asset('resources/images/heart.png') }}"
            alt="Image of a heart"> by <a href="https://twitter.com/DamienToscano" target="_blank"
            class="underline underline-offset-4 hover:font-semibold">Damien Toscano</a>
</body>

</html>