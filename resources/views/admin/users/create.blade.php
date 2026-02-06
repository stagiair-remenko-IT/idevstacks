<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-600/80 text-indigo-300 border border-slate-500/60">
                <x-icon name="users" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('New user') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ __('Create an IT Worker or Global Admin account') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" value="{{ __('Name') }}" class="text-slate-400" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500"
                                              :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="email" value="{{ __('Email') }}" class="text-slate-400" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500"
                                              :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="role" value="{{ __('Role') }}" class="text-slate-400" />
                                <select id="role" name="role"
                                        class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="{{ \App\Models\User::ROLE_IT_WORKER }}" @selected(old('role') === \App\Models\User::ROLE_IT_WORKER)>{{ __('IT Worker') }}</option>
                                    <option value="{{ \App\Models\User::ROLE_GLOBAL_ADMIN }}" @selected(old('role') === \App\Models\User::ROLE_GLOBAL_ADMIN)>{{ __('Global Admin') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="password" value="{{ __('Initial password') }}" class="text-slate-400" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" value="{{ __('Confirm password') }}" class="text-slate-400" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500" required />
                        </div>

                        <p class="text-xs text-slate-500">
                            {{ __('Ask the user to sign in and change their password immediately after first login.') }}
                        </p>

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('admin.users.index') }}"
                               class="text-sm text-slate-400 hover:text-white transition">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                                {{ __('Create user') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
