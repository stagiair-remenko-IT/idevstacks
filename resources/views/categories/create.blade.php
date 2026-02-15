<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-600/80 text-indigo-300 border border-slate-500/60">
                <x-icon name="folder" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('New category / section') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ __('Create a new documentation section') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="{{ __('Name') }}" class="text-slate-400" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="slug" value="{{ __('Slug (URL key)') }}" class="text-slate-400" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                                          :value="old('slug')" required />
                            <p class="mt-1 text-xs text-slate-500">
                                {{ __('Lowercase, no spaces. Example: printers, pc-laptops, servers') }}
                            </p>
                            <x-input-error :messages="$errors->get('slug')" class="mt-1" />
                        </div>

                        @include('categories._icon-picker')

                        <div>
                            <x-input-label for="description" value="{{ __('Description') }}" class="text-slate-400" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full glass-input">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('categories.index') }}"
                               class="text-sm text-slate-400 hover:text-white transition">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                                {{ __('Create category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
