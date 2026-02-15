<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} — {{ __('IT Documentation') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-200 antialiased min-h-screen" style="background: linear-gradient(180deg, rgba(15, 23, 42, 0.5) 0%, rgba(2, 6, 23, 0.6) 50%, rgba(15, 23, 42, 0.7) 100%), url('{{ asset('images/glass-blade-bg.png') }}') center center / cover no-repeat fixed; min-height: 100vh; background-color: #020617;">

        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4">
            <a href="{{ url('/') }}" class="flex flex-col items-center no-underline text-inherit group">
                <span class="text-2xl font-bold tracking-tight text-white group-hover:text-slate-200 transition-colors">IDEVSTACKS</span>
                <span class="mt-2 text-sm text-slate-400">{{ __('Internal IT Documentation') }}</span>
            </a>

            <div class="w-full sm:max-w-md mt-10 px-8 py-8 glass-panel-light overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>

            <p class="mt-8 text-xs text-slate-500 text-center">
                {{ __('Restricted to authorized IT staff only.') }}
            </p>

            <p class="mt-4 text-xs text-slate-400 text-center">
                © 2026 Hernan Martino Molina
            </p>
        </div>
    </body>
</html>
