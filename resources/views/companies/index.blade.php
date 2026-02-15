<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <span class="flex h-12 w-12 items-center justify-center glass-icon bg-indigo-500/20 text-indigo-400 border-indigo-500/40">
                    <x-icon name="building" class="h-6 w-6" />
                </span>
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                        {{ __('Companies') }}
                    </h2>
                    <p class="mt-1 text-sm text-slate-400">
                        {{ __('Manage client companies and their documentation') }}
                    </p>
                </div>
            </div>
            @can('create', \App\Models\Company::class)
                <a href="{{ route('companies.create') }}"
                   class="inline-flex items-center gap-2 glass-button px-5 py-2.5 text-sm font-semibold text-white">
                    <x-icon name="plus" class="h-4 w-4" />
                    {{ __('New company') }}
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="glass-card overflow-hidden">
        @if($companies->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <span class="flex h-16 w-16 items-center justify-center glass-icon text-slate-500 mb-5">
                    <x-icon name="building" class="h-8 w-8" />
                </span>
                <p class="text-slate-400 text-base font-medium">{{ __('No companies yet.') }}</p>
                <p class="text-slate-500 text-sm mt-1">{{ __('Create a company to organize documentation by client.') }}</p>
                @can('create', \App\Models\Company::class)
                    <a href="{{ route('companies.create') }}" class="mt-4 inline-flex items-center gap-2 glass-button px-4 py-2 text-sm font-semibold text-white">
                        <x-icon name="plus" class="h-4 w-4" />
                        {{ __('New company') }}
                    </a>
                @endcan
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/5">
                            <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Name') }}</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Email') }}</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Entries') }}</th>
                            <th class="px-6 py-4 w-10"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    <a href="{{ route('companies.show', $company) }}" class="font-medium text-indigo-400 hover:text-indigo-300">
                                        {{ $company->name }}
                                    </a>
                                    @if($company->slug)
                                        <p class="text-xs text-slate-500">/{{ $company->slug }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $company->email ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="glass-badge text-slate-300">
                                        {{ $company->documents_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @can('update', $company)
                                        <a href="{{ route('companies.edit', $company) }}" class="text-slate-400 hover:text-indigo-400">
                                            <x-icon name="pencil" class="h-4 w-4" />
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
