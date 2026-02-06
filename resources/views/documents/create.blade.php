<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-600/80 text-indigo-300 border border-slate-500/60">
                <x-icon name="document" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('New documentation entry') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ __('Create a new IT documentation entry') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden" x-data="{ selectedCategoryId: '{{ old('category_id') }}' }">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('documents.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="title" value="{{ __('Title') }}" class="text-slate-400" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500"
                                              :value="old('title')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="category_id" value="{{ __('Category / Section') }}" class="text-slate-400" />
                                <p class="text-xs text-slate-500 mb-1">
                                    {{ __('Choose a category to show custom fields (IP, password, etc.) below.') }}
                                </p>
                                <select id="category_id" name="category_id" x-model="selectedCategoryId"
                                        class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('Uncategorized') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
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
                                        class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="draft" @selected(old('status', 'draft') === 'draft')>{{ __('Draft') }}</option>
                                    <option value="published" @selected(old('status') === 'published')>{{ __('Published') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-1" />
                            </div>
                            <div class="flex items-center mt-8">
                                <input id="is_pinned" name="is_pinned" type="checkbox" value="1"
                                       class="rounded border-slate-600 bg-slate-700 text-indigo-500 focus:ring-indigo-500"
                                       @checked(old('is_pinned'))>
                                <label for="is_pinned" class="ms-2 text-sm text-slate-400">
                                    {{ __('Pin this entry on top') }}
                                </label>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="content" value="{{ __('General notes / description') }}" class="text-slate-400" />
                            <textarea id="content" name="content" rows="6"
                                      class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500">{{ old('content') }}</textarea>
                            <p class="mt-1 text-xs text-slate-500">
                                {{ __('You can use this area for free-form notes, procedures, or extra background information.') }}
                            </p>
                            <x-input-error :messages="$errors->get('content')" class="mt-1" />
                        </div>

                        @include('documents._meta-fields-dynamic', ['categories' => $categories])

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('documents.index') }}"
                               class="text-sm text-slate-400 hover:text-white transition">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                                {{ __('Save entry') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
