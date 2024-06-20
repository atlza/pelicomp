<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle ?? 'Default Title' }} - {{ config('app.name') }} </title>
    @vite('resources/css/app.css')
</head>
<body class="">

    <section>
        <header>
            <a class="home" href="{{ route('home') }}" title="">Péloches</a>
            <div class="flex">
                @if (Auth::check())
                    @can('Manage users')
                        <a class="flex text-neutral mr-8" href="{{ route('manage-users') }}">
                            <i data-lucide="users" class="mr-2"></i>
                            Utilisateurs
                        </a>
                    @endcan

                    @can('Manage shops')
                        <a class="flex text-neutral mr-8" href="{{ route('manage-shops') }}">
                            <i data-lucide="store" class="mr-2"></i>
                            Boutiques
                        </a>
                    @endcan

                    @can('Manage brands')
                    <a class="flex text-neutral mr-8" href="{{ route('manage-brands') }}">
                        <i data-lucide="aperture" class="mr-2"></i>
                        Marques
                    </a>
                    @endcan

                    @can('Manage products')
                    <a class="flex text-neutral mr-8" href="{{ route('manage-products') }}">
                        <i data-lucide="film" class="mr-2"></i>
                        Produits
                    </a>
                    @endcan

                    @role('inactive')
                        <a class="flex text-neutral mr-8" href="{{ route('waiting') }}">
                            <i data-lucide="user-cog" class="mr-2"></i>
                            En attente
                        </a>
                    @endrole
                @else
                    <a class="btn btn-sm btn-outline btn-neutral mr-8" href="{{ route('signin') }}">
                        <i data-lucide="plus"></i>
                        Contribuer
                    </a>
                @endif
                <a class="flex text-neutral mr-8" href="/">
                    <i data-lucide="badge-euro" class="mr-2"></i>
                    Offres
                </a>
                <a class="flex text-neutral" href="{{ route('about') }}">
                    <i data-lucide="message-circle-question" class="mr-2"></i>
                    A propos
                </a>
            </div>
        </header>
        <div id="app-content">

            <x-parts.message />

            {{ $slot }}
        </div>
    </section>

    <footer class="text-zinc-600 text-center mt-16">

    </footer>

</body>

@vite('resources/js/app.js')
</html>
