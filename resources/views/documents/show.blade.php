<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <span class="flex items-center justify-center w-11 h-11 shrink-0 glass-icon text-indigo-300">
                    <x-icon :name="\App\Helpers\FieldIcon::forCategory($document->category)" class="h-5 w-5" />
                </span>
                <div class="min-w-0">
                    <h2 class="font-semibold text-xl text-white leading-tight truncate">
                        {{ $document->title }}
                    </h2>
                    <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-slate-300">
                        @if($document->company)
                            <a href="{{ route('companies.show', $document->company) }}" class="inline-flex items-center gap-1 glass-badge text-slate-400 hover:text-white transition">
                                <x-icon name="building" class="h-3.5 w-3.5" />
                                {{ $document->company->name }}
                            </a>
                        @endif
                        @if($document->category)
                            <span class="inline-flex items-center gap-1 glass-badge text-slate-400">
                                <x-icon name="folder" class="h-3.5 w-3.5" />
                                {{ $document->category->name }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 glass-badge text-slate-500">
                                {{ __('Uncategorized') }}
                            </span>
                        @endif
                        <span @class([
                            'inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium',
                            'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40' => $document->status === 'published',
                            'bg-amber-500/20 text-amber-400 border border-amber-500/40' => $document->status === 'draft',
                        ])>
                            @if($document->status === 'published')
                                <x-icon name="check" class="h-3.5 w-3.5" />
                            @else
                                <x-icon name="clock" class="h-3.5 w-3.5" />
                            @endif
                            {{ ucfirst($document->status) }}
                        </span>
                        @if($document->is_pinned)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-indigo-500/20 text-indigo-400 border border-indigo-500/40">
                                <x-icon name="pin" class="h-3.5 w-3.5" />
                                {{ __('Pinned') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('documents.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-300 hover:text-white font-medium px-3 py-2 rounded-lg hover:bg-slate-600/50 transition">
                    <x-icon name="arrow-left" class="h-4 w-4" />
                    <span class="hidden sm:inline">{{ __('Back to list') }}</span>
                </a>
                @can('update', $document)
                    <a href="{{ route('documents.edit', $document) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white bg-indigo-500 hover:bg-indigo-400 border border-indigo-400/50 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-700 transition">
                        <x-icon name="pencil" class="h-4 w-4" />
                        {{ __('Edit') }}
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="glass-card overflow-hidden">
                {{-- Meta bar --}}
                <div class="p-5 border-b border-slate-700/80 bg-slate-800/50">
                    <p class="text-xs text-slate-400 flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span class="inline-flex items-center gap-1.5">
                            <x-icon name="user" class="h-3.5 w-3.5" />
                            {{ __('Created by') }} {{ $document->creator?->name ?? '—' }}
                        </span>
                        @if($document->created_at)
                            <span class="text-slate-600">·</span>
                            <span class="inline-flex items-center gap-1.5">
                                <x-icon name="clock" class="h-3.5 w-3.5" />
                                {{ $document->created_at->format('Y-m-d H:i') }}
                            </span>
                        @endif
                        @if($document->updater && $document->updated_at)
                            <span class="text-slate-600">·</span>
                            {{ __('Last updated by') }} {{ $document->updater->name }} ({{ $document->updated_at->diffForHumans() }})
                        @endif
                    </p>
                </div>

                <div class="p-6 sm:p-8 space-y-8">
                    @if($document->content)
                        <div>
                            <h3 class="flex items-center gap-2 text-sm font-semibold text-slate-300 mb-3">
                                <x-icon name="document-text" class="h-4 w-4 text-indigo-400" />
                                {{ __('Overview & notes') }}
                            </h3>
                            <div class="prose prose-invert prose-sm max-w-none text-slate-300">
                                {!! nl2br(e($document->content)) !!}
                            </div>
                        </div>
                    @endif

                    @if($categoryFields->isNotEmpty())
                        <div class="border-t border-slate-600/50 pt-8">
                            <h3 class="flex items-center gap-2 text-sm font-semibold text-slate-300 mb-4">
                                <x-icon name="key" class="h-4 w-4 text-indigo-400" />
                                {{ __('Structured details') }}
                            </h3>

                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                                @foreach($categoryFields->sortBy('sort_order') as $field)
                                    @php
                                        $value = $document->meta[$field->key] ?? null;
                                        $iconName = \App\Helpers\FieldIcon::forFieldKey($field->key);
                                    @endphp

                                    @if($value !== null && $value !== '')
                                        <div class="p-4 rounded-xl glass-button-ghost hover:border-white/20 transition">
                                            <dt class="flex items-center gap-2 text-slate-400 text-xs font-medium uppercase tracking-wider">
                                                <x-icon :name="$iconName" class="h-3.5 w-3.5 shrink-0" />
                                                {{ $field->label }}
                                            </dt>
                                            <dd class="mt-2 text-slate-200">
                                                @if($field->field_type === 'password' || $field->is_sensitive)
                                                    <div x-data="{ revealed: false }" class="inline-flex items-center gap-2">
                                                        <span x-show="!revealed" class="inline-flex items-center gap-1.5 font-mono text-xs glass-badge text-slate-400">
                                                            <x-icon name="lock" class="h-3.5 w-3.5" />
                                                            ••••••
                                                        </span>
                                                        <span x-show="revealed" x-cloak class="font-mono text-xs glass-badge text-slate-200 break-all">
                                                            {{ $value }}
                                                        </span>
                                                        <button type="button"
                                                                @click="revealed = !revealed"
                                                                class="p-1.5 rounded-lg text-slate-400 hover:text-indigo-400 hover:bg-slate-600/50 transition"
                                                                :title="revealed ? '{{ __('Hide') }}' : '{{ __('Reveal') }}'">
                                                            <span x-show="!revealed"><x-icon name="eye" class="h-4 w-4" /></span>
                                                            <span x-show="revealed" x-cloak><x-icon name="eye-slash" class="h-4 w-4" /></span>
                                                        </button>
                                                    </div>
                                                @else
                                                    <span class="font-mono text-xs glass-badge text-slate-200 break-all">
                                                        {{ $value }}
                                                    </span>
                                                @endif
                                            </dd>
                                        </div>
                                    @endif
                                @endforeach
                            </dl>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
