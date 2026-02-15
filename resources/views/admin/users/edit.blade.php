<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-600/80 text-amber-300 border border-slate-500/60">
                <x-icon name="user" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Edit user') }}: {{ $user->name }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
                    {{ $user->email }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden">
                <div class="p-6 sm:p-8">
                    @if($errors->any())
                        <div class="mb-6 rounded-xl bg-red-500/15 border border-red-500/40 px-4 py-3 text-sm text-red-300">
                            <p class="font-medium">{{ __('Please fix the following errors:') }}</p>
                            <ul class="mt-2 list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" value="{{ __('Name') }}" class="text-slate-400" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name', $user->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="email" value="{{ __('Email') }}" class="text-slate-400" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                              :value="old('email', $user->email)" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="role" value="{{ __('Role') }}" class="text-slate-400" />
                                <select id="role" name="role"
                                        class="mt-1 block w-full glass-input">
                                    <option value="{{ \App\Models\User::ROLE_IT_WORKER }}" @selected(old('role', $user->role) === \App\Models\User::ROLE_IT_WORKER)>{{ __('IT Worker') }}</option>
                                    <option value="{{ \App\Models\User::ROLE_GLOBAL_ADMIN }}" @selected(old('role', $user->role) === \App\Models\User::ROLE_GLOBAL_ADMIN)>{{ __('Global Admin') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="password" value="{{ __('Reset password (optional)') }}" class="text-slate-400" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ __('Leave blank to keep the current password.') }}
                                </p>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" value="{{ __('Confirm password') }}" class="text-slate-400" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
                        </div>

                        <div class="flex items-center justify-between gap-3 pt-4">
                            <a href="{{ route('admin.users.index') }}"
                               class="text-sm text-slate-400 hover:text-white transition">
                                {{ __('Back to list') }}
                            </a>
                            <div class="flex items-center gap-3">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 glass-button px-5 py-2.5 text-white text-sm font-semibold">
                                    {{ __('Save changes') }}
                                </button>
                                @can('delete', $user)
                                    <button type="button"
                                            onclick="if(confirm('{{ __('Are you sure you want to delete this user?') }}')) { document.getElementById('delete-user-form').submit(); }"
                                            class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600/20 hover:bg-red-600/30 text-red-400 border border-red-500/30 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition">
                                        {{ __('Delete') }}
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </form>
                    @can('delete', $user)
                        <form id="delete-user-form" method="POST" action="{{ route('admin.users.destroy', $user) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
