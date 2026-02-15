<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('Welcome back') }}{{ Auth::user()->name ? ', ' . Auth::user()->name : '' }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <select class="glass-input px-3 py-2 text-sm text-white">
                    <option>{{ now()->format('Y') }}</option>
                </select>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Overview cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            <div class="glass-card p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center glass-icon text-slate-300">
                        <x-icon name="building" class="h-6 w-6" />
                    </span>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $companiesCount ?? 0 }}</p>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Companies') }}</p>
                    </div>
                </div>
            </div>
            <div class="glass-card p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center glass-icon bg-indigo-500/30 text-indigo-300 border-indigo-500/40">
                        <x-icon name="document" class="h-6 w-6" />
                    </span>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $documentsCount ?? 0 }}</p>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Total entries') }}</p>
                    </div>
                </div>
            </div>
            <div class="glass-card p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center glass-icon bg-emerald-500/30 text-emerald-300 border-emerald-500/40">
                        <x-icon name="check" class="h-6 w-6" />
                    </span>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $publishedCount ?? 0 }}</p>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Published') }}</p>
                    </div>
                </div>
            </div>
            <div class="glass-card p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center glass-icon bg-amber-500/30 text-amber-300 border-amber-500/40">
                        <x-icon name="clock" class="h-6 w-6" />
                    </span>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $draftCount ?? 0 }}</p>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Drafts') }}</p>
                    </div>
                </div>
            </div>
            <div class="glass-card p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center glass-icon bg-indigo-500/30 text-indigo-300 border-indigo-500/40">
                        <x-icon name="pin" class="h-6 w-6" />
                    </span>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $pinnedCount ?? 0 }}</p>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Pinned') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent documents table --}}
        <div class="glass-card overflow-hidden">
            <div class="flex items-center justify-between border-b border-white/10 bg-white/5 px-6 py-4">
                <h3 class="font-semibold text-slate-200">{{ __('Recent documentation') }}</h3>
                <a href="{{ route('documents.index') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition">
                    {{ __('View all') }}
                </a>
            </div>
            <div class="overflow-x-auto">
                @if(($recentDocuments ?? collect())->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <span class="flex h-14 w-14 items-center justify-center glass-icon text-slate-500 mb-4">
                            <x-icon name="document" class="h-7 w-7" />
                        </span>
                        <p class="text-slate-400">{{ __('No documentation yet.') }}</p>
                        <a href="{{ route('documents.create') }}" class="mt-3 text-sm font-medium text-indigo-400 hover:text-indigo-300">
                            {{ __('Create first entry') }}
                        </a>
                    </div>
                @else
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/5">
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Title') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Company') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Category') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Status') }}</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Updated') }}</th>
                                <th class="px-6 py-3 w-10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentDocuments as $doc)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                    <td class="px-6 py-3">
                                        <a href="{{ route('documents.show', $doc) }}" class="font-medium text-indigo-400 hover:text-indigo-300">
                                            {{ $doc->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-3 text-slate-400">
                                        @if($doc->company)
                                            <a href="{{ route('companies.show', $doc->company) }}" class="hover:text-white transition">
                                                {{ $doc->company->name }}
                                            </a>
                                        @else
                                            —
                                        @endif
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
