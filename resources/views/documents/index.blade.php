<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 shadow-lg">
                <x-icon name="document" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Documentation') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('Browse and manage entries by category') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
            {{-- Filters --}}
            <div class="rounded-2xl bg-slate-800/80 border border-slate-700/80 shadow-xl overflow-hidden backdrop-blur-sm">
                <div class="p-5 border-b border-slate-700/80 bg-slate-800/50">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                        {{ __('Filters') }}
                    </p>
                </div>
                <div class="p-5">
                    <form method="GET" action="{{ route('documents.index') }}" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <x-input-label for="company_id" value="{{ __('Company') }}" class="text-slate-400" />
                            <div class="relative mt-1">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                    <x-icon name="building" class="h-4 w-4" />
                                </span>
                                <select id="company_id" name="company_id"
                                        class="block w-48 pl-9 rounded-lg bg-slate-700/50 border-slate-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('All') }}</option>
                                    @foreach($companies ?? [] as $company)
                                        <option value="{{ $company->id }}" @selected(($filters['company_id'] ?? null) == $company->id)>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <x-input-label for="search" value="{{ __('Search') }}" class="text-slate-400" />
                            <div class="relative mt-1">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                    <x-icon name="search" class="h-4 w-4" />
                                </span>
                                <x-text-input id="search" name="search" type="text"
                                              class="block w-56 pl-9 rounded-lg bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500"
                                              value="{{ $filters['search'] }}" placeholder="{{ __('Search…') }}" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="category_id" value="{{ __('Category') }}" class="text-slate-400" />
                            <div class="relative mt-1">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                    <x-icon name="folder" class="h-4 w-4" />
                                </span>
                                <select id="category_id" name="category_id"
                                        class="block w-48 pl-9 rounded-lg bg-slate-700/50 border-slate-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('All') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected($filters['category_id'] === $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <x-input-label for="status" value="{{ __('Status') }}" class="text-slate-400" />
                            <div class="relative mt-1">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                    <x-icon name="filter" class="h-4 w-4" />
                                </span>
                                <select id="status" name="status"
                                        class="block w-40 pl-9 rounded-lg bg-slate-700/50 border-slate-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="published" @selected($filters['status'] === 'published')>{{ __('Published') }}</option>
                                    <option value="draft" @selected($filters['status'] === 'draft')>{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-900/30 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                            <x-icon name="search" class="h-4 w-4" />
                            {{ __('Filter') }}
                        </button>
                    </form>
                </div>
            </div>

            {{-- New entry + table card --}}
            <div class="rounded-2xl bg-slate-800/80 border border-slate-700/80 shadow-xl overflow-hidden backdrop-blur-sm">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-6 border-b border-slate-700/80 bg-slate-800/50">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                        {{ __('Entries') }}
                    </p>
                    @can('create', \App\Models\Document::class)
                        <a href="{{ route('documents.create') }}"
                           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 border border-indigo-500/50 font-semibold text-sm text-white shadow-lg shadow-indigo-900/30 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-800 transition shrink-0">
                            <x-icon name="plus" class="h-4 w-4" />
                            {{ __('New Entry') }}
                        </a>
                    @endcan
                </div>

                @if($documents->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <span class="flex items-center justify-center w-16 h-16 rounded-2xl bg-slate-700/50 text-slate-500 border border-slate-600/50 mb-5">
                            <x-icon name="document" class="h-8 w-8" />
                        </span>
                        <p class="text-slate-400 text-base font-medium">
                            {{ __('No documentation entries found yet.') }}
                        </p>
                        <p class="text-slate-500 text-sm mt-1">
                            {{ __('Create your first entry to get started.') }}
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b border-slate-700/80 bg-slate-800/30">
                                    <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Title') }}</th>
                                    <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Company') }}</th>
                                    <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Category') }}</th>
                                    <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Status') }}</th>
                                    <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Owner') }}</th>
                                    <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Updated') }}</th>
                                    <th class="px-6 py-4 w-10"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr class="border-b border-slate-700/50 hover:bg-slate-700/40 transition @if($document->is_pinned) bg-indigo-500/5 @endif">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('documents.show', $document) }}"
                                               class="inline-flex items-center gap-2 text-indigo-400 font-medium hover:text-indigo-300 transition">
                                                @if($document->is_pinned)
                                                    <x-icon name="pin" class="h-4 w-4 shrink-0 text-indigo-400" />
                                                @endif
                                                {{ $document->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($document->company)
                                                <a href="{{ route('companies.show', $document->company) }}" class="inline-flex items-center gap-2 text-slate-300 hover:text-white transition">
                                                    <x-icon name="building" class="h-4 w-4 shrink-0 text-slate-500" />
                                                    {{ $document->company->name }}
                                                </a>
                                            @else
                                                <span class="text-slate-500">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-2 text-slate-300">
                                                <x-icon :name="\App\Helpers\FieldIcon::forCategory($document->category)" class="h-4 w-4 shrink-0 text-slate-500" />
                                                {{ $document->category?->name ?? __('Uncategorized') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span @class([
                                                'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium',
                                                'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' => $document->status === 'published',
                                                'bg-amber-500/20 text-amber-400 border border-amber-500/30' => $document->status === 'draft',
                                            ])>
                                                @if($document->status === 'published')
                                                    <x-icon name="check" class="h-3.5 w-3.5" />
                                                @else
                                                    <x-icon name="clock" class="h-3.5 w-3.5" />
                                                @endif
                                                {{ ucfirst($document->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                                            {{ $document->creator?->name ?? '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-slate-500 text-xs">
                                            {{ $document->updated_at?->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            @can('update', $document)
                                                <a href="{{ route('documents.edit', $document) }}"
                                                   class="inline-flex items-center gap-1 text-slate-400 hover:text-indigo-400 font-medium transition">
                                                    <x-icon name="pencil" class="h-4 w-4" />
                                                    <span class="hidden sm:inline">{{ __('Edit') }}</span>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-5 border-t border-slate-700/80 bg-slate-800/30">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
    </div>
</x-app-layout>
