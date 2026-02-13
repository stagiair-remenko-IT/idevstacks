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
    <body class="font-sans antialiased text-slate-800 bg-slate-900">
        <div class="min-h-screen flex bg-slate-900">
            {{-- Sidebar (desktop) --}}
            <div class="hidden lg:block">
                @include('layouts.sidebar')
            </div>

            {{-- Main content area (ml-64 offsets fixed sidebar on desktop) --}}
            <div class="flex flex-1 flex-col min-w-0 lg:ml-64">

            {{-- Top bar --}}
            <header class="sticky top-0 z-30 flex h-14 items-center justify-between gap-4 border-b border-slate-700/80 bg-slate-800/95 px-4 shadow-sm backdrop-blur-sm lg:pl-6">
                <div class="flex flex-1 items-center gap-4">
                    <div class="relative flex-1 max-w-md">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                            <x-icon name="search" class="h-4 w-4" />
                        </span>
                        <input type="text" placeholder="{{ __('Search everywhere') }}"
                               class="block w-full rounded-lg border-slate-600 bg-slate-700/50 py-2 pl-10 pr-4 text-sm text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-slate-800 border border-slate-700 shadow-xl">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-lg border border-slate-600/50 bg-slate-700/50 px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-600/80 hover:text-white transition">
                                <span class="flex h-7 w-7 items-center justify-center rounded-md bg-indigo-500/80 text-xs font-semibold text-white">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </span>
                                <span class="hidden sm:inline">{{ Auth::user()->name ?? 'User' }}</span>
                                <x-icon name="chevron-right" class="h-4 w-4 rotate-[-90deg] text-slate-400" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-slate-200 hover:bg-slate-700 hover:text-white">
                                <span class="inline-flex items-center gap-2">
                                    <x-icon name="cog" class="h-4 w-4 shrink-0" />
                                    {{ __('Profile') }}
                                </span>
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-slate-200 hover:bg-slate-700 hover:text-white border-t border-slate-700"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            @if(session('status'))
                <div class="mx-4 mt-4 lg:mx-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="rounded-xl bg-emerald-500/20 border border-emerald-500/50 px-4 py-3 text-sm text-emerald-300 shadow-lg shadow-emerald-900/20">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 mt-4 lg:mx-6" x-data="{ show: true }" x-show="show">
                    <div class="rounded-xl bg-red-500/20 border border-red-500/50 px-4 py-3 text-sm text-red-300 shadow-lg shadow-red-900/20">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <div class="border-b border-slate-700/80 bg-slate-800/50">
                    <div class="py-5 px-4 lg:px-6">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 overflow-auto pb-12">
                <div class="py-6 px-4 lg:px-6">
                    {{ $slot }}
                </div>
            </main>

            <footer class="border-t border-slate-700/80 bg-slate-800 py-4">
                <p class="text-center text-sm text-slate-400">
                    © 2026 Hernan Martino Molina
                </p>
            </footer>
            </div>

            {{-- Mobile sidebar overlay --}}
            @include('layouts.sidebar-mobile')
        </div>
    </body>
</html>
