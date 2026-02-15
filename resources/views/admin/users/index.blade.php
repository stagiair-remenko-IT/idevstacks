<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex items-center justify-center w-12 h-12 glass-icon bg-emerald-500/20 text-emerald-400 border-emerald-500/40">
                <x-icon name="users" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('User management') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('Manage Global Admin and IT Worker accounts') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-slate-500">
                    {{ __('Create and edit user accounts and assign roles.') }}
                </p>
                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center justify-center gap-2 glass-button px-5 py-2.5 font-semibold text-sm text-white shrink-0">
                    <x-icon name="plus" class="h-4 w-4" />
                    {{ __('New user') }}
                </a>
            </div>

            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-white/10 bg-white/5">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                        {{ __('Users') }}
                    </p>
                </div>
                <div class="p-6">
                    @if($users->isEmpty())
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <span class="flex items-center justify-center w-16 h-16 glass-icon text-slate-500 mb-5">
                                <x-icon name="users" class="h-8 w-8" />
                            </span>
                            <p class="text-slate-400 text-base font-medium">
                                {{ __('No users found.') }}
                            </p>
                            <p class="text-slate-500 text-sm mt-1">
                                {{ __('Create the first user account.') }}
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-white/10 bg-white/5">
                                        <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Name') }}</th>
                                        <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Email') }}</th>
                                        <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Role') }}</th>
                                        <th class="px-6 py-4 text-left font-semibold text-slate-400 uppercase tracking-widest text-xs">{{ __('Created') }}</th>
                                        <th class="px-6 py-4 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center gap-2 text-white font-medium">
                                                    <x-icon name="user" class="h-4 w-4 text-slate-500 shrink-0" />
                                                    {{ $user->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span @class([
                                                    'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium',
                                                    'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' => $user->isGlobalAdmin(),
                                                    'bg-slate-600/50 text-slate-300 border border-slate-500/50' => $user->isItWorker(),
                                                ])>
                                                    {{ $user->isGlobalAdmin() ? __('Global Admin') : __('IT Worker') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 text-xs">
                                                {{ $user->created_at?->format('Y-m-d') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                @can('update', $user)
                                                    <a href="{{ route('admin.users.edit', $user) }}"
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
