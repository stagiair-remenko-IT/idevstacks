<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 glass-icon text-indigo-300">
                <x-icon :name="\App\Helpers\FieldIcon::forCategory($category)" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Edit category') }}: {{ $category->name }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    /{{ $category->slug }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="glass-card overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form id="category-update-form" method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" value="{{ __('Name') }}" class="text-slate-400" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name', $category->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="slug" value="{{ __('Slug (URL key)') }}" class="text-slate-400" />
                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                                              :value="old('slug', $category->slug)" required />
                                <x-input-error :messages="$errors->get('slug')" class="mt-1" />
                            </div>
                        </div>

                        @include('categories._icon-picker', ['category' => $category])

                        <div>
                            <x-input-label for="description" value="{{ __('Description') }}" class="text-slate-400" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full glass-input">{{ old('description', $category->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                    </form>
                    <div class="flex items-center justify-between gap-3 pt-4">
                        <a href="{{ route('categories.index') }}"
                           class="text-sm text-slate-400 hover:text-white transition">
                            {{ __('Back to list') }}
                        </a>
                        <div class="flex items-center gap-3">
                            <button type="submit" form="category-update-form"
                                    class="inline-flex items-center gap-2 glass-button px-5 py-2.5 text-white text-sm font-semibold">
                                {{ __('Save changes') }}
                            </button>
                            <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600/20 hover:bg-red-600/30 text-red-400 border border-red-500/30 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Custom fields section --}}
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <h3 class="text-sm font-semibold text-slate-300">
                        {{ __('Custom fields for this category') }}
                    </h3>
                    <p class="mt-1 text-xs text-slate-500">
                        {{ __('Fields you add here (e.g. IP address, password, SSH) appear when creating or editing an entry in this category.') }}
                    </p>
                </div>
                <div class="p-6">
                    {{-- Add new field --}}
                    <div class="mb-6 p-5 rounded-xl glass-button-ghost">
                        <h4 class="text-sm font-semibold text-slate-300 mb-3">
                            {{ __('Add new field') }}
                        </h4>
                        <form method="POST" action="{{ route('categories.fields.store', $category) }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            @csrf
                            <div>
                                <x-input-label for="key" value="{{ __('Key (machine name)') }}" class="text-slate-400" />
                                <x-text-input id="key" name="key" type="text" class="mt-1 block w-full" :value="old('key')" required placeholder="e.g. ip_address" />
                                <x-input-error :messages="$errors->get('key')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="label" value="{{ __('Label (shown to user)') }}" class="text-slate-400" />
                                <x-text-input id="label" name="label" type="text" class="mt-1 block w-full" :value="old('label')" required placeholder="e.g. IP Address" />
                                <x-input-error :messages="$errors->get('label')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="field_type" value="{{ __('Data type') }}" class="text-slate-400" />
                                <select id="field_type" name="field_type" class="mt-1 block w-full glass-input">
                                    <option value="text">{{ __('Text') }}</option>
                                    <option value="textarea">{{ __('Textarea (multi-line)') }}</option>
                                    <option value="password">{{ __('Password / secret') }}</option>
                                    <option value="email">{{ __('Email') }}</option>
                                    <option value="url">{{ __('URL') }}</option>
                                    <option value="number">{{ __('Number') }}</option>
                                </select>
                            </div>
                            <div class="flex flex-wrap items-center gap-4">
                                <label class="inline-flex items-center">
                                    <input id="is_required" name="is_required" type="checkbox" value="1" class="rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500">
                                    <span class="ms-2 text-xs text-slate-400">{{ __('Required') }}</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input id="is_sensitive" name="is_sensitive" type="checkbox" value="1" class="rounded border-white/20 bg-white/10 text-indigo-500 focus:ring-indigo-500">
                                    <span class="ms-2 text-xs text-slate-400">{{ __('Sensitive') }}</span>
                                </label>
                                <div class="flex items-center gap-1">
                                    <x-input-label for="sort_order" value="{{ __('Order') }}" class="sr-only" />
                                    <x-text-input id="sort_order" name="sort_order" type="number" min="0" class="w-20" :value="old('sort_order', 0)" />
                                </div>
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold transition">
                                    {{ __('Add field') }}
                                </button>
                            </div>
                            <div class="md:col-span-4">
                                <x-input-label for="help_text" value="{{ __('Help text (optional)') }}" class="text-slate-400" />
                                <textarea id="help_text" name="help_text" rows="2" class="mt-1 block w-full glass-input" placeholder="{{ __('e.g. Printer IP on the internal network') }}">{{ old('help_text') }}</textarea>
                            </div>
                        </form>
                    </div>

                    <h4 class="text-sm font-semibold text-slate-300 mb-3">
                        {{ __('Current fields') }}
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @forelse($category->fields->sortBy('sort_order') as $field)
                            <div class="rounded-xl glass-button-ghost p-4 text-sm flex flex-col justify-between">
                                <div>
                                    <p class="font-medium text-white">
                                        {{ $field->label }}
                                        <span class="text-xs text-slate-500">({{ $field->key }})</span>
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ ucfirst($field->field_type) }}
                                        @if($field->is_required)· {{ __('Required') }}@endif
                                        @if($field->is_sensitive)· {{ __('Sensitive') }}@endif
                                    </p>
                                    @if($field->help_text)
                                        <p class="mt-2 text-xs text-slate-500">
                                            {{ $field->help_text }}
                                        </p>
                                    @endif
                                </div>
                                <div class="mt-3 flex justify-end">
                                    <form method="POST" action="{{ route('categories.fields.destroy', [$category, $field]) }}"
                                          onsubmit="return confirm('{{ __('Remove this field? Existing data on documents will remain stored.') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition">
                                            {{ __('Remove') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 col-span-full">
                                {{ __('No fields yet. Use the form above to add your first field (e.g. IP address, password).') }}
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
