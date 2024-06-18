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
        @vite('resources/js/app.js')
    </head>
    <body >
        <section>
            <header>
                <a class="home" href="" title="">Péloches</a>
                <a class="btn btn-sm btn-outline btn-secondary" href="/signin">
                    <i data-lucide="plus"></i>
                    Contribuer
                </a>
            </header>
            <div class="content py-8">
                <label class="input input-bordered flex items-center gap-2 mb-4">
                    <input type="text" class="grow" placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
                </label>
                <div id="wrapper"></div>
            </div>
        </section>
        <footer>

        </footer>
    </body>
</html>

