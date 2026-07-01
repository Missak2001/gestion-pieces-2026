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

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #f3f4f6;
            font-family: 'Inter', system-ui, sans-serif;
        }

        table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background: #f9fafb !important;
            color: #111827;
            font-weight: 700;
        }

        td,
        th {
            border-color: #e5e7eb !important;
        }

        .shadow {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06) !important;
        }

        .rounded {
            border-radius: 12px !important;
        }

        button,
        a.bg-blue-600 {
            transition: all 0.2s ease;
        }

        button:hover,
        a.bg-blue-600:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.25);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="relative min-h-screen overflow-hidden">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-64 bg-gradient-to-r from-cyan-100/60 via-transparent to-amber-100/60">
        </div>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-slate-200/80 bg-white/90 px-5 py-5 shadow-sm backdrop-blur sm:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="mx-auto max-w-7xl px-4 pb-10 pt-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
