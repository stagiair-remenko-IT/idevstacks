<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ __('Welcome back') }}{{ Auth::user()->name ? ', ' . Auth::user()->name : '' }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                {{-- DOCUMENTATION --}}
                <a href="{{ route('documents.index') }}"
                   class="group aspect-square flex flex-col items-center justify-center gap-3 rounded-2xl bg-slate-800/95 border border-slate-600/60 hover:border-indigo-500/70 hover:bg-slate-700/50 transition-all">
                    <span class="flex items-center justify-center w-16 h-16 rounded-xl bg-indigo-600/80 text-white">
                        <x-icon name="document" class="h-8 w-8" />
                    </span>
                    <span class="text-base font-semibold text-white">{{ __('Documentation') }}</span>
                </a>

                @if(Auth::user()->isGlobalAdmin())
                    {{-- CATEGORIES --}}
                    <a href="{{ route('categories.index') }}"
                       class="group aspect-square flex flex-col items-center justify-center gap-3 rounded-2xl bg-slate-800/95 border border-slate-600/60 hover:border-amber-500/60 hover:bg-slate-700/50 transition-all">
                        <span class="flex items-center justify-center w-16 h-16 rounded-xl bg-amber-600/80 text-white">
                            <x-icon name="category" class="h-8 w-8" />
                        </span>
                        <span class="text-base font-semibold text-white">{{ __('Categories') }}</span>
                    </a>

                    {{-- USERS --}}
                    <a href="{{ route('admin.users.index') }}"
                       class="group aspect-square flex flex-col items-center justify-center gap-3 rounded-2xl bg-slate-800/95 border border-slate-600/60 hover:border-emerald-500/60 hover:bg-slate-700/50 transition-all">
                        <span class="flex items-center justify-center w-16 h-16 rounded-xl bg-emerald-600/80 text-white">
                            <x-icon name="users" class="h-8 w-8" />
                        </span>
                        <span class="text-base font-semibold text-white">{{ __('Users') }}</span>
                    </a>
                @endif

                {{-- PROFILE --}}
                <a href="{{ route('profile.edit') }}"
                   class="group aspect-square flex flex-col items-center justify-center gap-3 rounded-2xl bg-slate-800/95 border border-slate-600/60 hover:border-slate-500 hover:bg-slate-700/50 transition-all">
                    <span class="flex items-center justify-center w-16 h-16 rounded-xl bg-slate-600/80 text-white">
                        <x-icon name="user" class="h-8 w-8" />
                    </span>
                    <span class="text-base font-semibold text-white">{{ __('Profile') }}</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
