<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-600/80 text-amber-300 border border-slate-500/60">
                <x-icon name="category" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Categories & structured fields') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ __('Manage sections and their custom fields') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-slate-500">
                    {{ __('Manage sections (e.g. Printers, Servers) and their custom fields. Click Configure to add fields (IP, password, etc.) for entries.') }}
                </p>
                <a href="{{ route('categories.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 border border-indigo-500/50 font-semibold text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-100 shrink-0 transition">
                    <x-icon name="plus" class="h-4 w-4" />
                    {{ __('New category') }}
                </a>
            </div>

            <div class="rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden">
                <div class="p-5 border-b border-slate-600/50">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        {{ __('Categories') }}
                    </p>
                </div>
                <div class="p-6">
                    @if($categories->isEmpty())
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <span class="flex items-center justify-center w-14 h-14 rounded-xl bg-slate-700/80 text-slate-400 border border-slate-600/50 mb-4">
                                <x-icon name="folder" class="h-7 w-7" />
                            </span>
                            <p class="text-slate-400 text-sm">
                                {{ __('No categories defined yet.') }}
                            </p>
                        </div>
                    @else
                        <ul class="divide-y divide-slate-700/50">
                            @foreach($categories as $category)
                                <li class="py-4 flex items-center justify-between gap-4 hover:bg-slate-700/30 transition rounded-lg px-3 -mx-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <span class="flex items-center justify-center w-11 h-11 shrink-0 rounded-xl bg-slate-700/80 text-slate-300 border border-slate-600/50">
                                            <x-icon :name="\App\Helpers\FieldIcon::forCategory($category)" class="h-5 w-5" />
                                        </span>
                                        <div class="min-w-0">
                                            <p class="font-medium text-white">
                                                {{ $category->name }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                /{{ $category->slug }} ·
                                                {{ trans_choice(':count field|:count fields', $category->fields->count(), ['count' => $category->fields->count()]) }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="inline-flex items-center gap-2 text-sm font-medium text-indigo-400 hover:text-indigo-300 shrink-0 transition">
                                        <x-icon name="cog" class="h-4 w-4" />
                                        {{ __('Configure') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
