<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 border border-amber-500/30 shadow-lg">
                <x-icon name="category" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Categories & structured fields') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('Manage sections and their custom fields') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-slate-500">
                    {{ __('Manage sections (e.g. Printers, Servers) and their custom fields. Click Configure to add fields (IP, password, etc.) for entries.') }}
                </p>
                <a href="{{ route('categories.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 border border-indigo-500/50 font-semibold text-sm text-white shadow-lg shadow-indigo-900/30 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-800 shrink-0 transition">
                    <x-icon name="plus" class="h-4 w-4" />
                    {{ __('New category') }}
                </a>
            </div>

            <div class="rounded-xl border border-slate-700/80 bg-slate-800/80 shadow-xl overflow-hidden">
                <div class="p-6 border-b border-slate-700/80 bg-slate-800/50">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                        {{ __('Categories') }}
                    </p>
                </div>
                <div class="p-6">
                    @if($categories->isEmpty())
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <span class="flex items-center justify-center w-16 h-16 rounded-2xl bg-slate-700/50 text-slate-500 border border-slate-600/50 mb-5">
                                <x-icon name="folder" class="h-8 w-8" />
                            </span>
                            <p class="text-slate-400 text-base font-medium">
                                {{ __('No categories defined yet.') }}
                            </p>
                            <p class="text-slate-500 text-sm mt-1">
                                {{ __('Create a category to organize your documentation.') }}
                            </p>
                        </div>
                    @else
                        <ul>
                            @foreach($categories as $category)
                                <li class="py-5 flex items-center justify-between gap-4 hover:bg-slate-700/40 transition rounded-xl px-4 -mx-4 border-b border-slate-700/50 last:border-0">
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
</x-app-layout>
