@php
    try {
        $companiesCount = \App\Models\Company::count();
        $documentsCount = \App\Models\Document::count();
    } catch (\Throwable $e) {
        $companiesCount = 0;
        $documentsCount = 0;
    }
@endphp
<aside class="fixed left-0 top-0 z-40 h-screen w-64 flex-shrink-0 glass-blade shadow-2xl">
    <div class="flex h-full flex-col">
        {{-- Logo --}}
        <div class="flex h-14 items-center gap-2 border-b border-white/10 px-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 no-underline text-white hover:text-slate-200 transition">
                <span class="font-bold text-lg tracking-tight">IDEVSTACKS</span>
                <span class="text-xs font-medium text-slate-400 uppercase tracking-widest">{{ __('IT Docs') }}</span>
            </a>
        </div>

        {{-- Nav sections --}}
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="space-y-1 px-3">
                <a href="{{ route('dashboard') }}"
                   class="@if(request()->routeIs('dashboard')) glass-nav-active text-white @else text-slate-300 glass-nav-hover hover:text-white @endif flex items-center gap-3 px-3 py-2.5 text-sm font-medium">
                    <x-icon name="dashboard" class="h-5 w-5 shrink-0" />
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('companies.index') }}"
                   class="@if(request()->routeIs('companies.*')) glass-nav-active text-white @else text-slate-300 glass-nav-hover hover:text-white @endif flex items-center justify-between gap-3 px-3 py-2.5 text-sm font-medium">
                    <span class="flex items-center gap-3">
                        <x-icon name="building" class="h-5 w-5 shrink-0" />
                        {{ __('Companies') }}
                    </span>
                    <span class="glass-badge text-slate-300">{{ $companiesCount }}</span>
                </a>
                <a href="{{ route('documents.index') }}"
                   class="@if(request()->routeIs('documents.*') && !request()->routeIs('companies.*')) glass-nav-active text-white @else text-slate-300 glass-nav-hover hover:text-white @endif flex items-center justify-between gap-3 px-3 py-2.5 text-sm font-medium">
                    <span class="flex items-center gap-3">
                        <x-icon name="document" class="h-5 w-5 shrink-0" />
                        {{ __('Documentation') }}
                    </span>
                    <span class="glass-badge text-slate-300">{{ $documentsCount }}</span>
                </a>
            </div>

            @if(Auth::user()?->isGlobalAdmin())
                <div class="mt-6 px-3">
                    <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-widest text-slate-500">{{ __('Admin') }}</p>
                    <div class="space-y-1">
                        <a href="{{ route('categories.index') }}"
                           class="@if(request()->routeIs('categories.*')) glass-nav-active text-white @else text-slate-300 glass-nav-hover hover:text-white @endif flex items-center gap-3 px-3 py-2.5 text-sm font-medium">
                            <x-icon name="category" class="h-5 w-5 shrink-0" />
                            {{ __('Categories') }}
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="@if(request()->routeIs('admin.users.*')) glass-nav-active text-white @else text-slate-300 glass-nav-hover hover:text-white @endif flex items-center gap-3 px-3 py-2.5 text-sm font-medium">
                            <x-icon name="users" class="h-5 w-5 shrink-0" />
                            {{ __('Users') }}
                        </a>
                    </div>
                </div>
            @endif
        </nav>

        <div class="border-t border-white/10 p-3">
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 glass-nav-hover px-3 py-2.5 text-sm text-slate-400 hover:text-white">
                <x-icon name="cog" class="h-5 w-5 shrink-0" />
                {{ __('Profile') }}
            </a>
        </div>
    </div>
</aside>
