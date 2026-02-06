<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-600/80 text-indigo-300 border border-slate-500/60">
                <x-icon name="users" class="h-5 w-5" />
            </span>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('User management') }}
                </h2>
                <p class="mt-0.5 text-sm text-slate-300">
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
                   class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 border border-indigo-500/50 font-semibold text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-100 shrink-0 transition">
                    <x-icon name="plus" class="h-4 w-4" />
                    {{ __('New user') }}
                </a>
            </div>

            <div class="rounded-2xl bg-slate-800/95 border border-slate-600/60 shadow-lg overflow-hidden">
                <div class="p-5 border-b border-slate-600/50">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        {{ __('Users') }}
                    </p>
                </div>
                <div class="p-6">
                    @if($users->isEmpty())
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <span class="flex items-center justify-center w-14 h-14 rounded-xl bg-slate-700/80 text-slate-400 border border-slate-600/50 mb-4">
                                <x-icon name="users" class="h-7 w-7" />
                            </span>
                            <p class="text-slate-400 text-sm">
                                {{ __('No users found.') }}
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-slate-600/60">
                                        <th class="px-5 py-3 text-left font-semibold text-slate-400 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-5 py-3 text-left font-semibold text-slate-400 uppercase tracking-wider">{{ __('Email') }}</th>
                                        <th class="px-5 py-3 text-left font-semibold text-slate-400 uppercase tracking-wider">{{ __('Role') }}</th>
                                        <th class="px-5 py-3 text-left font-semibold text-slate-400 uppercase tracking-wider">{{ __('Created') }}</th>
                                        <th class="px-5 py-3 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr class="border-b border-slate-700/50 hover:bg-slate-700/30 transition">
                                            <td class="px-5 py-3 whitespace-nowrap">
                                                <span class="inline-flex items-center gap-2 text-white font-medium">
                                                    <x-icon name="user" class="h-4 w-4 text-slate-500 shrink-0" />
                                                    {{ $user->name }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap text-slate-400">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap">
                                                <span @class([
                                                    'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium',
                                                    'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' => $user->isGlobalAdmin(),
                                                    'bg-slate-600/50 text-slate-300 border border-slate-500/50' => $user->isItWorker(),
                                                ])>
                                                    {{ $user->isGlobalAdmin() ? __('Global Admin') : __('IT Worker') }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap text-slate-500 text-xs">
                                                {{ $user->created_at?->format('Y-m-d') }}
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap text-right">
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
