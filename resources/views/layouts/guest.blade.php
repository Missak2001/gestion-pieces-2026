<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-4 py-10 sm:px-6">
            <div class="pointer-events-none absolute inset-0 -z-20 bg-gradient-to-b from-cyan-50 via-slate-50 to-slate-100"></div>
            <div class="pointer-events-none absolute -top-20 left-1/3 -z-10 h-56 w-56 rounded-full bg-cyan-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-8 right-8 -z-10 h-60 w-60 rounded-full bg-amber-200/35 blur-3xl"></div>

            <div class="mb-6 text-center">
                <a href="/">
                    <span class="mx-auto mb-3 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-700 text-white shadow-sm shadow-cyan-900/25">
                        <x-application-logo class="h-7 w-7 fill-current" />
                    </span>
                </a>
                <p class="text-lg font-semibold tracking-tight text-slate-900">Gestion Pieces 2026</p>
                <p class="mt-1 text-sm text-slate-500">Espace securise</p>
            </div>

            <div class="w-full max-w-md rounded-2xl border border-slate-200/80 bg-white px-6 py-6 shadow-sm sm:px-8 sm:py-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
