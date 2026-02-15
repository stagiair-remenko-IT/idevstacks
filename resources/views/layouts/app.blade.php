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
    <body class="font-sans antialiased text-slate-200 @if(Auth::check() && Auth::user()->getPreference(\App\Models\User::PREF_COMPACT_MODE, false)) app-compact @endif" style="background: linear-gradient(180deg, rgba(15, 23, 42, 0.5) 0%, rgba(2, 6, 23, 0.6) 50%, rgba(15, 23, 42, 0.7) 100%), url('{{ asset('images/glass-blade-bg.png') }}') center center / cover no-repeat fixed; min-height: 100vh; background-color: #020617;">
        <div class="min-h-screen flex">
            {{-- Sidebar (desktop) --}}
            <div class="hidden lg:block">
                @include('layouts.sidebar')
            </div>

            {{-- Main content area (ml-64 offsets fixed sidebar on desktop) --}}
            <div class="flex flex-1 flex-col min-w-0 lg:ml-64">

            {{-- Top bar --}}
            <header class="sticky top-0 z-30 flex h-14 items-center justify-between gap-4 glass-header px-4 lg:pl-6">
                <div class="flex flex-1 items-center gap-4">
                    <div class="relative flex-1 max-w-md">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                            <x-icon name="search" class="h-4 w-4" />
                        </span>
                        <input type="text" placeholder="{{ __('Search everywhere') }}"
                               class="block w-full glass-input py-2 pl-10 pr-4 text-sm text-white placeholder-slate-500">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <x-dropdown align="right" width="48" contentClasses="py-1 glass-panel-light border border-white/10">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 glass-button-ghost px-3 py-2 text-sm font-medium text-slate-200 hover:text-white">
                                <span class="flex h-7 w-7 items-center justify-center rounded-md bg-indigo-500/80 text-xs font-semibold text-white">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </span>
                                <span class="hidden sm:inline">{{ Auth::user()->name ?? 'User' }}</span>
                                <x-icon name="chevron-right" class="h-4 w-4 rotate-[-90deg] text-slate-400" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('settings.index')" class="text-slate-200 hover:bg-white/10 hover:text-white">
                                <span class="inline-flex items-center gap-2">
                                    <x-icon name="cog" class="h-4 w-4 shrink-0" />
                                    {{ __('Settings') }}
                                </span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')" class="text-slate-200 hover:bg-white/10 hover:text-white">
                                <span class="inline-flex items-center gap-2">
                                    <x-icon name="user" class="h-4 w-4 shrink-0" />
                                    {{ __('Profile') }}
                                </span>
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-slate-200 hover:bg-white/10 hover:text-white border-t border-white/10"
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
                    <div class="rounded-2xl backdrop-blur-xl bg-emerald-500/15 border border-emerald-500/40 px-4 py-3 text-sm text-emerald-300 shadow-lg shadow-emerald-900/20">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 mt-4 lg:mx-6" x-data="{ show: true }" x-show="show">
                    <div class="rounded-2xl backdrop-blur-xl bg-red-500/15 border border-red-500/40 px-4 py-3 text-sm text-red-300 shadow-lg shadow-red-900/20">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <div class="glass-header-section border-b border-white/5">
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

            <footer class="glass-footer py-4">
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
