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
    <body class="font-sans text-gray-900 antialiased min-h-screen">
        {{-- Professional background: gradient + subtle grid pattern --}}
        <div class="fixed inset-0 -z-10 bg-slate-900">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-800 via-slate-900 to-indigo-950"></div>
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 48px 48px;"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4">
            <a href="{{ url('/') }}" class="flex flex-col items-center no-underline text-inherit group">
                <span class="text-2xl font-bold tracking-tight text-white group-hover:text-slate-200 transition-colors">IDEVSTACKS</span>
                <span class="mt-2 text-sm text-slate-400">{{ __('Internal IT Documentation') }}</span>
            </a>

            <div class="w-full sm:max-w-md mt-10 px-8 py-8 bg-white/95 backdrop-blur border border-white/10 shadow-2xl shadow-black/20 overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>

            <p class="mt-8 text-xs text-slate-500 text-center">
                {{ __('Restricted to authorized IT staff only.') }}
            </p>
        </div>
    </body>
</html>
