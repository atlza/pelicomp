<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle ?? 'Default Title' }} - {{ config('app.name') }} </title>
    @vite('resources/css/app.scss')
</head>
<body class="">

    <header class="px-3">
        <a class="home" href="{{ route('home') }}" title="">Péloches</a>

        <label for="my-drawer" class="block md:hidden drawer-button">
            <i data-lucide="menu" ></i>
        </label>
        <div class="hidden md:flex">
            @if (Auth::check())
                @can('See logs')
                    <a class="flex text-neutral mr-8" href="{{ route('see-logs') }}">
                        <i data-lucide="file-clock" class="mr-2"></i>
                        Logs
                    </a>
                @endcan

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

    <section class="drawer drawer-end">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />

        <div id="app-content" class="drawer-content">
            <x-parts.message />

            {{ $slot }}
        </div>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                @if (Auth::check())

                    @can('See logs')
                    <li>
                        <a class="flex text-neutral mr-8" href="{{ route('see-logs') }}">
                            <i data-lucide="file-clock" class="mr-2"></i>
                            Logs
                        </a>
                    </li>
                    @endcan

                    @can('Manage users')
                        <li>
                            <a class="flex text-neutral mr-8" href="{{ route('manage-users') }}">
                                <i data-lucide="users" class="mr-2"></i>
                                Utilisateurs
                            </a>
                        </li>
                    @endcan

                    @can('Manage brands')
                        <li>
                            <a class="flex text-neutral mr-8" href="{{ route('manage-brands') }}">
                                <i data-lucide="aperture" class="mr-2"></i>
                                Marques
                            </a>
                        </li>
                    @endcan

                    @can('Manage products')
                        <li>
                            <a class="flex text-neutral mr-8" href="{{ route('manage-shops') }}">
                                <i data-lucide="store" class="mr-2"></i>
                                Boutiques
                            </a>
                        </li>
                    @endcan

                    @can('Manage products')
                        <li>
                            <a class="flex text-neutral mr-8" href="{{ route('manage-products') }}">
                                <i data-lucide="film" class="mr-2"></i>
                                Produits
                            </a>
                        </li>
                    @endcan

                    @role('inactive')
                        <li>
                            <a class="flex text-neutral mr-8" href="{{ route('waiting') }}">
                                <i data-lucide="user-cog" class="mr-2"></i>
                                En attente
                            </a>
                        </li>
                    @endrole
                @else
                    <li>
                        <a class="btn btn-sm btn-outline btn-neutral mr-8" href="{{ route('signin') }}">
                            <i data-lucide="plus"></i>
                            Contribuer
                        </a>
                    </li>
                @endif
                <li>
                    <a class="flex text-neutral mr-8" href="/">
                        <i data-lucide="badge-euro" class="mr-2"></i>
                        Offres
                    </a>
                </li>
                <li>
                    <a class="flex text-neutral" href="{{ route('about') }}">
                        <i data-lucide="message-circle-question" class="mr-2"></i>
                        A propos
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <footer>
        Made with <i class="inline-block" data-lucide="clock"></i> and <i class="inline-block text-error text-xs" data-lucide="heart"></i> by <a href="https://www.atlza.com" target="_blanck" title="Guillaume Le Roy">AtlzA</a>, sponsored by <a href="https://work.withmu.com" target="_blanck" title="Freelance Développement Laravel">Mu</a>.
    </footer>

    @if( !empty(config('pelicomp.umamai_id')) )
        <script defer src="https://cloud.umami.is/script.js" data-website-id="{{  config('pelicomp.umamai_id')  }}"></script>
    @endif
    @vite('resources/js/app.js')

</body>
</html>
