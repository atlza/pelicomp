<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>
<body class="">

    <section>
        <header>
            <a class="home" href="{{ route('home') }}" title="">Péloches</a>
            <div class="flex">
                <a class="flex text-neutral mr-8" href="/">
                    <i data-lucide="badge-euro" class="mr-2"></i>
                    Offres
                </a>
                @if (Auth::check())
                    <a class="flex text-neutral mr-8" href="{{ route('connected-shops') }}">
                        <i data-lucide="store" class="mr-2"></i>
                        Boutiques
                    </a>
                    <a class="flex text-neutral mr-8" href="{{ route('connected-brands') }}">
                        <i data-lucide="aperture" class="mr-2"></i>
                        Marques
                    </a>
                    <a class="flex text-neutral" href="{{ route('connected-products') }}">
                        <i data-lucide="film" class="mr-2"></i>
                        Produits
                    </a>
                @else
                    <a class="btn btn-sm btn-outline btn-neutral" href="{{ route('signin') }}">
                        <i data-lucide="plus"></i>
                        Contribuer
                    </a>
                @endif
            </div>
        </header>
        <div id="app-content">
            {{ $slot }}
        </div>
    </section>

    <footer class="text-zinc-600 text-center mt-16">

    </footer>

</body>

@vite('resources/js/app.js')
</html>
