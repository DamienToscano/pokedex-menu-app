<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pokedex App</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased font-retro bg-slate-50">
    <div class="max-w-md px-4 py-6 mx-auto">
        {{$slot}}
    </div>

    <footer class="m-2 text-right">
        Made with <img class="inline w-auto h-4 -mx-1" src="{{ Vite::asset('resources/images/heart.png') }}"
            alt="Image of a heart"> by <a href="https://twitter.com/DamienToscano" target="_blank"
            class="underline underline-offset-4 hover:font-semibold">Damien Toscano</a>
</body>

</html>