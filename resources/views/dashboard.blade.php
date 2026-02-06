<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ __('Overview and quick access') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Welcome back hero --}}
            <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-slate-800 via-slate-800 to-indigo-900 border border-slate-600/50 shadow-xl">
                <div class="p-8 sm:p-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
                        {{ __('Welcome back') }}{{ Auth::user()->name ? ', ' . Auth::user()->name : '' }}
                    </h1>
                    <p class="mt-3 text-slate-300 text-base max-w-xl">
                        {{ __('Keep your internal IT documentation structured, searchable, and easy to maintain.') }}
                    </p>
                </div>
            </div>

            {{-- Xbox-style clickable tiles --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- Your role (info tile) --}}
                <div class="group relative rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden cursor-default hover:border-slate-500 hover:shadow-xl hover:shadow-slate-900/30 transition-all duration-200">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-slate-700/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center justify-center w-14 h-14 rounded-xl bg-slate-700/80 text-slate-300 border border-slate-600/50 group-hover:bg-slate-600/80 transition-colors">
                                <x-icon name="user" class="h-7 w-7" />
                            </span>
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                    {{ __('Your role') }}
                                </p>
                                <p class="text-xl font-bold text-white">
                                    {{ Auth::user()->isGlobalAdmin() ? __('Global Admin') : __('IT Worker') }}
                                </p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-slate-400">
                            {{ __('Access is limited to internal IT staff only.') }}
                        </p>
                    </div>
                </div>

                {{-- Documentation (clickable tile) --}}
                <a href="{{ route('documents.index') }}" class="group relative block rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden hover:border-indigo-500/70 hover:shadow-xl hover:shadow-indigo-900/20 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-500/20 rounded-bl-full blur-2xl group-hover:bg-indigo-500/30 transition-colors"></div>
                    <div class="relative p-6">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center justify-center w-14 h-14 rounded-xl bg-indigo-600/80 text-white border border-indigo-500/50 group-hover:bg-indigo-500 transition-colors">
                                <x-icon name="document" class="h-7 w-7" />
                            </span>
                            <div>
                                <p class="text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                                    {{ __('Documentation') }}
                                </p>
                                <p class="text-lg font-bold text-white">
                                    {{ __('Open Documentation') }}
                                </p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-slate-400 line-clamp-2">
                            {{ __('Browse and update entries by category. Pinned and recently updated items are highlighted.') }}
                        </p>
                        <span class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-indigo-400 group-hover:gap-3 transition-all">
                            {{ __('Open') }}
                            <x-icon name="chevron-right" class="h-4 w-4" />
                        </span>
                    </div>
                </a>

                @if(Auth::user()->isGlobalAdmin())
                    {{-- Admin (clickable tile – primary link to categories) --}}
                    <a href="{{ route('categories.index') }}" class="group relative block rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden hover:border-amber-500/60 hover:shadow-xl hover:shadow-amber-900/20 hover:-translate-y-0.5 transition-all duration-200">
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-amber-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/20 rounded-bl-full blur-2xl group-hover:bg-amber-500/30 transition-colors"></div>
                        <div class="relative p-6">
                            <div class="flex items-center gap-4">
                                <span class="flex items-center justify-center w-14 h-14 rounded-xl bg-amber-600/80 text-white border border-amber-500/50 group-hover:bg-amber-500 transition-colors">
                                    <x-icon name="cog" class="h-7 w-7" />
                                </span>
                                <div>
                                    <p class="text-xs font-semibold text-amber-300/90 uppercase tracking-wider">
                                        {{ __('Admin') }}
                                    </p>
                                    <p class="text-lg font-bold text-white">
                                        {{ __('Categories & fields') }}
                                    </p>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-slate-400">
                                {{ __('Manage categories, custom fields and users.') }}
                            </p>
                            <div class="mt-4 flex flex-wrap gap-3">
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-400/90">
                                    <x-icon name="category" class="h-3.5 w-3.5" />
                                    {{ __('Categories') }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-400/90">
                                    <x-icon name="users" class="h-3.5 w-3.5" />
                                    {{ __('Users') }}
                                </span>
                            </div>
                            <span class="mt-3 inline-flex items-center gap-2 text-sm font-medium text-amber-400 group-hover:gap-3 transition-all">
                                {{ __('Open') }}
                                <x-icon name="chevron-right" class="h-4 w-4" />
                            </span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
