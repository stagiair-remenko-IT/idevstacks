<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-4 min-w-0">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 shadow-lg">
                    <x-icon name="building" class="h-6 w-6" />
                </span>
                <div class="min-w-0">
                    <h2 class="font-bold text-2xl text-white leading-tight tracking-tight truncate">
                        {{ $company->name }}
                    </h2>
                    <p class="mt-1 text-sm text-slate-400">
                        {{ $company->email ?? '/'.$company->slug }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('companies.index') }}" class="inline-flex items-center gap-2 glass-button-ghost px-3 py-2 text-sm text-slate-400 hover:text-white">
                    <x-icon name="arrow-left" class="h-4 w-4" />
                    {{ __('Back') }}
                </a>
                @can('update', $company)
                    <a href="{{ route('companies.edit', $company) }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 transition">
                        <x-icon name="pencil" class="h-4 w-4" />
                        {{ __('Edit') }}
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Company details --}}
        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-700/80 bg-slate-800/50 px-6 py-4">
                <h3 class="font-semibold text-slate-200">{{ __('Company details') }}</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    @if($company->email)
                        <div>
                            <dt class="text-slate-500">{{ __('Email') }}</dt>
                            <dd class="mt-1 text-slate-200"><a href="mailto:{{ $company->email }}" class="text-indigo-400 hover:underline">{{ $company->email }}</a></dd>
                        </div>
                    @endif
                    @if($company->phone)
                        <div>
                            <dt class="text-slate-500">{{ __('Phone') }}</dt>
                            <dd class="mt-1 text-slate-200">{{ $company->phone }}</dd>
                        </div>
                    @endif
                    @if($company->website)
                        <div>
                            <dt class="text-slate-500">{{ __('Website') }}</dt>
                            <dd class="mt-1"><a href="{{ $company->website }}" target="_blank" rel="noopener" class="text-indigo-400 hover:underline">{{ $company->website }}</a></dd>
                        </div>
                    @endif
                    @if($company->address || $company->city)
                        <div class="md:col-span-2">
                            <dt class="text-slate-500">{{ __('Address') }}</dt>
                            <dd class="mt-1 text-slate-200">
                                {{ implode(', ', array_filter([$company->address, $company->city, $company->state, $company->postal_code, $company->country])) ?: '—' }}
                            </dd>
                        </div>
                    @endif
                    @if($company->notes)
                        <div class="md:col-span-2">
                            <dt class="text-slate-500">{{ __('Notes') }}</dt>
                            <dd class="mt-1 text-slate-200 whitespace-pre-wrap">{{ $company->notes }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        {{-- Documentation for this company --}}
        <div class="glass-card overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-700/80 bg-slate-800/50 px-6 py-4">
                <h3 class="font-semibold text-slate-200">{{ __('Documentation') }}</h3>
                @can('create', \App\Models\Document::class)
                    <a href="{{ route('documents.create') }}?company_id={{ $company->id }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 transition">
                        <x-icon name="plus" class="h-4 w-4" />
                        {{ __('New entry') }}
                    </a>
                @endcan
            </div>
            <div class="overflow-x-auto">
                @if($documents->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <p class="text-slate-400">{{ __('No documentation for this company yet.') }}</p>
                        @can('create', \App\Models\Document::class)
                            <a href="{{ route('documents.create') }}?company_id={{ $company->id }}" class="mt-3 text-sm font-medium text-indigo-400 hover:text-indigo-300">
                                {{ __('Create first entry') }}
                            </a>
                        @endcan
                    </div>
                @else
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-700/80 bg-slate-800/30">
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Title') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Category') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Status') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Updated') }}</th>
                                <th class="px-6 py-3 w-10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                    <td class="px-6 py-3">
                                        <a href="{{ route('documents.show', $doc) }}" class="font-medium text-indigo-400 hover:text-indigo-300">
                                            {{ $doc->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-3 text-slate-400">{{ $doc->category?->name ?? '—' }}</td>
                                    <td class="px-6 py-3">
                                        <span @class([
                                            'inline-flex px-2.5 py-1 rounded-lg text-xs font-medium',
                                            'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40' => $doc->status === 'published',
                                            'bg-amber-500/20 text-amber-400 border border-amber-500/40' => $doc->status === 'draft',
                                        ])>
                                            {{ ucfirst($doc->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-slate-500 text-xs">{{ $doc->updated_at?->diffForHumans() }}</td>
                                    <td class="px-6 py-3">
                                        <a href="{{ route('documents.edit', $doc) }}" class="text-slate-400 hover:text-indigo-400">
                                            <x-icon name="pencil" class="h-4 w-4" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($documents->count() >= 20)
                        <div class="border-t border-slate-700/80 p-4">
                            <a href="{{ route('documents.index', ['company_id' => $company->id]) }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300">
                                {{ __('View all entries') }}
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
