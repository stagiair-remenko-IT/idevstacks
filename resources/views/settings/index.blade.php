<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center glass-icon bg-indigo-500/20 text-indigo-400 border-indigo-500/40">
                <x-icon name="cog" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Settings') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('Customize your experience') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl space-y-6">
        {{-- App version --}}
        <div class="glass-card p-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h3 class="font-semibold text-white">{{ __('App version') }}</h3>
                    <p class="text-sm text-slate-400 mt-0.5">{{ __('Current application version') }}</p>
                </div>
                <span class="glass-badge text-indigo-300 px-3 py-1.5 font-mono text-sm">{{ $version }}</span>
            </div>
        </div>

        {{-- Preferences form --}}
        <form method="POST" action="{{ route('settings.update') }}" class="glass-card overflow-hidden">
            @csrf
            @method('PATCH')

            <div class="border-b border-white/10 bg-white/5 px-6 py-4">
                <h3 class="font-semibold text-white">{{ __('Preferences') }}</h3>
                <p class="text-xs text-slate-400 mt-0.5">{{ __('These settings are saved to your account') }}</p>
            </div>

            <div class="p-6 space-y-6">
                {{-- Items per page --}}
                <div>
                    <label for="items_per_page" class="block text-sm font-medium text-slate-300">
                        {{ __('Items per page') }}
                    </label>
                    <p class="text-xs text-slate-500 mt-0.5">{{ __('Number of documents shown per page in lists') }}</p>
                    <select id="items_per_page" name="items_per_page"
                            class="mt-2 glass-input block w-full max-w-xs py-2 px-3 text-white">
                        @foreach([15, 25, 50, 100] as $n)
                            <option value="{{ $n }}" @selected($itemsPerPage === $n)>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Recent documents count --}}
                <div>
                    <label for="recent_count" class="block text-sm font-medium text-slate-300">
                        {{ __('Recent documents on dashboard') }}
                    </label>
                    <p class="text-xs text-slate-500 mt-0.5">{{ __('How many recent entries to show on the dashboard') }}</p>
                    <select id="recent_count" name="recent_count"
                            class="mt-2 glass-input block w-full max-w-xs py-2 px-3 text-white">
                        @foreach([5, 10, 15, 20] as $n)
                            <option value="{{ $n }}" @selected($recentCount === $n)>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Compact mode --}}
                <div class="flex items-start gap-3">
                    <input type="hidden" name="compact_mode" value="0">
                    <input type="checkbox" id="compact_mode" name="compact_mode" value="1"
                           class="mt-1 rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500"
                           @checked($compactMode)>
                    <div>
                        <label for="compact_mode" class="block text-sm font-medium text-slate-300">
                            {{ __('Compact mode') }}
                        </label>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Reduce padding and spacing for a denser layout') }}</p>
                    </div>
                </div>

                {{-- Sidebar counts --}}
                <div class="flex items-start gap-3">
                    <input type="hidden" name="sidebar_counts" value="0">
                    <input type="checkbox" id="sidebar_counts" name="sidebar_counts" value="1"
                           class="mt-1 rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500"
                           @checked($sidebarCounts)>
                    <div>
                        <label for="sidebar_counts" class="block text-sm font-medium text-slate-300">
                            {{ __('Show sidebar counts') }}
                        </label>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Display company and document counts in the sidebar') }}</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 px-6 py-4 flex justify-end">
                <button type="submit" class="glass-button px-5 py-2.5 text-sm font-semibold text-white">
                    {{ __('Save settings') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
