<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center glass-icon bg-amber-500/20 text-amber-400 border-amber-500/40">
                <x-icon name="pencil" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Edit entry') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400 truncate">
                    {{ $document->title }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl">
            <div class="glass-card overflow-hidden" x-data="{ selectedCategoryId: '{{ old('category_id', $document->category_id) }}' }">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('documents.update', $document) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="title" value="{{ __('Title') }}" class="text-slate-400" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                              :value="old('title', $document->title)" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="company_id" value="{{ __('Company') }}" class="text-slate-400" />
                                <select id="company_id" name="company_id"
                                        class="mt-1 block w-full glass-input">
                                    <option value="">{{ __('No company') }}</option>
                                    @foreach($companies ?? [] as $company)
                                        <option value="{{ $company->id }}" @selected(old('company_id', $document->company_id) == $company->id)>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="category_id" value="{{ __('Category / Section') }}" class="text-slate-400" />
                                <p class="text-xs text-slate-500 mb-1">
                                    {{ __('Changing category updates the custom fields (IP, password, etc.) below.') }}
                                </p>
                                <select id="category_id" name="category_id" x-model="selectedCategoryId"
                                        class="mt-1 block w-full glass-input">
                                    <option value="">{{ __('Uncategorized') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $document->category_id) == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="status" value="{{ __('Status') }}" class="text-slate-400" />
                                <select id="status" name="status"
                                        class="mt-1 block w-full glass-input">
                                    <option value="draft" @selected(old('status', $document->status) === 'draft')>{{ __('Draft') }}</option>
                                    <option value="published" @selected(old('status', $document->status) === 'published')>{{ __('Published') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-1" />
                            </div>
                            <div class="flex items-center mt-8">
                                <input id="is_pinned" name="is_pinned" type="checkbox" value="1"
                                       class="rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500"
                                       @checked(old('is_pinned', $document->is_pinned))>
                                <label for="is_pinned" class="ms-2 text-sm text-slate-400">
                                    {{ __('Pin this entry on top') }}
                                </label>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="content" value="{{ __('General notes / description') }}" class="text-slate-400" />
                            <textarea id="content" name="content" rows="6"
                                      class="mt-1 block w-full glass-input">{{ old('content', $document->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-1" />
                        </div>

                        @include('documents._meta-fields-dynamic', ['categories' => $categories, 'document' => $document])

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('documents.show', $document) }}"
                               class="text-sm text-slate-400 hover:text-white transition">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 glass-button px-5 py-2.5 text-white text-sm font-semibold">
                                {{ __('Save changes') }}
                            </button>
                        </div>
                    </form>

                    @can('delete', $document)
                        <form method="POST" action="{{ route('documents.destroy', $document) }}"
                              class="mt-8 pt-6 border-t border-slate-600/50"
                              onsubmit="return confirm('{{ __('Are you sure you want to delete this entry?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600/20 hover:bg-red-600/30 text-red-400 border border-red-500/30 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                                {{ __('Delete entry') }}
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
    </div>
</x-app-layout>
